<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use Override;
use Faker\Factory;
use Faker\Generator;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
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

    protected function randomSign(): int
    {
        return $this->faker->randomElement();
    }
    /**
     * Return a random integer.
     *
     * @param integer $min
     * @param integer $max
     * less than 0 return a negative number.
     * @param integer|null $sign If greater than zero return a positive number, if
     * less than zero return a negative number. If $sign is null, the returning 
     * value sign will be random.
     * @return integer
     */
    protected function randomInteger($min = 0, $max = 2147483647, $sign = null): int
    {
        if ($sign !== null) return $this->randomSign() * $this->faker->numberBetween(abs($min), abs($max));
        if ($sign >= 0) $sign = 1;
        if ($sign < 0) $sign = -1;
        return $sign * $this->faker->numberBetween(abs($min), abs($max));
    }

    /**
     * Return a random positive integer.
     *
     * @param integer $min
     * @param integer $max
     * @return integer
     */
    protected function positiveRandomInteger($min = 0, $max = 2147483647): int
    {
        return $this->randomInteger(abs($min), abs($max), 1);
    }

    /**
     * Return a random integer except for zero.
     *
     * @param integer $min
     * @param integer $max
     * @return integer
     */
    protected function nonZeroRandomInteger($min = 1, $max = 2147483647): int
    {
        $min = abs($min);
        if ($min == 0) $min = 1;
        return $this->randomInteger($min);
    }

    /**
     * Return a random negative number.
     *
     * @param integer $min
     * @param integer $max
     * @return integer
     */
    protected function negativeRandomInteger($min = 0, $max = 2147483647): int
    {
        return $this->randomInteger(abs($min), abs($max), -1);
    }

    /**
     * Return a failure message when $a and $b are not congruent.
     *
     * @param ModularInteger $a
     * @param ModularInteger $b
     * @return string
     */
    protected function congruentFailure(ModularInteger $a, ModularInteger $b): string
    {
        return "$a->value is not congruent to $b->value";
    }
}