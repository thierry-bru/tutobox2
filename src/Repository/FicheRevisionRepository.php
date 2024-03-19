<?php

namespace App\Repository;

use App\Entity\FicheRevision;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheRevision>
 *
 * @method FicheRevision|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheRevision|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheRevision[]    findAll()
 * @method FicheRevision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheRevisionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheRevision::class);
    }

    //    /**
    //     * @return FicheRevision[] Returns an array of FicheRevision objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?FicheRevision
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
