<?php


namespace App\Repository;


use App\Entity\Board;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

class BoardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Board::class);
    }

    public function findAll()
    {
        return $this->findBy([], ['id' => 'ASC']);
    }

    public function last(): Board
    {
        try {
            return $this->createQueryBuilder("b")
                ->orderBy("b.id", "DESC")
                ->setMaxResults(1)
                ->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}