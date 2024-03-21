<?php

namespace App\Repository;

use App\Entity\Sequence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sequence>
 *
 * @method Sequence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sequence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sequence[]    findAll()
 * @method Sequence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SequenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sequence::class);
    }

//    /**
//     * @return Sequence[] Returns an array of Sequence objects
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

//    public function findOneBySomeField($value): ?Sequence
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function countExerciceOfSequenceDone(int $idUser, int $idSequence): int
{
    $conn = $this->getEntityManager()->getConnection();
    $sql = '
    SELECT * FROM sequence sq,seance s, exercice_user es, exercice e
    Where s.id = e.seance_id 
    and e.id=es.exercice_id 
    and es.user_id = :userId 
    and sq.id=:sequenceId 
    and s.sequence_id = sq.id;';
    $resultSet = $conn->executeQuery($sql, ['sequenceId' => $idSequence,'userId'=>$idUser]);

    // returns an array of arrays (i.e. a raw data set)
    return $resultSet->rowCount();
}
public function countExerciceOfSequence( int $idSequence): int
{
    $conn = $this->getEntityManager()->getConnection();
    $sql = '
    SELECT * FROM sequence sq, seance s, exercice e
    Where s.id = e.seance_id 
    and sq.id=:sequenceId 
    and s.sequence_id = sq.id';
    $resultSet = $conn->executeQuery($sql, ['sequenceId' => $idSequence]);

    // returns an array of arrays (i.e. a raw data set)
    return $resultSet->rowCount();
}
}
