<?php
namespace Marcoconsiglio\ModularArithmetic\Tests;

use Deprecated;
use MarcoConsiglio\BCMathExtended\Number;
use BcMath\Number as BCMathNumber;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\ModularReal;
use Marcoconsiglio\ModularArithmetic\Tests\Enums\Sign;
use Override;
use PHPUnit\Framework\TestCase;
use Marcoconsiglio\ModularArithmetic\Tests\Traits\WithFaker;
use Marcoconsiglio\ModularArithmetic\Tests\Traits\WithStringFormatting;

class BaseTestCase extends TestCase
{
    use WithFaker, WithStringFormatting;

    /**
     * Arbitrary limit for float numbers generation.
     */
    const float MAX = 1_000_000.0;

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
     * Return a random non zero Number to safely use it as a modulus.
     */
    protected function randomModulus(float $min = 0, float $max = PHP_FLOAT_MAX): Number
    {
        $value = $this->nonZeroRandomFloat($min, $max); // y ≠ 0
        return new Number($this->string($value));
    }

    /**
     * Return a random Number.
     */
    protected function randomNumber(float $min = 0, float $max = PHP_FLOAT_MAX): Number
    {
        $value = $this->randomFloat($min, $max);
        return new Number($this->string($value));
    }

    /**
     * Return a random ModularNumber. Both value and modulus are random.
     */
    protected function randomModularNumber(float $min = 0, float $max = PHP_FLOAT_MAX): ModularNumber
    {
        $value = $this->randomNumber($min, $max);
        $modulus = $this->randomModulus($min, $max);
        return new ModularNumber($value, $modulus);
    }

    /**
     * Return a random ModularNumber with a specified $modulus.
     */
    protected function randomModularNumberWithModulus(Number $modulus, float $min = 0, float $max = PHP_FLOAT_MAX): ModularNumber
    {
        $value = $this->randomNumber($min, $max);
        return new ModularNumber($value, $modulus);
    }

    /**
     * Get a congruent Number to $value modulo $modulus multiplied
     * by $k.
     */
    protected function getCongruentNumber(int|string|BCMathNumber|Number $value, int|string|BCMathNumber|Number $modulus, int $k): Number
    {
        if (! $value instanceof Number) $value = new Number($value);
        if (! $modulus instanceof Number) $modulus = new Number($modulus);
        $reminder = $value->mod($modulus);
        return $modulus->mul($k)->add($reminder);
    }

    /**
     * Return a failure message when $a and $b are not congruent.
     */
    protected function congruentFailure(ModularNumber $a, ModularNumber $b): string
    {
        if ($a->modulus->not($b->modulus)) $modulus = "(mod {$a->modulus} or {$b->modulus}?)";
        else $modulus = "(mod {$a->modulus})";
        return "{$a->value} ≢ {$b->value} $modulus";
    }
}