<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *     collectionOperations={"post"},
 *     itemOperations={"get", "patch"}
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @author Karol Gancarczyk
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=UserSubscriptionPlan::class, mappedBy="user", orphanRemoval=true)
     */
    private $subscriptionPlans;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|UserSubscriptionPlan[]
     */
    public function getSubscriptionPlans(): Collection
    {
        return $this->subscriptionPlans;
    }

    public function addSubscriptionPlan(UserSubscriptionPlan $subscriptionPlan): self
    {
        if (!$this->subscriptionPlans->contains($subscriptionPlan)) {
            $this->subscriptionPlans[] = $subscriptionPlan;
            $subscriptionPlan->setUser($this);
        }

        return $this;
    }

    public function removeSubscriptionPlan(UserSubscriptionPlan $subscriptionPlan): self
    {
        if ($this->subscriptionPlans->contains($subscriptionPlan)) {
            $this->subscriptionPlans->removeElement($subscriptionPlan);
            // set the owning side to null (unless already changed)
            if ($subscriptionPlan->getUser() === $this) {
                $subscriptionPlan->setUser(null);
            }
        }

        return $this;
    }
}
