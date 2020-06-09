<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;

CONST TAG_LENGHT = 25;

/**
 * Class TagFixture
 * @package App\DataFixtures
 */
class TagFixture extends AbstractFixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < TAG_LENGHT; $i++) {
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
