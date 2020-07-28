<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
//use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ApiResource(
 *     collectionOperations={"post"},
 *     itemOperations={"get", "patch"}
 * )
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="videos")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=SubscriptionPlan::class, mappedBy="videos")
     */
    private $subscriptionPlans;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->subscriptionPlans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|SubscriptionPlan[]
     */
    public function getSubscriptionPlans(): Collection
    {
        return $this->subscriptionPlans;
    }

    public function addSubscriptionPlan(SubscriptionPlan $subscriptionPlan): self
    {
        if (!$this->subscriptionPlans->contains($subscriptionPlan)) {
            $this->subscriptionPlans[] = $subscriptionPlan;
            $subscriptionPlan->addVideo($this);
        }

        return $this;
    }

    public function removeSubscriptionPlan(SubscriptionPlan $subscriptionPlan): self
    {
        if ($this->subscriptionPlans->contains($subscriptionPlan)) {
            $this->subscriptionPlans->removeElement($subscriptionPlan);
            $subscriptionPlan->removeVideo($this);
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
