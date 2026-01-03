<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularInteger;

class IntegerModularExponentiation extends IntegerModularOperation
{
    /**
     * The right operand.
     */
    protected int $exponent;

    public function __construct(ModularInteger $a, int $exponent)
    {
        $this->a = $a;
        $this->modulus = $a->modulus;
        $this->exponent = $exponent;
    }

    /**
     * Return the result of this operation.
     *
     * @return ModularInteger
     */
    public function result(): ModularInteger
    {
        return new ModularInteger(
            $this->checkIntgerOverflow($this->a->value ** $this->exponent), 
            $this->modulus
        );
    }
}