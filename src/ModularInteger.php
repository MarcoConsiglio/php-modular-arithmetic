<?php
namespace Marcoconsiglio\ModularArithmetic;

use DivisionByZeroError;
use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularAddition;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularExponentiation;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularMultiplication;

/**
 * A integer number along with its modulus.
 * 
 * For example, if this instance referred the hour 21, 
 * its value would be 9 and its modulus would be 12.
 */
class ModularInteger
{
    /**
     * The value of this number.
     */
    public protected(set) int $value;

    /**
     * The modulus of the modular set of which this number is a part.
     *
     * For example, for the hours on a clock, the modulus is 12.
     */
    public protected(set) int $modulus;

    /**
     * Construct an integer modular number.
     *
     * @param integer $value The value of this modular number.
     * @param integer $modulus The modulus of the modular set of which this 
     * number is a part.
     * 
     * Keep in mind that PHP always treats the modulus as absolute value, 
     * meaning that every negative modulus is treated as a positive value. 
     * The same is not true for a traditional calculator app.
     * @throws DivisionByZeroError when $modulus equals zero.
     */
    public function __construct(int $value, int $modulus)
    {
        $this->value = $value % $modulus;
        $this->modulus = $modulus;
    }

    /**
     * Return true if this instance is congruent to $number,
     * false otherwise.
     */
    public function isCongruent(ModularInteger $number): bool
    {
        if ($this->modulus != $number->modulus) return false;
        return ($this->value - $number->value) % $this->modulus == 0;
    }

    /**
     * Alias of isCongruent() method.
     */
    public function equals(ModularInteger $number): bool
    {
        return $this->isCongruent($number);
    }

    /**
     * Sum this instance with $number.
     *
     * @throws DifferentModulusError when this instance and $number have
     * different modulus.
     */
    public function add(ModularInteger $number): ModularInteger
    {
        return new IntegerModularAddition($this, $number)->result();
    }

    /**
     * Multiply this instance with $number.
     * 
     * @throws DifferentModulusError when this instance and $number have
     * different modulus.
     */
    public function multiply(ModularInteger $number): ModularInteger
    {
        return new IntegerModularMultiplication($this, $number)->result();
    }

    /**
     * Raise this instance to power $k.
     */
    public function power(int $k): ModularInteger
    {
        return new IntegerModularExponentiation($this, $k)->result();
    }
}