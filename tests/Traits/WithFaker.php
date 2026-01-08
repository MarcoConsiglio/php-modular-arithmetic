<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Traits;

use Faker\Factory;
use Faker\Generator;

trait WithFaker
{
    /**
     * The FakerPHP random generator.
     */
    protected Generator $faker;

    /**
     * Set up the FakerPHP generator.
     */
    protected function setUpFaker(): void
    {
        $this->faker = Factory::create(Factory::DEFAULT_LOCALE);
    }
}