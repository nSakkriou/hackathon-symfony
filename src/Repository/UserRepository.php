<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * Gets point for all user
     *
     * @return mixed
     */
    public function findPointsByUser(): mixed
    {
        return $this->createQueryBuilder('u')
            ->select('u.id', 'u.firstname', 'u.lastname', 't.id as teamId', 't.name as teamName', 'SUM(act.points) AS totalPoints')
            ->join('u.profileActions', 'pa')
            ->join('u.team', 't')
            ->join('pa.actionType', 'act')
            ->groupBy('u.id')
            ->orderBy('totalPoints', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
