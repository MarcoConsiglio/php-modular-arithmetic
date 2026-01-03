<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularInteger;

class IntegerModularMultiplication extends IntegerModularOperation
{
    /**
     * Return the result of this operation.
     *
     * @return ModularInteger
     */
    public function result(): ModularInteger
    {
        return new ModularInteger(
            $this->a->value * $this->b->value,
            $this->modulus
        );
    }
}