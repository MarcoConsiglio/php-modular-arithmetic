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
     * Check if $value is greater than PHP_INT_MAX.
     *
     * @throws IntegerOverflowError if the power exceed PHP_INT_MAX.
     */
    protected function checkIntegerOverflow(float $value): void
    {
        if ($this->isOverflowingInteger($value)) throw new IntegerOverflowError($value);
    }

    /**
     * Return true if $value is greater than PHP_INT_MAX.
     */
    protected function isOverflowingInteger(float $value): bool
    {
        return abs($value) > PHP_INT_MAX;
    }

}