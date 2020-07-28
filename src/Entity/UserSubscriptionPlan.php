<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserSubscriptionPlanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"post"},
 *     itemOperations={"get", "patch"}
 * )
 * @ORM\Entity(repositoryClass=UserSubscriptionPlanRepository::class)
 * @author Karol Gancarczyk
 */
class UserSubscriptionPlan
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $activeFrom;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="subscriptionPlans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=SubscriptionPlan::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subscriptionPlan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActiveFrom(): ?\DateTimeInterface
    {
        return $this->activeFrom;
    }

    public function setActiveFrom(\DateTimeInterface $activeFrom): self
    {
        $this->activeFrom = $activeFrom;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSubscriptionPlan(): ?SubscriptionPlan
    {
        return $this->subscriptionPlan;
    }

    public function setSubscriptionPlan(?SubscriptionPlan $subscriptionPlan): self
    {
        $this->subscriptionPlan = $subscriptionPlan;

        return $this;
    }
}
