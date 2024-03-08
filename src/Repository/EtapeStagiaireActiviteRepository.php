<?php

namespace App\Repository;

use App\Entity\EtapeStagiaireActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtapeStagiaireActivite>
 *
 * @method EtapeStagiaireActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtapeStagiaireActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtapeStagiaireActivite[]    findAll()
 * @method EtapeStagiaireActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtapeStagiaireActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtapeStagiaireActivite::class);
    }

//    /**
//     * @return EtapeStagiaireActivite[] Returns an array of EtapeStagiaireActivite objects
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

//    public function findOneBySomeField($value): ?EtapeStagiaireActivite
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
