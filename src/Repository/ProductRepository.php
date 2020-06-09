<?php

namespace App\Repository;

use App\Entity\Product;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public static function getEntity(): string
    {
        return Product::class;
    }
}
