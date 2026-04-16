<?php
namespace Marcoconsiglio\ModularArithmetic\Tests;

use MarcoConsiglio\BCMathExtended\Number;
use BcMath\Number as BCMathNumber;
use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;
use MarcoConsiglio\FakerPhpNumberHelpers\WithFakerHelpers;
use Marcoconsiglio\ModularArithmetic\ModularArithmeticNumber;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;
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
        Number $modulus
    ): ModularNumber {
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
        float $max = PHP_FLOAT_MAX
    ): ModularRelativeNumber {
        $modulus = $this->randomFloatModulus($min, $max);
        if ($modulus->isPositive())
            return new ModularRelativeNumber(
                $this->randomFloatNumber(min: 0, max: $modulus->toFloat()),
                $modulus
            );
        else
            return new ModularRelativeNumber(
                $this->randomFloatNumber(
                    min: $modulus->toFloat(), 
                    max: NextFloat::beforeZero()
                ),
                $modulus
            );
    }

    /**
     * Return a positive random `ModularRelativeNumber`.
     */
    protected function positiveRandomModularRelativeNumber(
        float $min = 0.0,
        float $max = PHP_FLOAT_MAX
    ): ModularRelativeNumber {
        $modulus = $this->positiveRandomFloatNumber($min, $max);
        return new ModularRelativeNumber(
            $this->positiveRandomFloatNumber(
                min: 0.0,
                max: $modulus->toFloat()
            ),
            $modulus
        );
    }

    /**
     * Return a negative random `ModularRelativeNumber`.
     */
    protected function negativeRandomModularRelativeNumber(
        float $min = -PHP_FLOAT_MAX,
        float $max = 0.0
    ): ModularRelativeNumber {
        $modulus = $this->negativeRandomFloatNumber($min, $max);
        return new ModularRelativeNumber(
            $this->negativeRandomFloatNumber(
                min: $modulus->toFloat(),
                max: 0.0
            ),
            $modulus
        );
    }

    /**
     * Return a random `ModularRelativeNumber` with the given `$modulus`.
     */
    protected function randomModularRelativeNumberWithModulus(
        Number $modulus
    ): ModularRelativeNumber {
        return new ModularRelativeNumber(
            $this->randomFloatNumber(
                min: $modulus->abs()->opposite()->toFloat(),
                max: $modulus->abs()->toFloat()
            ),
            $modulus
        );
    }

    /**
     * Return a positive random `ModularRelativeNumber` with the given `$modulus`.
     */
    protected function positiveRandomModularRelativeNumberWithModulus(
        Number $modulus
    ): ModularRelativeNumber {
        return new ModularRelativeNumber(
            $this->positiveRandomFloatNumber(max: $modulus->abs()->toFloat()),
            $modulus->abs()
        );
    }

    /**
     * Return a negative random `ModularRelativeNumber` with the given `$modulus`. */    
    protected function negativeRandomModularRelativeNumberWithModulus(
        Number $modulus
    ): ModularRelativeNumber {
        return new ModularRelativeNumber(
            $this->negativeRandomFloatNumber(min: $modulus->abs()->opposite()->toFloat()),
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