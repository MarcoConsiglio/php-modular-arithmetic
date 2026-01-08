<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\Exceptions\IntegerOverflowError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

/**
 * The exponentiation operation between a ModularInteger and an
 * exponent.
 */
class IntegerModularExponentiation extends IntegerModularOperation
{
    /**
     * The alias for the left operand.
     */
    protected ModularInteger $base {
        get {
            return $this->a;
        }
    }

    /**
     * Construct the modular exponentiation operation.
     *
     * @param ModularInteger $a
     */
    public function __construct(ModularInteger $base, protected int $exponent)
    {
        $this->a = $base;
        $this->modulus = $base->modulus;
    }

    /**
     * Return the result of this operation.
     *
     * @throws IntegerOverflowError when the power is too large to be stored in
     * a int type variable.
     */
    public function result(): ModularInteger
    {
        // Shortcuts
        if ($this->base->value == 0) return $this->base;
        if ($this->base->value == 1) 
            return new ModularInteger($this->base->value ** $this->exponent, $this->modulus);
        $this->checkPowerIntegerOverflow();
        return new ModularInteger(
            $this->a->value ** $this->exponent, 
            $this->modulus
        );
    }

    /**
     * Check if $base power $exponent goes beyond PHP_INT_MAX.
     *
     * @throws IntegerOverflowError if the power exceed PHP_INT_MAX.
     */
    protected function checkPowerIntegerOverflow(): void
    {
        if ($this->isPowerOverflowingInteger($this->base->value, $this->exponent)) 
            throw new IntegerOverflowError($this->base->value ** $this->exponent);
    }

    /**
     * Return true if $base power $exponent goes beyond PHP_INT_MAX.
     */
    protected function isPowerOverflowingInteger(int $base, int $exponent): bool
    {
        // This is checked in result() so here the base will never be zero or one.
        // if ($this->isBaseOneOrZero($base)) return false;
        if ($this->isBasePositive($base)) return $exponent > log(PHP_INT_MAX, $base);
        return abs($exponent) > log(abs(PHP_INT_MIN), abs($base));
    }

    /**
     * Return true if the $base is positive, false otherwise.
     */
    protected function isBasePositive(int $base): bool
    {
        return $base >= 0;
    }
}