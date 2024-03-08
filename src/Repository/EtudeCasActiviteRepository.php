<?php

namespace App\Repository;

use App\Entity\EtudeCasActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtudeCasActivite>
 *
 * @method EtudeCasActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudeCasActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudeCasActivite[]    findAll()
 * @method EtudeCasActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudeCasActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtudeCasActivite::class);
    }

//    /**
//     * @return EtudeCasActivite[] Returns an array of EtudeCasActivite objects
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

//    public function findOneBySomeField($value): ?EtudeCasActivite
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
