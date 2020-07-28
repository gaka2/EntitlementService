<?php

namespace App\Service;

use App\Entity\AbstractEntitlement;
use App\Entity\EntitlementGranted;
use App\Entity\EntitlementUngranted;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Karol Gancarczyk
 */
class EntitlementService {
    
    private $userRepository;
    private $videoRepository;
    
    public function __construct(UserRepository $userRepository, VideoRepository $videoRepository) {
        $this->userRepository = $userRepository;
        $this->videoRepository = $videoRepository;
    }
    
    public function checkEntitlement(int $userId, int $videoId): AbstractEntitlement {
        
        $user = $this->userRepository->find($userId);
        if ($user === null) {
            throw new NotFoundHttpException();
        }
        
        $video = $this->videoRepository->find($videoId);
        if ($video === null) {
            throw new NotFoundHttpException();
        }
        
        foreach ($video->getSubscriptionPlans() as $subscriptionPlan) {
            foreach ($subscriptionPlan->getUsers() as $userSubscriptionPlan) {
                $userFromSubscriptionPlan = $userSubscriptionPlan->getUser();
                if ($userFromSubscriptionPlan === null) {
                    continue;
                }
                
                $currentDateTime = new \DateTime('now');
                $subscriptionActivationDateTime = clone $userSubscriptionPlan->getActiveFrom();
                $subscriptionExpirationDateTime = $subscriptionActivationDateTime->add($subscriptionPlan->getDurationPeriod());
                $subscriptionActivationDateTime = $userSubscriptionPlan->getActiveFrom();
                
                if ($userFromSubscriptionPlan === $user && $subscriptionActivationDateTime <= $currentDateTime && $currentDateTime <= $subscriptionExpirationDateTime) {
                    return new EntitlementGranted();
                }
            }
        }
        return new EntitlementUngranted();
    }
}
