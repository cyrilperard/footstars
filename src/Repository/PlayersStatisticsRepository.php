<?php

namespace App\Repository;

use App\Entity\PlayersStatistics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayersStatistics|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayersStatistics|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayersStatistics[]    findAll()
 * @method PlayersStatistics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayersStatisticsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayersStatistics::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PlayersStatistics $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PlayersStatistics $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return PlayersStatistics[] Returns an array of PlayersStatistics objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlayersStatistics
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
