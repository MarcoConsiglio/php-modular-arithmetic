<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\ModularArithmeticNumber;

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
     * Return the result of this operation.
     */
    abstract public function result(): ModularArithmeticNumber;

    /**
     * Construct a modular operation between $a and $b.when $a and $b have different modulus.
     */
    public function __construct(ModularArithmeticNumber $a, Number $b)
    {
        // if ($a->modulus->not($b->modulus)) throw new DifferentModulusError($a, $b);
        $this->a = $a;
        $this->b = $b;
        $this->modulus = $this->a->modulus;
    }
}