<?php

namespace App\Repository;

use App\Entity\GoogleCache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GoogleCache|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoogleCache|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoogleCache[]    findAll()
 * @method GoogleCache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoogleCacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, GoogleCache::class);
    }

    /**
     * @return GoogleCache[]
     */
    public function findAllUnit($value): array {
        $query = $this->createQueryBuilder('p')
            ->where('p.title LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->getQuery();
        // returns an array of Product objects
        return $query->getResult();
    }

    public function findOneByAppId($appId): ?GoogleCache
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.appId = :val')
            ->setParameter('val', $appId)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * SELECT g.id, g.app_id, s.*
     *  FROM google_cache AS g
     *  INNER JOIN statistics AS s
     *  ON g.id=s.google_cache_id AND g.app_id='pro.qeep.rebro';
     * @var string $value
     */
    public function findInnerJoinField($appId) {
        $query = $this->createQueryBuilder('g')
            ->innerJoin('g.statistics', 's', 'WITH', 'g.appId=:val')
            ->addSelect('s')
            ->setParameter('val', $appId);

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return GoogleUnitr[] Returns an array of GoogleUnitr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GoogleUnit
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}