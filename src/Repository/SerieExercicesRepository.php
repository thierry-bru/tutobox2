<?php

namespace App\Repository;

use App\Entity\SerieExercices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SerieExercices>
 *
 * @method SerieExercices|null find($id, $lockMode = null, $lockVersion = null)
 * @method SerieExercices|null findOneBy(array $criteria, array $orderBy = null)
 * @method SerieExercices[]    findAll()
 * @method SerieExercices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieExercicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SerieExercices::class);
    }

//    /**
//     * @return SerieExercices[] Returns an array of SerieExercices objects
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

//    public function findOneBySomeField($value): ?SerieExercices
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
