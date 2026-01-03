<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\Exceptions\IntegerOverflowError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

abstract class IntegerModularOperation
{
    /**
     * The left operand.
     *
     * @var ModularInteger
     */
    public ModularInteger $a;

    /**
     * The right operand.
     *
     * @var ModularInteger
     */
    public ModularInteger $b;

    /**
     * The modulus of the operation.
     */
    public protected(set) int $modulus;

    /**
     * Construct a modular sum between $a and $b.
     *
     * @param ModularInteger $a
     * @param ModularInteger $b
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
     *
     * @return ModularInteger
     */
    abstract public function result(): ModularInteger;

    /**
     * Check if $value exceed the maximum integer value on this system.
     * 
     * Don't use this method with a float value, or you'll lose the decimal 
     * portion, as the float value is converted to an integer. The $value 
     * parameter is a float because PHP automatically converts large integers
     * to a float.
     *
     * @param float $value
     * @return integer
     * @throws IntegerOverflowError if $value exceed PHP_INT_MAX.
     */
    protected function checkIntgerOverflow(float $value): int
    {
        if ($value > PHP_INT_MAX) throw new IntegerOverflowError($value);
        return (int) $value;
    }

}