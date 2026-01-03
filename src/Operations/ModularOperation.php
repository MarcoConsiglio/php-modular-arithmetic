<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

abstract class ModularOperation
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
     * The result of this operation.
     *
     * @return ModularInteger
     */
    abstract public function result(): ModularInteger;
}