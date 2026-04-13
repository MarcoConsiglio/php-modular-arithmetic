<?php
namespace Marcoconsiglio\ModularArithmetic;

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
}