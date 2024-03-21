<?php

namespace App\Repository;

use App\Entity\Module;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Module>
 *
 * @method Module|null find($id, $lockMode = null, $lockVersion = null)
 * @method Module|null findOneBy(array $criteria, array $orderBy = null)
 * @method Module[]    findAll()
 * @method Module[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Module::class);
    }

//    /**
//     * @return Module[] Returns an array of Module objects
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

//    public function findOneBySomeField($value): ?Module
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function countExerciceOfModuleDone(int $idUser, int $idModule): int
{
    $conn = $this->getEntityManager()->getConnection();
    $sql = '
    SELECT * FROM sequence sq,seance s, exercice_user es, exercice e
    Where s.id = e.seance_id 
    and e.id=es.exercice_id 
    and es.user_id = :userId 
    and sq.module_id=:moduleId 
    and s.sequence_id = sq.id;';
    $resultSet = $conn->executeQuery($sql, ['moduleId' => $idModule,'userId'=>$idUser]);

    // returns an array of arrays (i.e. a raw data set)
    return $resultSet->rowCount();
}
public function countExerciceOfModule( int $idModule): int
{
    $conn = $this->getEntityManager()->getConnection();
    $sql = '
    SELECT * FROM sequence sq, seance s, exercice e
    Where s.id = e.seance_id 
    and s.sequence_id = sq.id
    and sq.module_id=:moduleId
    ';
    $resultSet = $conn->executeQuery($sql, ['moduleId' => $idModule]);

    // returns an array of arrays (i.e. a raw data set)
    return $resultSet->rowCount();
}
}
