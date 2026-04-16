<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\ModularArithmeticNumber;

/**
 * An `Operation` of the modular arithmetic.
 */
abstract class Operation
{    
    /**
     * The left operand.
     */
    public ModularArithmeticNumber $a;

    /**
     * The right operand.
     */
    public Number $b;

    /**
     * The modulus of the operation.
     */
    public protected(set) Number $modulus;

    /**
     * Construct a modular operation between `$a` and `$b`.
     */
    public function __construct(ModularArithmeticNumber $a, Number $b)
    {
        $this->a = $a;
        $this->b = $b;
        $this->modulus = $this->a->modulus;
    }

    /**
     * Return the result of this `Operation`.
     */
    abstract public function result(): ModularArithmeticNumber;
}