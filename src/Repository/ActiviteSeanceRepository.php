<?php

namespace App\Repository;

use App\Entity\ActiviteSeance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActiviteSeance>
 *
 * @method ActiviteSeance|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteSeance|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteSeance[]    findAll()
 * @method ActiviteSeance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteSeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActiviteSeance::class);
    }

//    /**
//     * @return ActiviteSeance[] Returns an array of ActiviteSeance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ActiviteSeance
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
