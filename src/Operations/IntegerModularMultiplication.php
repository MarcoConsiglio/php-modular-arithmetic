<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularInteger;

class IntegerModularMultiplication extends ModularOperation
{
    public function result(): ModularInteger
    {
        return new ModularInteger(
            $this->a->value * $this->b->value,
            $this->modulus
        );
    }
}