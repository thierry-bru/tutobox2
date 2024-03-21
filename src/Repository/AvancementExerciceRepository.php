<?php

namespace App\Repository;

use App\Entity\AvancementExercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvancementExercice>
 *
 * @method AvancementExercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvancementExercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvancementExercice[]    findAll()
 * @method AvancementExercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvancementExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvancementExercice::class);
    }

    //    /**
    //     * @return AvancementExercice[] Returns an array of AvancementExercice objects
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

    //    public function findOneBySomeField($value): ?AvancementExercice
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
