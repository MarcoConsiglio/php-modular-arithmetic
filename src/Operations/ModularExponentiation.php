<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\ModularNumber;

/**
 * The exponentiation operation between two ModularNumber(s).
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
     * The right operand.
     */
    protected Number $exponent;

    /**
     * Construct the modular exponentiation operation.
     *
     * @param ModularInteger $a
     */
    public function __construct(ModularNumber $base, int $exponent)
    {
        $this->exponent = new Number($exponent);
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