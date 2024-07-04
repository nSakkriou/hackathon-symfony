<?php

namespace App\Entity;

use App\Repository\ProfileStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    normalizationContext: ['groups' => [self::PROFILE_STATUS_READ]],
    denormalizationContext: ['groups' => [self::PROFILE_STATUS_WRITE]]
)]
#[ORM\Entity(repositoryClass: ProfileStatusRepository::class)]
class ProfileStatus
{

    private const PROFILE_READ = "profile:read";
    private const PROFILE_STATUS_READ = "profile-status:read";
    private const PROFILE_STATUS_WRITE = "profile-status:write";
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([self::PROFILE_READ, self::PROFILE_STATUS_READ])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups([self::PROFILE_READ, self::PROFILE_STATUS_READ, self::PROFILE_STATUS_WRITE])]
    private ?string $name = null;

    /**
     * @var Collection<int, Profile>
     */
    #[ORM\OneToMany(targetEntity: Profile::class, mappedBy: 'status')]
    private Collection $profiles;

    #[ORM\Column(nullable: true)]
    #[Groups([self::PROFILE_READ, self::PROFILE_STATUS_READ, self::PROFILE_STATUS_WRITE])]
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
