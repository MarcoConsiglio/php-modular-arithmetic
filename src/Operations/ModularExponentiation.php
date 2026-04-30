<?php
namespace MarcoConsiglio\ModularArithmetic\Operations;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\ModularNumber;

/**
 * The exponentiation operation on a `ModularNumber`.
 */
class ModularExponentiation extends Operation
{
    /**
     * The alias for the left operand.
     */
    protected ModularNumber $base {
        get {
            return $this->a;
        }
    }

    /**
     * Construct the modular exponentiation operation.
     */
    public function __construct(
        ModularNumber $base, 
        protected int $exponent
    ) {
        $this->a = $base;
        $this->modulus = $base->modulus;
    }

    /**
     * Return the result of this operation.
     */
    public function result(): ModularNumber
    {
        $result = $this->base->value->pow($this->exponent);
        return new ModularNumber($result, $this->modulus);
    }
}