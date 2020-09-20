<?php

namespace App\Repository;

use App\Entity\Filter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Filter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filter[]    findAll()
 * @method Filter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Filter::class);
    }

    public function findOneByIdJoinedToProfile($profileId)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT p, f
            FROM App\Entity\Filter f
            INNER JOIN f.profiles p
            WHERE p.id = :id'
            )->setParameter('id', $profileId);

        return $query->getOneOrNullResult();
    }

    /**
     * @param $value
     * @return Filter|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneFilter($value): ?Filter {
        return $this->createQueryBuilder('c')
            ->andWhere('c.keyword = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return FilterScraper[] Returns an array of ConfigScraper objects
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
    public function findOneBySomeField($value): ?Filter
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
