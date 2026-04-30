<?php
namespace MarcoConsiglio\ModularArithmetic\Operations;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\ModularArithmeticNumber;
use MarcoConsiglio\ModularArithmetic\ModularNumber;

/**
 * An `Operation` of the modular arithmetic.
 */
abstract class Operation
{    
    /**
     * The right operand.
     */
    protected Number $b;

    /**
     * The modulus of the operation.
     */
    protected Number $modulus;

    /**
     * Construct a modular operation between `$a` and `$b`.
     */
    public function __construct(
        protected ModularNumber $a, 
        string|int|float|BCMathNumber|Number $b
    ) {
        $this->b = Number::normalize($b);
        $this->modulus = $this->a->modulus;
    }

    /**
     * Return the result of this `Operation`.
     */
    abstract public function result(): ModularArithmeticNumber;
}