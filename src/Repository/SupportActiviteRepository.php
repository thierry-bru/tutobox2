<?php

namespace App\Repository;

use App\Entity\SupportActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SupportActivite>
 *
 * @method SupportActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupportActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupportActivite[]    findAll()
 * @method SupportActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupportActivite::class);
    }

//    /**
//     * @return SupportActivite[] Returns an array of SupportActivite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SupportActivite
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
