<?php

namespace App\Repository;

use App\Entity\Cursus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cursus>
 *
 * @method Cursus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cursus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cursus[]    findAll()
 * @method Cursus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cursus::class);
    }

//    /**
//     * @return Cursus[] Returns an array of Cursus objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cursus
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function countExerciceOfCursusDone(int $idUser, int $idCursus): int
{
    $conn = $this->getEntityManager()->getConnection();
    $sql = '
    SELECT * FROM module m, sequence sq,seance s, exercice_user es, exercice e
    Where s.id = e.seance_id 
    and e.id=es.exercice_id 
    and es.user_id = :userId 
    and sq.module_id= m.id
    and s.sequence_id = sq.id
    and m.cursus_id=:cursusId
    ';
    $resultSet = $conn->executeQuery($sql, ['cursusId' => $idCursus,'userId'=>$idUser]);

    // returns an array of arrays (i.e. a raw data set)
    return $resultSet->rowCount();
}
public function countExerciceOfCursus( int $idCursus): int
{
    $conn = $this->getEntityManager()->getConnection();
    $sql = '
    SELECT * FROM module m ,sequence sq, seance s, exercice e
    Where s.id = e.seance_id 
    and s.sequence_id = sq.id
    and sq.module_id= m.id
    and m.cursus_id=:cursusId
    ';
    $resultSet = $conn->executeQuery($sql, ['cursusId' => $idCursus]);

    // returns an array of arrays (i.e. a raw data set)
    return $resultSet->rowCount();
}
}
