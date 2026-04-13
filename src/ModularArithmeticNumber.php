<?php
namespace Marcoconsiglio\ModularArithmetic;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;

abstract class ModularArithmeticNumber
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
    abstract public function __construct(
        int|float|string|BcMathNumber|Number $value, 
        int|float|string|BcMathNumber|Number $modulus
    );
}