<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\Exceptions\IntegerOverflowError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

/**
 * The abstract arithmetic operation of the
 * modular arithmetic.
 */
abstract class IntegerModularOperation
{
    /**
     * The left operand.
     */
    public ModularInteger $a;

    /**
     * The right operand.
     */
    public ModularInteger $b;

    /**
     * The modulus of the operation.
     */
    public protected(set) int $modulus;

    /**
     * Construct a modular operation between $a and $b.
     *
     * @throws DifferentModulusError when $a and $b have different modulus.
     */
    public function __construct(ModularInteger $a, ModularInteger $b)
    {
        if ($a->modulus != $b->modulus) throw new DifferentModulusError($a, $b);
        $this->a = $a;
        $this->b = $b;
        $this->modulus = $this->a->modulus;
    }

    /**
     * Return the result of this operation.
     */
    abstract public function result(): ModularInteger;

    /**
     * Check if $value can be safely stored in a int type variable.
     *
     * @param float $value This parameter should not be used with float type 
     * variables. It is intended to be used with int type variables beacuse
     * PHP internally automatically cast to float when the int value overflows
     * the int type variable.
     * @throws IntegerOverflowError if $value overflow a int type variable.
     */
    protected function checkIntegerOverflow(float $value): void
    {
        if ($this->isOverflowingInteger($value)) throw new IntegerOverflowError($value);
    }

    /**
     * Return true if $value is overflowing an int type variable.
     */
    protected function isOverflowingInteger(float $value): bool
    {
        return $value > PHP_INT_MAX || $value < PHP_INT_MIN;
    }

}