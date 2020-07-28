<?php

namespace App\Entity;

use App\Repository\SubscriptionPlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *     collectionOperations={"post"},
 *     itemOperations={"get", "patch"}
 * )
 * @ORM\Entity(repositoryClass=SubscriptionPlanRepository::class)
 * @author Karol Gancarczyk
 */
class SubscriptionPlan
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
    private $name;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $durationPeriod;

    /**
     * @ORM\ManyToMany(targetEntity=Video::class, inversedBy="subscriptionPlans")
     */
    private $videos;

    /**
     * @ORM\OneToMany(targetEntity=UserSubscriptionPlan::class, mappedBy="subscriptionPlan", orphanRemoval=true)
     */
    private $users;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDurationPeriod(): ?\DateInterval
    {
        return $this->durationPeriod;
    }

    public function setDurationPeriod(\DateInterval $durationPeriod): self
    {
        $this->durationPeriod = $durationPeriod;

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
        }

        return $this;
    }

    /**
     * @return Collection|UserSubscriptionPlan[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(UserSubscriptionPlan $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setSubscriptionPlan($this);
        }

        return $this;
    }

    public function removeUser(UserSubscriptionPlan $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getSubscriptionPlan() === $this) {
                $user->setSubscriptionPlan(null);
            }
        }

        return $this;
    }
}
