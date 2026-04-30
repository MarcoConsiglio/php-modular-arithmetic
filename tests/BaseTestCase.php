<?php
namespace MarcoConsiglio\ModularArithmetic\Tests;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\FakerPhpNumberHelpers\WithFakerHelpers;
use MarcoConsiglio\ModularArithmetic\ModularArithmeticNumber;
use MarcoConsiglio\ModularArithmetic\ModularNumber;
use MarcoConsiglio\ModularArithmetic\ModularRelativeNumber;
use MarcoConsiglio\ModularArithmetic\Ring;
use Override;
use PHPUnit\Framework\TestCase;

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

    
    // ╔═════════════════╗
    // ║ Modulus (float) ║
    // ╚═════════════════╝

    /**
     * Return a random relative decimal modulus.
     */
    protected function randomFloatModulus(
        float $min = -PHP_FLOAT_MAX, 
        float $max = PHP_FLOAT_MAX
    ): Number {
        return new Number($this->nonZeroRandomFloat($min, $max));
    }

    /**
     * Return a positive random decimal modulus.
     */
    protected function positiveRandomFloatModulus(
        float $min = 0.0,
        float $max = PHP_FLOAT_MAX
    ): Number {
        return new Number($this->positiveNonZeroRandomFloat($min, $max));
    }

    /**
     * Return a negative random decimal modulus.
     */
    protected function negativeRandomFloatModulus(
        float $min = -PHP_FLOAT_MAX,
        float $max = 0.0
    ): Number {
        return new Number($this->negativeNonZeroRandomFloat($min, $max));
    }

    // ╔═══════════════╗
    // ║ Modulus (int) ║
    // ╚═══════════════╝

    /**
     * Return a relative random `int` type modulus.
     */
    protected function randomIntegerModulus(
        int $min = PHP_INT_MIN, 
        int $max = PHP_INT_MAX
    ): Number {
        return new Number($this->nonZeroRandomInteger($min, $max));
    }

    /**
     * Return a positive random `int` type modulus.
     */
    protected function positiveRandomIntegerModulus(
        int $min = 1, 
        int $max = PHP_INT_MAX
    ): Number {
        return new Number(
            $this->nonZeroRandomInteger($min, $max)
        );
    }

    /**
     * Return a negative random `int` type modulus.
     */
    protected function negativeRandomIntegerModulus(
        int $min = PHP_INT_MIN,
        int $max = -1
    ): Number {
        return new Number(
            $this->negativeRandomInteger($min, $max)
        );
    }

    // ╔════════════════╗
    // ║ Number (float) ║
    // ╚════════════════╝

    /**
     * Return a relative random decimal `Number`.
     */
    protected function randomFloatNumber(
        float $min = -PHP_FLOAT_MAX, 
        float $max = PHP_FLOAT_MAX
    ): Number {
        return new Number($this->randomFloat($min, $max));
    }

    /**
     * Return a positive random decimal `Number`.
     */
    protected function positiveRandomFloatNumber(
        float $min = 0.0,
        float $max = PHP_FLOAT_MAX
    ): Number {
        return new Number($this->positiveRandomFloat($min, $max));
    }

    /**
     * Return a negative random decimal `Number`.
     */
    protected function negativeRandomFloatNumber(
        float $min = -PHP_FLOAT_MAX,
        float $max = 0.0
    ): Number {
        return new Number($this->negativeRandomFloat($min, $max));
    }

    // ╔══════════════╗
    // ║ Number (int) ║
    // ╚══════════════╝

    /**
     * Return a random relative integer `Number`.
     */
    protected function randomIntNumber(
        int $min = PHP_INT_MIN,
        int $max = PHP_INT_MAX
    ): Number {
        return new Number(
            $this->randomInteger($min, $max)
        );
    }

    /**
     * Return a positive random integer `Number`.
     */
    protected function positiveRandomIntNumber(
        int $min = 0,
        int $max = PHP_INT_MAX
    ): Number {
        return new Number(
            $this->positiveRandomInteger($min, $max)
        );
    }

    /**
     * Return a negative random integer `Number`
     */
    protected function negativeRandomIntNumber(
        int $min = PHP_INT_MIN,
        int $max = -1
    ): Number {
        return new Number(
            $this->negativeRandomInteger($min, $max)
        );
    }

    // ╔═══════════════╗
    // ║ ModularNumber ║
    // ╚═══════════════╝

    /**
     * Return a random `ModularNumber`. Both value and modulus are random.
     */
    protected function randomModularNumber(
        float $min = -PHP_FLOAT_MAX, 
        float $max = PHP_FLOAT_MAX
    ): ModularNumber {
        $modulus = $this->randomFloatModulus($min, $max);
        $value = $this->randomFloatNumber(
            $modulus->abs()->opposite()->toFloat(), 
            $modulus->abs()->toFloat()
        );
        return new ModularNumber($value, $modulus);
    }

    /**
     * Return a random `ModularNumber` with the given `$modulus`.
     */
    protected function randomModularNumberWithModulus(
        int|float|string|BcMathNumber|Number $modulus
    ): ModularNumber {
        $modulus = Number::normalize($modulus);
        return new ModularNumber(
            $this->randomFloatNumber(
                min: $modulus->abs()->opposite()->toFloat(), 
                max: $modulus->abs()->toFloat()
            ),
            $modulus
        );
    }


    // ╔═══════════════════════╗
    // ║ ModularRelativeNumber ║
    // ╚═══════════════════════╝

    /**
     * Return a random `ModularRelativeNumber`.
     */
    protected function randomModularRelativeNumber(
        float $min = -PHP_FLOAT_MAX, 
        float $max = PHP_FLOAT_MAX,
        int $precision = PHP_FLOAT_DIG
    ): ModularRelativeNumber {
        return ModularRelativeNumber::createFromExtremes(
            $this->randomFloat($min, $max, $precision),
            $min, $max
        );
    }

    /**
     * Return a positive random `ModularRelativeNumber`.
     */
    protected function positiveRandomModularRelativeNumber(
        float $min = 0.0,
        float $max = PHP_FLOAT_MAX,
        int $precision = PHP_FLOAT_DIG
    ): ModularRelativeNumber {
        return ModularRelativeNumber::createFromExtremes(
            $this->positiveRandomFloat($min, $max, $precision),
            $min, $max
        );
    }

    /**
     * Return a negative random `ModularRelativeNumber`.
     */
    protected function negativeRandomModularRelativeNumber(
        float $min = -PHP_FLOAT_MAX,
        float $max = 0.0,
        int $precision = PHP_FLOAT_DIG
    ): ModularRelativeNumber {
        return ModularRelativeNumber::createFromExtremes(
            $this->negativeRandomFloat($min, $max, $precision),
            $min, $max
        );
    }

    /**
     * Return a random `ModularRelativeNumber` within the given `$ring`.
     */
    protected function randomModularRelativeNumberWithRing(
        Ring $ring,
        int $precision = PHP_FLOAT_DIG
    ): ModularRelativeNumber {
        return ModularRelativeNumber::createFromRing(
            $this->randomFloat(
                $ring->start->toFloat(), 
                $ring->end->toFloat(), 
                $precision
            ), $ring
        );
    }

    /**
     * Return a positive random `ModularRelativeNumber` within the given `$ring`.
     */
    protected function positiveRandomModularRelativeNumberWithRing(
        Ring $ring,
        int $precision = PHP_FLOAT_DIG
    ): ModularRelativeNumber {
        return ModularRelativeNumber::createFromRing(
            $this->positiveRandomFloat(
                $ring->start->toFloat($precision),
                $ring->end->toFloat($precision),
                $precision
            ), $ring
        );
    }

    /**
     * Return a negative random `ModularRelativeNumber` within the given `$ring`. 
     */    
    protected function negativeRandomModularRelativeNumberWithRing(
        Ring $ring,
        int $precision = PHP_FLOAT_DIG
    ): ModularRelativeNumber {
        return ModularRelativeNumber::createFromRing(
            $this->negativeRandomFloat(
                $ring->start->toFloat($precision),
                $ring->end->toFloat($precision),
                $precision
            ), $ring
        );
    }

    /**
     * Get a `Number` congruent to `$value` modulo `$modulus` multiplied
     * by `$k`.
     */
    protected function getCongruentNumber(
        ModularNumber $number,
        int $k = 1
    ): Number {
        $reminder = $number->value->mod($number->modulus);
        return $number->modulus->mul($k)->add($reminder);
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

    protected function additionFailure(
        ModularArithmeticNumber $a, 
        ModularArithmeticNumber|Number $b,
        ModularArithmeticNumber $sum
    ): string {
        if ($b->isPositive())
            return "{$a} + {$b} = $sum";
        else
            return "{$a} + [{$b}] = $sum";
    }
}