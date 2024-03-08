<?php

namespace App\Repository;

use App\Entity\ExerciceActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExerciceActivite>
 *
 * @method ExerciceActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciceActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciceActivite[]    findAll()
 * @method ExerciceActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciceActivite::class);
    }

//    /**
//     * @return ExerciceActivite[] Returns an array of ExerciceActivite objects
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

//    public function findOneBySomeField($value): ?ExerciceActivite
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
