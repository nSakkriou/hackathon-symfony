<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\ProfileController;
use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: 'profile',
            controller: ProfileController::class,
            name: 'new_profile',
        ),
        new GetCollection()
    ],
    normalizationContext: ['groups' => [self::PROFILE_READ]],
    denormalizationContext: ['groups' => [self::PROFILE_WRITE]]
)]
#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{

    private const PROFILE_READ = 'profile:read';
    
    private const PROFILE_WRITE = 'profile:write';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([self::PROFILE_READ])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups([self::PROFILE_READ, self::PROFILE_WRITE])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups([self::PROFILE_READ, self::PROFILE_WRITE])]
    private ?string $lastname = null;

    #[ORM\Column(length: 10, nullable: true)]
    #[Groups([self::PROFILE_READ, self::PROFILE_WRITE])]
    private ?string $phone = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups([self::PROFILE_READ, self::PROFILE_WRITE])]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups([self::PROFILE_READ, self::PROFILE_WRITE])]
    private ?bool $acquaintancePro = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([self::PROFILE_READ, self::PROFILE_WRITE])]
    private ?string $linkedin = null;

    #[ORM\ManyToOne(inversedBy: 'profiles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([self::PROFILE_READ, self::PROFILE_WRITE])]
    private ?User $cooptedBy = null;

    #[ORM\ManyToOne(inversedBy: 'profiles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([self::PROFILE_READ])]
    private ?ProfileStatus $status = null;

    /**
     * @var Collection<int, File>
     */
    #[ORM\OneToMany(targetEntity: File::class, mappedBy: 'profile', orphanRemoval: true)]
    #[Groups([self::PROFILE_WRITE])]
    private Collection $files;

    /**
     * @var Collection<int, ProfileAction>
     */
    #[ORM\OneToMany(targetEntity: ProfileAction::class, mappedBy: 'profile')]
    private Collection $profileActions;

    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->profileActions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function isAcquaintancePro(): ?bool
    {
        return $this->acquaintancePro;
    }

    public function setAcquaintancePro(bool $acquaintancePro): static
    {
        $this->acquaintancePro = $acquaintancePro;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): static
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getCooptedBy(): ?User
    {
        return $this->cooptedBy;
    }

    public function setCooptedBy(?User $cooptedBy): static
    {
        $this->cooptedBy = $cooptedBy;

        return $this;
    }

    public function getStatus(): ?ProfileStatus
    {
        return $this->status;
    }

    public function setStatus(?ProfileStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, File>
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(File $file): static
    {
        if (!$this->files->contains($file)) {
            $this->files->add($file);
            $file->setProfile($this);
        }

        return $this;
    }

    public function removeFile(File $file): static
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getProfile() === $this) {
                $file->setProfile(null);
            }
        }

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
            $profileAction->setProfile($this);
        }

        return $this;
    }

    public function removeProfileAction(ProfileAction $profileAction): static
    {
        if ($this->profileActions->removeElement($profileAction)) {
            // set the owning side to null (unless already changed)
            if ($profileAction->getProfile() === $this) {
                $profileAction->setProfile(null);
            }
        }

        return $this;
    }
}
