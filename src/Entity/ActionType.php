<?php

namespace App\Entity;

use App\Repository\ActionTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[ORM\Entity(repositoryClass: ActionTypeRepository::class)]
class ActionType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $points = null;

    /**
     * @var Collection<int, ProfileAction>
     */
    #[ORM\OneToMany(targetEntity: ProfileAction::class, mappedBy: 'actionType')]
    private Collection $profileActions;

    public function __construct()
    {
        $this->profileActions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return Collection<int, ProfileAction>
     */
    public function getProfileActions(): Collection
    {
        return $this->profileActions;
    }

    public function addProfileAction(ProfileAction $profileAction): static
    {
        if (!$this->profileActions->contains($profileAction)) {
            $this->profileActions->add($profileAction);
            $profileAction->setActionType($this);
        }

        return $this;
    }

    public function removeProfileAction(ProfileAction $profileAction): static
    {
        if ($this->profileActions->removeElement($profileAction)) {
            // set the owning side to null (unless already changed)
            if ($profileAction->getActionType() === $this) {
                $profileAction->setActionType(null);
            }
        }

        return $this;
    }
}
