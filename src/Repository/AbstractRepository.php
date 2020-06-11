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
     * @return string
     */
    abstract public static function getEntity(): string;
}