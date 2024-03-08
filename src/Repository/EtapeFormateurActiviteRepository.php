<?php

namespace App\Repository;

use App\Entity\EtapeFormateurActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtapeFormateurActivite>
 *
 * @method EtapeFormateurActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtapeFormateurActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtapeFormateurActivite[]    findAll()
 * @method EtapeFormateurActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtapeFormateurActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtapeFormateurActivite::class);
    }

//    /**
//     * @return EtapeFormateurActivite[] Returns an array of EtapeFormateurActivite objects
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

//    public function findOneBySomeField($value): ?EtapeFormateurActivite
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
