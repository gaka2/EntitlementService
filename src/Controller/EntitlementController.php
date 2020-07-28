<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EntitlementService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Karol Gancarczyk
 */
class EntitlementController extends AbstractController {
    
    private $entitlementService;
    
    private const NOT_FOUND_MESSAGE = 'Not Found';
    
    public function __construct(EntitlementService $entitlementService) {
        $this->entitlementService = $entitlementService;
    }
    
    /**
     * @Route(
     *     name="api_check_entitlement",
     *     path="/api/check_entitlement/{userId}/{videoId}",
     *     requirements={"userId"="\d+", "videoId"="\d+"}
     * )
     */
    public function checkEntitlement(int $userId, int $videoId) {
        try {
            $entitlement = $this->entitlementService->checkEntitlement($userId, $videoId);
            return $this->json([$entitlement]);        
        } catch (NotFoundHttpException $e) {
            return $this->json([self::NOT_FOUND_MESSAGE], Response::HTTP_NOT_FOUND);
        }

    }
}
