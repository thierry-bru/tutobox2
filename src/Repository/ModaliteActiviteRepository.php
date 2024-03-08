<?php

namespace App\Repository;

use App\Entity\ModaliteActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModaliteActivite>
 *
 * @method ModaliteActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModaliteActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModaliteActivite[]    findAll()
 * @method ModaliteActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModaliteActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModaliteActivite::class);
    }

//    /**
//     * @return ModaliteActivite[] Returns an array of ModaliteActivite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ModaliteActivite
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
