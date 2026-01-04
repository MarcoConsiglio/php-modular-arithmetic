<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Traits;

use Faker\Factory;
use Faker\Generator;

trait WithFaker
{
    /**
     * The FakerPHP random generator.
     *
     * @var Generator
     */
    protected Generator $faker;

    /**
     * Set up the FakerPHP generator.
     *
     * @return void
     */
    protected function setUpFaker(): void
    {
        $this->faker = Factory::create(Factory::DEFAULT_LOCALE);
    }
}