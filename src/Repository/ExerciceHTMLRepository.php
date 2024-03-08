<?php

namespace App\Repository;

use App\Entity\ExerciceHTML;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExerciceHTML>
 *
 * @method ExerciceHTML|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciceHTML|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciceHTML[]    findAll()
 * @method ExerciceHTML[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceHTMLRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciceHTML::class);
    }

//    /**
//     * @return ExerciceHTML[] Returns an array of ExerciceHTML objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExerciceHTML
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
