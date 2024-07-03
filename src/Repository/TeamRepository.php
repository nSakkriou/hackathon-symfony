<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Team>
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function findPointsByTeam(): mixed
    {
        return $this->createQueryBuilder('t')
            ->select('t.id', 't.name', 'SUM(act.points) AS totalPoints')
            ->join('t.users', 'u')
            ->join('u.profileActions', 'pa')
            ->join('pa.actionType', 'act')
            ->groupBy('t.id')
            ->orderBy('totalPoints', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
