<?php

namespace App\Repository;

use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Genre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genre[]    findAll()
 * @method Genre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Genre $entity, bool $flush = true): void
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
    public function remove(Genre $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    
    public function findAllGenres()
    {
        // creation of a custom query
        // https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/reference/query-builder.html
        $qb = $this->createQueryBuilder('g')
            ->select('g.id', 'g.name', 'g.image')
            ->orderBy('g.name', 'ASC')
        ;
        // query retrieval
        $query = $qb->getQuery();
        
        // query execute
        return $query->execute();
    }

    /**
     * Return all genres per page
     * 
     * @return void 
     */
    public function getPaginatedGenres($page, $limit)
    {
        $query = $this->createQueryBuilder('g') // g = Genre
            ->orderBy('g.name')
            // Defines the number of the first element to be retrieved
            ->setFirstResult(($page * $limit) - $limit)
            // Defines the maximum number of genres per page
            ->setMaxResults($limit)
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Returns number of genres
     *
     * @return void
     */
    public function getTotalGenres()
    {
        $query = $this->createQueryBuilder('g') // g = Genre
            ->select('COUNT(g)')
        ;

        // For result, only return base type, not arrays, not objects
        return $query->getQuery()->getSingleScalarResult();
    }    

    // /**
    //  * @return Genre[] Returns an array of Genre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Genre
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
}
