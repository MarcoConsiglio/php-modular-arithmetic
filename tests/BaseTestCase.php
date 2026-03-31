<?php
namespace Marcoconsiglio\ModularArithmetic\Tests;

use MarcoConsiglio\BCMathExtended\Number;
use BcMath\Number as BCMathNumber;
use MarcoConsiglio\FakerPhpNumberHelpers\WithFakerHelpers;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Override;
use PHPUnit\Framework\TestCase;
use Marcoconsiglio\ModularArithmetic\Tests\Traits\WithStringFormatting;

class BaseTestCase extends TestCase
{
    use WithFakerHelpers;

    /**
     * Arbitrary limit for float numbers generation.
     */
    const float MAX = 1_000_000.0;

    /**
     * Arbitrary limit for float numbers generation.
     */
    const float MIN = -self::MAX;

    /**
     * This method is called before each test.
     */
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        self::setUpFaker();
    }

    /**
     * Return a random non zero `Number` to safely use it as a modulus.
     */
    protected function randomModulus(float $min = -PHP_FLOAT_MAX, float $max = PHP_FLOAT_MAX): Number
    {
        $value = $this->nonZeroRandomFloat($min, $max);
        return new Number(Number::string($value));
    }

    /**
     * Return a random `Number`.
     */
    protected function randomNumber(float $min = -PHP_FLOAT_MAX, float $max = PHP_FLOAT_MAX): Number
    {
        $value = $this->randomFloat($min, $max);
        return new Number(Number::string($value));
    }

    /**
     * Return a random `ModularNumber`. Both value and modulus are random.
     */
    protected function randomModularNumber(float $min = -PHP_FLOAT_MAX, float $max = PHP_FLOAT_MAX): ModularNumber
    {
        $value = $this->randomNumber($min, $max);
        $modulus = $this->randomModulus($min, $max);
        return new ModularNumber($value, $modulus);
    }

    /**
     * Return a random `ModularNumber` with a specified `$modulus`.
     */
    protected function randomModularNumberWithModulus(
        Number $modulus, 
        float $min = -PHP_FLOAT_MAX, 
        float $max = PHP_FLOAT_MAX
    ): ModularNumber {
        return new ModularNumber(
            $this->randomNumber($min, $max), 
            $modulus
        );
    }

    /**
     * Get a `Number` congruent to `$value` modulo `$modulus` multiplied
     * by `$k`.
     */
    protected function getCongruentNumber(
        int|string|BCMathNumber|Number $value, 
        int|string|BCMathNumber|Number $modulus, 
        int $k
    ): Number {
        if (! $value instanceof Number) $value = new Number($value);
        if (! $modulus instanceof Number) $modulus = new Number($modulus);
        $reminder = $value->mod($modulus);
        return $modulus->mul($k)->add($reminder);
    }

    /**
     * Return a failure message when `$a` and `$b` are not congruent.
     */
    protected function congruentFailure(ModularNumber $a, ModularNumber $b): string
    {
        $modulus = $a->modulus->not($b->modulus) ? 
            "(mod {$a->modulus} or {$b->modulus}?)" : 
            "(mod {$a->modulus})";
        return "{$a->value} ≢ {$b->value} $modulus";
    }
}