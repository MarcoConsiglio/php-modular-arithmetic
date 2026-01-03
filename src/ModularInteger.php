<?php
namespace Marcoconsiglio\ModularArithmetic;

use DivisionByZeroError;
use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularAddition;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularMultiplication;

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
     * @param integer $modulus The modulus of the modular set of which this 
     * number is a part.
     * 
     * Keep in mind that PHP always treats the right operand of the modulo 
     * operation as an absolute (positive) value, meaning that every negative
     * value of this parameter is treated as a positive value. The same is not
     * true for a traditional calculator.
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
     *
     * @param ModularInteger $number
     * @return boolean
     * @throws DifferentModulusError when this instance has a modulus different
     * from the modulus of $number. 
     */
    public function isCongruent(ModularInteger $number): bool
    {
        if ($this->modulus != $number->modulus) throw new DifferentModulusError($this, $number);
        return ($this->value - $number->value) % $this->modulus == 0;
    }

    /**
     * Alias of isCongruent() method.
     *
     * @param ModularInteger $number
     * @return boolean
     * @throws DifferentModulusError when this instance has a modulus different
     * from the modulus of $number. 
     */
    public function equals(ModularInteger $number): bool
    {
        return $this->isCongruent($number);
    }

    /**
     * Sum this instance with $number.
     *
     * @param ModularInteger $number
     * @return ModularInteger
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
     * @param ModularInteger $number
     * @return ModularInteger
     */
    public function multiply(ModularInteger $number): ModularInteger
    {
        return new IntegerModularMultiplication($this, $number)->result();
    }
}