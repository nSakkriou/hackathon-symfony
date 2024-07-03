<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    normalizationContext: ['groups' => [self::PROFILE_READ]]
)]
#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    private const PROFILE_READ = 'profile:read';
    
    private const TEAM_READ = 'team:read';
    private const TEAM_WRITE = 'team:write';
    private const USER_READ = 'user:read';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([self::TEAM_READ, self::TEAM_WRITE, self::USER_READ])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups([self::TEAM_READ, self::TEAM_WRITE, self::USER_READ])]
    private ?string $name = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'team')]
    #[Groups([self::TEAM_READ])]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setTeam($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getTeam() === $this) {
                $user->setTeam(null);
            }
        }

        return $this;
    }
}
