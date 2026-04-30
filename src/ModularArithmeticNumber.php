<?php
namespace MarcoConsiglio\ModularArithmetic;

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
     * Cast to `string` this instance.
     */
    public function __toString(): string
    {
        return "{$this->value} (mod {$this->modulus})";
    }
}