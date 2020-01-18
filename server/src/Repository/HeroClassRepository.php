<?php

namespace App\Repository;

use App\Entity\HeroClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HeroClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeroClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeroClass[]    findAll()
 * @method HeroClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeroClass::class);
    }

    // /**
    //  * @return HeroClass[] Returns an array of HeroClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeroClass
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
