<?php
namespace Marcoconsiglio\ModularArithmetic;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;

class ModularRelativeNumber extends ModularArithmeticNumber
{
    protected function __construct(
        int|float|string|BcMathNumber|Number $value, 
        int|float|string|BcMathNumber|Number $modulus
    ) {
        $value = $this->normalizeArgument($value);
        $modulus = $this->normalizeArgument($modulus);
        if ($value->isPositive()) 
            $this->modulus = $modulus->abs();
        else
            $this->modulus = $modulus->abs()->opposite(); 
        $this->value = $value->mod($this->modulus);
    }

    /**
     * Create a `ModularRelativeNumber` from its `$value` and the 
     * `$circumference` of its ring.
     */
    public static function createFromCircumference(
        Number $value, 
        Number $circumference
    ): ModularRelativeNumber {
        return new ModularRelativeNumber($value, $circumference);
    }

    /**
     * Create a `ModularRelativeNumber` from its `$value` and the length
     * between the `$ring_start` and `$ring_end`.
     */
    public static function createFromRingExtremes(
        Number $value,
        Number $ring_start,
        Number $ring_end
    ): ModularArithmeticNumber {
        return new ModularRelativeNumber(
            $value,
            $ring_end->abs()->plus($ring_start->abs())
        );
    }
}