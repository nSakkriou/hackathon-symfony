<?php

namespace App\Entity;

use App\Repository\ProfileStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ProfileStatusRepository::class)]
class ProfileStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['profile:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['profile:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Profile>
     */
    #[ORM\OneToMany(targetEntity: Profile::class, mappedBy: 'status')]
    private Collection $profiles;

    #[ORM\Column(nullable: true)]
    #[Groups(['profile:read'])]
    private ?int $orderStep = null;

    public function __construct()
    {
        $this->profiles = new ArrayCollection();
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

    /**
     * @return Collection<int, Profile>
     */
    public function getProfiles(): Collection
    {
        return $this->profiles;
    }

    public function addProfile(Profile $profile): static
    {
        if (!$this->profiles->contains($profile)) {
            $this->profiles->add($profile);
            $profile->setStatus($this);
        }

        return $this;
    }

    public function removeProfile(Profile $profile): static
    {
        if ($this->profiles->removeElement($profile)) {
            // set the owning side to null (unless already changed)
            if ($profile->getStatus() === $this) {
                $profile->setStatus(null);
            }
        }

        return $this;
    }

    public function getOrderStep(): ?string
    {
        return $this->orderStep;
    }

    public function setOrderStep(?string $orderStep): static
    {
        $this->orderStep = $orderStep;

        return $this;
    }
}
