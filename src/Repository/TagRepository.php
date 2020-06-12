<?php

namespace App\Repository;

use App\Entity\Tag;

/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public static function getEntity(): string
    {
        return Tag::class;
    }

    /**
     * Get the most used tags in the products
     * @param int $limit
     * @return Tag[]
     */
    public function findMostUsed(int $limit): array
    {
        $query = $this->createQueryBuilder('tag')
            ->addSelect("tag.id,tag.name")
            ->leftJoin('tag.products', 'products') // To show as well the tags without products related
            ->addSelect('COUNT(products.id) AS productsCount')
            ->groupBy('tag.id')
            ->orderBy('productsCount', 'DESC')
            ->getQuery()
            ->setMaxResults($limit);

        return $query->getResult();
    }
}
