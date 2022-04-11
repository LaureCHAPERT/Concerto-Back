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

    public function findEventsByCriteria(int $region_id , int $genre_id )
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = 
            'SELECT `event`.`id`,`event`.`name`, `event`.`image`, `event`.`price`, `event`.`description`, `event`.`link_ticketing`, `genre`.`name` as `genre_name`, `region`.`name` as `region_name`
            FROM `event`
            INNER JOIN `event_genre` ON `event`.`id` = `event_id` 
            INNER JOIN `genre` ON `event_genre`.`genre_id` = `genre`.`id`
            INNER JOIN `region` ON `event`.`region_id` = `region`.`id`
            WHERE `event_genre`.`genre_id` = :genre_id
            AND `region`.`id` = :region_id'
            ;

            $stmt = $conn->prepare($sql);

            $resultSet = $stmt->executeQuery(['genre_id' => $genre_id, 'region_id' => $region_id]);

            return $resultSet->fetchAllAssociative();
    }

    /**
     * Return all events where region = Ile-de-France / order by creation date / limit them by 3
     *
     * @return void
     */
    public function findAllForHomepageByLimit($eventsLimit)
    {
        $query = $this->createQueryBuilder('e') // e = Event
        ->where('e.region = 48')
        ->orderBy('e.createdAt')
        ->setMaxResults($eventsLimit)
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Return all events where region = Ile-de-France / order by creation date
     *
     * @return void
     */
    public function findAllForHomepageByRegionOrderByCreation()
    {
        $query = $this->createQueryBuilder('e') // e = Event
        ->where('e.region = 48')
        ->orderBy('e.createdAt')
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Return all events per page
     * 
     * @return void 
     */
    public function getPaginatedEvents($page, $limit)
    {
        $query = $this->createQueryBuilder('e') // e = Event
            ->orderBy('e.createdAt')
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
        
    public function findHome()
    {
        // creation of a custom query
        // https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/reference/query-builder.html
        $qb = $this->createQueryBuilder('e')
            ->select('e.id', 'e.name', 'e.image', 'e.description')
            ->setMaxResults(3);
        
        // query retrieval
        $query = $qb->getQuery();
        
        // query execute
        return $query->execute();
    }

    public function findEvent(int $event_Id)
    {
        // creation of a custom query
        // https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/reference/query-builder.html
        $qb = $this->createQueryBuilder('event')        
            ->delete('user', 'u')
            ->join('e.genres', 'g')
            ->join('e.region', 'r')
            ->where('e.id = :eventId')
            ->setParameter('eventId', $event_Id);
        
        // query retrieval
        $query = $qb->getQuery();
        
        // query execute
        return $query->execute();
    }
}

