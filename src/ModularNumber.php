<?php
namespace Marcoconsiglio\ModularArithmetic;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Operations\ModularAddition;
use Marcoconsiglio\ModularArithmetic\Operations\ModularDivision;
use Marcoconsiglio\ModularArithmetic\Operations\ModularExponentiation;
use Marcoconsiglio\ModularArithmetic\Operations\ModularMultiplication;
use Marcoconsiglio\ModularArithmetic\Operations\ModularSubtraction;

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
     * Sum $addend.
    *
    * @throws DifferentModulusError when this instance and $addend have
    * different modulus.
    */
    public function add(ModularNumber $addend): ModularNumber
    {
        return new ModularAddition($this, $addend)->result();
    }
    
    /**
     * Alias of add() method.
     * 
     * @throws DifferentModulusError when this instance and $addend have
     * different modulus.
     */
    public function plus(ModularNumber $addend): ModularNumber
    {
        return $this->add($addend);
    }

    /**
     * Subtract $minuend.
     * 
     * @throws DifferentModulusError when this instance and $minuend have
     * different modulus.
     */
    public function subtract(ModularNumber $minuend): ModularNumber
    {
        return new ModularSubtraction($this, $minuend)->result();
    }

    /**
     * Alias of subtract() method.
     * 
     * @throws DifferentModulusError when this instance and $minuend have
     * different modulus.
     */
    public function sub(ModularNumber $minuend): ModularNumber
    {
        return $this->subtract($minuend);
    }

    /**
     * Multiply by $factor.
     * 
     * @throws DifferentModulusError when this instance and $factor have
     * different modulus.
     */
    public function multiply(ModularNumber $factor): ModularNumber
    {
        return new ModularMultiplication($this, $factor)->result();
    }

    /**
     * Alias of multiply() method.
     * 
     * @throws DifferentModulusError when this instance and $factor have
     * different modulus.
     */
    public function mul(ModularNumber $factor): ModularNumber
    {
        return $this->multiply($factor);
    }

    /**
     * Divide by $divisor.
     * 
     * @throws DifferentModulusError when this instance and $divisor have
     * different modulus.
     */
    public function divide(ModularNumber $divisor): ModularNumber
    {
        return new ModularDivision($this, $divisor)->result();
    }

    /**
     * Alias of divide() method.
     * 
     * @throws DifferentModulusError when this instance and $divisor have
     * different modulus.
     */
    public function div(ModularNumber $divisor): ModularNumber
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
}