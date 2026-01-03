<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

class IntegerModularAddition extends ModularOperation
{
    /**
     * Return the result of this operation.
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