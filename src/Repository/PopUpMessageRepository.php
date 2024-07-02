<?php

namespace App\Repository;

use App\Entity\PopUpMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PopUpMessage>
 */
class PopUpMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PopUpMessage::class);
    }

    public function findLatestActiveMessage(): mixed
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.messageText as message')
            ->where('p.endedAt IS NULL OR p.endedAt > :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('p.startedAt', 'DESC')
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

}
