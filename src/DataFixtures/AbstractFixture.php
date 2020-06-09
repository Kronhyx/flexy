<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;

/**
 * Class AbstractFixture
 * @package App\DataFixtures
 */
abstract class AbstractFixture extends Fixture
{
    /**
     * @var Generator
     */
    public static Generator $faker;

    /**
     * AbstractFixture constructor.
     */
    public function __construct()
    {
        self::$faker = Factory::create();
    }

}