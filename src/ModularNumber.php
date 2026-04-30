<?php
namespace MarcoConsiglio\ModularArithmetic;

use BcMath\Number as BcMathNumber;
use Deprecated;
use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\Operations\ModularAddition;
use MarcoConsiglio\ModularArithmetic\Operations\ModularDivision;
use MarcoConsiglio\ModularArithmetic\Operations\ModularExponentiation;
use MarcoConsiglio\ModularArithmetic\Operations\ModularMultiplication;
use MarcoConsiglio\ModularArithmetic\Operations\ModularSubtraction;

/**
 * A modular number, a.k.a. clock number. It represents a value in a ring, like
 * the hours on a clock. The length of the ring is represented by its modulus.
 */
class ModularNumber extends ModularArithmeticNumber
{
    /**
     * Construct a modular number with a $value and its $modulus.
     */
    public function __construct(
        int|float|string|BcMathNumber|Number $value, 
        int|float|string|BcMathNumber|Number $modulus
    ) {
        $value = Number::normalize($value);
        $modulus = Number::normalize($modulus);
        $this->value = $value->mod($modulus);
        $this->modulus = $modulus;
    }

    /**
     * Return true if this instance is congruent to another $number, false 
     * otherwise.
     */
    public function isCongruent(Number $number): bool
    {
        return ($this->value->sub($number)->mod($this->modulus))->eq(0);
    }

    /**
     * Alias of isCongruent() method.
     */
    public function equals(Number $number): bool
    {
        return $this->isCongruent($number);
    }

    /**
     * Sum $addend.
     */
    public function add(string|int|float|BCMathNumber|Number $addend): ModularNumber
    {
        return new ModularAddition($this, $addend)->result();
    }
    
    /**
     * Alias of add() method.
     */
    public function plus(string|int|float|BCMathNumber|Number $addend): ModularNumber
    {
        return $this->add($addend);
    }

    /**
     * Subtract $minuend.
     */
    public function subtract(string|int|float|BCMathNumber|Number $minuend): ModularNumber
    {
        return new ModularSubtraction($this, $minuend)->result();
    }

    /**
     * Alias of subtract() method.
     */
    public function sub(string|int|float|BCMathNumber|Number $minuend): ModularNumber
    {
        return $this->subtract($minuend);
    }

    /**
     * Multiply by $factor.
     */
    public function multiply(string|int|float|BCMathNumber|Number $factor): ModularNumber
    {
        return new ModularMultiplication($this, $factor)->result();
    }

    /**
     * Alias of multiply() method.
     */
    public function mul(string|int|float|BCMathNumber|Number $factor): ModularNumber
    {
        return $this->multiply($factor);
    }

    /**
     * Divide by $divisor.
     */
    public function divide(string|int|float|BCMathNumber|Number $divisor): ModularNumber
    {
        return new ModularDivision($this, $divisor)->result();
    }

    /**
     * Alias of divide() method.
     */
    public function div(string|int|float|BCMathNumber|Number $divisor): ModularNumber
    {
        return $this->divide($divisor);
    }

    /**
     * Raise to $exponent.
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
     * Return the highest integer below this number.
     */
    public function floor(): ModularNumber
    {
        return new ModularNumber(
            $this->value->floor(),
            $this->modulus
        );
    }

    /**
     * Return the lowest integer above this number.
     */
    public function ceil(): ModularNumber
    {
        return new ModularNumber(
            $this->value->ceil(),
            $this->modulus
        );
    }

    /**
     * Normalize the input type of an `$argument` to the `Number` type.
     */
    #[Deprecated("use \MarcoConsiglio\BCMathExtended\Number::normalize() instead", "version")]
    public static function normalizeArgument(int|float|string|BcMathNumber|Number $argument): Number
    {
        if ($argument instanceof Number) return $argument;
        return new Number($argument);
    }
}