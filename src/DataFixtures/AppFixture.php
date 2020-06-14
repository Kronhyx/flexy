<?php

namespace App\DataFixtures;

use App\Entity\{Product, Tag};
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class AppFixture
 * @package App\DataFixtures
 */
class AppFixture extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * @return array|string[]
     */
    public function getDependencies(): array
    {
        return [ProductFixture::class, TagFixture::class];
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $products = new ArrayCollection($manager->getRepository(Product::class)->findAll());
        $tags = new ArrayCollection($manager->getRepository(Tag::class)->findAll());

        //Add some tags by each product founded
        $products->map(fn(Product $product) => $this->addTagsToProduct($product, $tags, $manager));

        $manager->flush();
    }

    /**
     * Taking a Product as parameter add several tags to this product
     * @param Product $product
     * @param ArrayCollection $tags
     * @param ObjectManager $manager
     */
    protected function addTagsToProduct(Product $product, ArrayCollection $tags, ObjectManager $manager): void
    {
        // Get some random tags
        $randomTags = static::$faker->randomElements($tags->toArray(), static::$faker->numberBetween(1, count($tags)));

        // Walk randomTags and add to Product
        foreach ($randomTags as $tag) {
            $product->addTag($tag);
            $manager->persist($product);
        }

    }
}
