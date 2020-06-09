<?php

namespace App\DataFixtures;

use App\Entity\{Product};
use Doctrine\Persistence\ObjectManager;

/**
 * Class ProductFixture
 * @package App\DataFixtures
 */
class ProductFixture extends AbstractFixture
{
    protected const PRODUCT_LENGHT = 20;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::PRODUCT_LENGHT; $i++) {
            $product = $this->generateProduct();
            $manager->persist($product);
        }

        $manager->flush();
    }

    /**
     * @return Product
     */
    private function generateProduct(): Product
    {
        $product = new Product();

        $product
            ->setTitle(static::$faker->company)
            ->setDescription(static::$faker->text(4000))
            ->setImage(static::$faker->imageUrl())
            ->setPrice(static::$faker->randomFloat(2, 0, 100))
            ->setStock(static::$faker->randomDigit);

        return $product;
    }


}
