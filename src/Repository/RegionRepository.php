<?php

namespace App\Repository;

use App\Entity\Region;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Region|null find($id, $lockMode = null, $lockVersion = null)
 * @method Region|null findOneBy(array $criteria, array $orderBy = null)
 * @method Region[]    findAll()
 * @method Region[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Region::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Region $entity, bool $flush = true): void
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
    public function remove(Region $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Region[] Returns an array of Region objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /**
    * 
    */
    public function findAllEventsByOneRegion(int $regionId)
    {
        
        $conn = $this->getEntityManager()->getConnection();

        $sql = 
            'SELECT `e`.`id`, `e`.`name`, `e`.`image`, `e`.`price`
            FROM `event` e
            INNER JOIN `region` r ON `e`.`region_id` = `r`.`id`
            WHERE `r`.`id` = :id'
            ;

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id' => $regionId]);
        
        return $resultSet->fetchAllAssociative();
    }

    /*
    public function findAllEventsByOneRegion(int $regionId)
    {
        // 
        $qb = $this->createQueryBuilder('r')
            ->select(array('r','e'))
            ->innerJoin('Event', 'e','WITH','e.region = r.id')
            ->where('r.id = :regionId')
            ->setParameter('regionId', $regionId);
            
        $query = $qb->getQuery();
        
        return $query->execute();
    }
    */
}
