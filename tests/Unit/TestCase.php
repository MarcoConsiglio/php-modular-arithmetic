<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use Override;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    /**
     * The Faker random generator.
     *
     * @var Generator
     */
    protected Generator $faker;


    /**
     * This method is called before each test.
     */
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create(Factory::DEFAULT_LOCALE);
    }
}