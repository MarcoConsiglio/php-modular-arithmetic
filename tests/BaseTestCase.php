<?php
namespace Marcoconsiglio\ModularArithmetic\Tests;

use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Override;
use PHPUnit\Framework\TestCase;
use Marcoconsiglio\ModularArithmetic\Tests\Traits\WithFaker;

class BaseTestCase extends TestCase
{
    use WithFaker;

    /**
     * The max integer allowed to avoid integer overflow.
     * 
     * This value is completely arbitrary and does not guarantee that integer
     * overflow will be avoided.
     */
    protected const int MAX_INTEGER = 1000000;

    /**
     * This method is called before each test.
     */
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }

   /**
     * Return a random sign.
     * 
     * The returning value is a factor that multiply the number you want to set
     * the sign on.
     *
     * @return integer
     */
    protected function randomSign(): int
    {
        return $this->faker->randomElement([1, -1]);
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
     * Return a random ModularInteger
     * with a random modulus.
     *
     * @param integer $min
     * @param integer $max
     * @return ModularInteger
     */
    protected function randomModularInteger($min = 0, $max = 2147483647): ModularInteger
    {
        return new ModularInteger(
            $this->randomInteger($min, $max),
            $this->randomInteger($min, $max, 1)
        );
    }

    /**
     * Get a congruent integer number to $value modulo $modulus multiplied
     * by $k.
     *
     * @param integer $value
     * @param integer $modulus
     * @param integer $k
     * @return integer
     */
    protected function getCongruentIntegerValue(int $value, int $modulus, int $k): int
    {
        $reminder = $value % $modulus;
        return $k * $modulus + $reminder;
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