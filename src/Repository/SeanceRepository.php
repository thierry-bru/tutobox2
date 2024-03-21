<?php

namespace App\Repository;

use App\Entity\Seance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seance>
 *
 * @method Seance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seance[]    findAll()
 * @method Seance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seance::class);
    }

//    /**
//     * @return Seance[] Returns an array of Seance objects
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

//    public function findOneBySomeField($value): ?Seance
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function countExerciceOfSeanceDone(int $idUser, int $idSeance): int
{
    $conn = $this->getEntityManager()->getConnection();
    $sql = '
    SELECT * FROM seance s, exercice_user es, exercice e
    Where s.id = e.seance_id and e.id=es.exercice_id and es.user_id = :userId and s.id=:seanceId;';
    $resultSet = $conn->executeQuery($sql, ['seanceId' => $idSeance,'userId'=>$idUser]);

    // returns an array of arrays (i.e. a raw data set)
    return $resultSet->rowCount();
}
public function countExerciceOfSeance( int $idSeance): int
{
    $conn = $this->getEntityManager()->getConnection();
    $sql = '
    SELECT * FROM seance s, exercice e
    Where s.id = e.seance_id and s.id = :seanceId;';
    $resultSet = $conn->executeQuery($sql, ['seanceId' => $idSeance]);

    // returns an array of arrays (i.e. a raw data set)
    return $resultSet->rowCount();
}

}
