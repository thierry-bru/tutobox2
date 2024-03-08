<?php

namespace App\Repository;

use App\Entity\ActiviteCursus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActiviteCursus>
 *
 * @method ActiviteCursus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteCursus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteCursus[]    findAll()
 * @method ActiviteCursus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteCursusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActiviteCursus::class);
    }

//    /**
//     * @return ActiviteCursus[] Returns an array of ActiviteCursus objects
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

//    public function findOneBySomeField($value): ?ActiviteCursus
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
