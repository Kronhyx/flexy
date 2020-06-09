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

        $products->map(fn(Product $product) => $this->addTagsToProduct($product, $tags, $manager));

        $manager->flush();
    }

    /**
     * @param Product $product
     * @param ArrayCollection $tags
     * @param ObjectManager $manager
     */
    protected function addTagsToProduct(Product $product, ArrayCollection $tags, ObjectManager $manager): void
    {
        // Get some random tags
        $randomTags = static::$faker->randomElements($tags->toArray(), static::$faker->numberBetween(1, count($tags)));

        // Walk random tags and add to Product
        foreach ($randomTags as $tag) {
            $product->addTag($tag);
            $manager->persist($product);
        }

    }
}
