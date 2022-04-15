<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Event $entity, bool $flush = true): void
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
    public function remove(Event $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findEventsByCriteria(int $region_id , string $genre_id )
    {
            
            $qb = $this->createQueryBuilder('e')        
            ->join('e.genres', 'g')
            ->join('e.region', 'r')
            ->where('r = :regionId AND :genreId IN (g)')
            ->setParameter('genreId', $genre_id)
            ->setParameter('regionId', $region_id);
        
            // query retrieval
            $query = $qb->getQuery();
            
            // query execute
            return $query->execute();
    }

    /**
     * API - Return all events where region = Ile-de-France / order by creation date / limit them by 3
     *
     * @return void
     */
    public function findAllForHomepageByLimit($eventsLimit)
    {
        $query = $this->createQueryBuilder('e') // e = Event
        ->join('e.region' ,'r')
        ->where('r.name = \'Ile-De-France\'')
        ->orderBy('e.date', 'DESC')
        ->setMaxResults($eventsLimit)
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Return all events where region = Ile-de-France / order by creation date
     *
     * @return void
     */
    public function findAllForHomepageByRegionOrderByDate()
    {
        $query = $this->createQueryBuilder('e') // e = Event
        ->join('e.region' ,'r')
        ->where('r.name = \'Ile-De-France\'')
        ->orderBy('e.date', 'ASC')
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Return all events per page
     * 
     * @return void 
     */
    public function getPaginatedEvents($page, $limit, $user_id)
    {
        $query = $this->createQueryBuilder('e') // e = Event
            ->orderBy('e.date', 'ASC')
            ->where('e.user = :user_id')
            ->setParameter('user_id', $user_id)
            // Defines the number of the first element to be retrieved
            ->setFirstResult(($page * $limit) - $limit)
            // Defines the maximum number of events per page
            ->setMaxResults($limit)
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Return all events per page
     * 
     * @return void 
     */
    public function getPaginatedEventsAdmin($page, $limit)
    {
        $query = $this->createQueryBuilder('e') // e = Event
            ->orderBy('e.date', 'ASC')
            // Defines the number of the first element to be retrieved
            ->setFirstResult(($page * $limit) - $limit)
            // Defines the maximum number of events per page
            ->setMaxResults($limit)
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Returns number of events
     *
     * @return void
     */
    public function getTotalEvents()
    {
        $query = $this->createQueryBuilder('e') // e = Event
            ->select('COUNT(e)')
        ;

        // For result, only return base type, not arrays, not objects
        return $query->getQuery()->getSingleScalarResult();
    }

    /**
     * Returns number of events by Users
     *
     * @return void
     */
    public function getTotalEventsByUser($user_id)
    {
        $query = $this->createQueryBuilder('e') // e = Event
            ->select('COUNT(e)')
            ->where('e.user = :user_id')
            ->setParameter('user_id', $user_id)
        ;

        // For result, only return base type, not arrays, not objects
        return $query->getQuery()->getSingleScalarResult();
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

