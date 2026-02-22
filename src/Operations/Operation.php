<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\ModularNumber;

abstract class Operation
{    
    /**
     * The left operand.
     */
    public ModularNumber $a;

    /**
     * The right operand.
     */
    public ModularNumber $b;

    /**
     * The modulus of the operation.
     */
    public protected(set) Number $modulus;

    /**
     * Return the result of this operation.
     */
    abstract public function result(): ModularNumber;

    /**
     * Construct a modular operation between $a and $b.
     *
     * @throws DifferentModulusError when $a and $b have different modulus.
     */
    public function __construct(ModularNumber $a, ModularNumber $b)
    {
        if ($a->modulus->not($b->modulus)) throw new DifferentModulusError($a, $b);
        $this->a = $a;
        $this->b = $b;
        $this->modulus = $this->a->modulus;
    }
}