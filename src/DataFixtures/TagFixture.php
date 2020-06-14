<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;

/**
 * Class TagFixture
 * @package App\DataFixtures
 */
class TagFixture extends AbstractFixture
{
    protected const TAG_LENGHT = 25;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::TAG_LENGHT; $i++) {
            $tag = $this->generateTag();
            $manager->persist($tag);
        }

        $manager->flush();
    }

    /**
     * @return Tag
     */
    private function generateTag(): Tag
    {
        $product = new Tag();

        $product->setName(static::$faker->jobTitle);

        return $product;
    }

}
