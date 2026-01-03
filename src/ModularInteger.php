<?php
namespace Marcoconsiglio\ModularArithmetic;

use DivisionByZeroError;

class ModularInteger
{
    /**
     * The value of this number.
     *
     * @var integer
     */
    public protected(set) int $value;

    /**
     * The modulus of the modular set of which this number is a part.
     * 
     * For example, for the hours on a clock, the modulus is 12.
     * 
     * @var integer
     */
    public protected(set) int $modulus;

    /**
     * Construct an integer modular number.
     *
     * @param integer $value The value of this modular number.
     * @param integer $modulus The modulus of the modular set of which this number is a part.
     * 
     * Keep in mind that PHP always treats the right operand of the modulo operation as an
     * absolute (positive) value, meaning that every negative value of this parameter is treated
     * as a positive value. 
     * @throws DivisionByZeroError when $modulus is zero.
     */
    public function __construct(int $value, int $modulus)
    {
        $this->value = $value % $modulus;
        $this->modulus = $modulus;
    }

    public function isCongruent(ModularInteger $number): bool
    {
        if ($this->modulus != $number->modulus) return false;
        return ($this->value - $number->value) % $this->modulus == 0;
    }

    public function equals(ModularInteger $modularInteger): bool
    {
        return $this->isCongruent($modularInteger);
    }
}