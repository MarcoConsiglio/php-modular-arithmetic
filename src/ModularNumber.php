<?php
namespace Marcoconsiglio\ModularArithmetic;

use BcMath\Number as BcMathNumber;
use Deprecated;
use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Operations\ModularAddition;
use Marcoconsiglio\ModularArithmetic\Operations\ModularExponentiation;
use Marcoconsiglio\ModularArithmetic\Operations\ModularMultiplication;

/**
 * A modular number, a.k.a. clock number. It represents a value in a ring, like
 * the hours on a clock. The length of the ring is represented by its modulus.
 */
class ModularNumber
{
    /**
     * The value of this modular number.
     */
    public protected(set) Number $value;

    /**
     * The modulus of this modular number.
     */
    public protected(set) Number $modulus;

    /**
     * Construct a modular number with a $value and its $modulus.
     */
    public function __construct(int|string|BcMathNumber|Number $value, int|string|BcMathNumber|Number $modulus)
    {
        $value = $this->normalizeArgument($value);
        $modulus = $this->normalizeArgument($modulus);
        $this->value = $value->mod($modulus);
        $this->modulus = $modulus;
    }

    /**
     * Return true if this instance is congruent to another $number, false 
     * otherwise.
     */
    public function isCongruent(ModularNumber $number): bool
    {
        if ($this->modulus->not($number->modulus)) return false;
        return ($this->value->sub($number->value)->mod($this->modulus))->eq(0);
    }

    /**
     * Alias of isCongruent() method.
     */
    public function equals(ModularNumber $number): bool
    {
        return $this->isCongruent($number);
    }

    /**
     * Sum this instance with $number.
    *
    * @throws DifferentModulusError when this instance and $number have
    * different modulus.
    */
    public function add(ModularNumber $addend): ModularNumber
    {
        return new ModularAddition($this, $addend)->result();
    }
    
    /**
     * Alias of add() method.
     */
    public function plus(ModularNumber $addend): ModularNumber
    {
        return $this->add($addend);
    }

    /**
     * Multiply this instance by $number.
     */
    public function multiply(ModularNumber $factor): ModularNumber
    {
        return new ModularMultiplication($this, $factor)->result();
    }

    /**
     * Alias of multiply() method.
     */
    public function mul(ModularNumber $factor): ModularNumber
    {
        return $this->multiply($factor);
    }

    /**
     * Raise this instance to $exponent.
     */
    public function power(int $exponent): ModularNumber
    {
        return new ModularExponentiation($this, $exponent)->result();
    }

    /**
     * Alias of power() method.
     */
    public function pow(int $exponent): ModularNumber
    {
        return $this->power($exponent);
    }

    /**
     * Normalize the input type of an $argument to the Number type.
     */
    protected function normalizeArgument(int|string|BcMathNumber|Number $argument): Number
    {
        if ($argument instanceof Number) return $argument;
        return new Number($argument);
    }
}