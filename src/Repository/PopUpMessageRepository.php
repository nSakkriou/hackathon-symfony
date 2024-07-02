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

    public function findLatestActiveMessage()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.messageText as message')
            ->where('p.endedAt IS NULL OR p.endedAt > :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('p.startedAt', 'DESC')
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    //    /**
    //     * @return PopUpMessage[] Returns an array of PopUpMessage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PopUpMessage
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
