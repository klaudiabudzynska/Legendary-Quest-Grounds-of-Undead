<?php


namespace App\Repository;


use App\Entity\GameElements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GameElementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameElements::class);
    }

    public function findAll()
    {
        return $this->findBy([], ['id' => 'ASC']);
    }
}