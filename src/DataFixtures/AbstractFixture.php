<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

abstract class AbstractFixture extends Fixture
{
    static $faker;

    public function __construct()
    {
        self::$faker = Factory::create();
    }

}