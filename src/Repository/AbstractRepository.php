<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class AbstractRepository
 * @package App\Repository
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * AbstractRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, static::getEntity());
    }

    /**
     * This method is in charge of solving the entity to which this repository is referenced
     * @return string
     */
    abstract public static function getEntity(): string;
}