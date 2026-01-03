<?php
namespace Marcoconsiglio\ModularArithmetic;

class IntegerModularSum
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
     * Modulus of the operation.
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
     * Return the result of the modular sum.
     *
     * @return ModularInteger
     */
    public function result(): ModularInteger
    {
        return new ModularInteger(
            $this->a->value + $this->b->value, 
            $this->modulus
        );
    }
}