<?php
namespace Marcoconsiglio\ModularArithmetic;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use Stringable;

/**
 * A number of the modular arithmetic branch.
 */
abstract class ModularArithmeticNumber implements Stringable
{
    /**
     * The value of this modular number.
     */
    public protected(set) Number $value;

    /**
     * The modulus of this modular number.
     */
    public protected(set) Number $modulus;

    /**
     *  Construct a `ModularArithmeticNumber`.
     */
    abstract protected function __construct(
        int|float|string|BcMathNumber|Number $value, 
        int|float|string|BcMathNumber|Number $modulus
    );

    /**
     * Normalize the input type of an $argument to the Number type.
     */
    protected function normalizeArgument(int|float|string|BcMathNumber|Number $argument): Number
    {
        if ($argument instanceof Number) return $argument;
        return new Number($argument);
    }

    /**
     * Cast to `string` this instance.
     */
    public function __toString(): string
    {
        return "{$this->value} (mod {$this->modulus})";
    }
}