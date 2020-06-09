<?php

namespace App\DataFixtures;

use App\Entity\{Product, Tag};
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $product = new Product();
        $product
            ->setTitle($faker->company)
            ->setDescription($faker->text(4000))
            ->setImage($faker->imageUrl())
            ->setPrice($faker->randomFloat(2, 0, 100))
            ->setStock($faker->randomDigit);

        $tag = new Tag();
        $tag->setName($faker->jobTitle);

        $product->addTag($tag);

        $manager->persist($product);
        $manager->flush();
    }
}
