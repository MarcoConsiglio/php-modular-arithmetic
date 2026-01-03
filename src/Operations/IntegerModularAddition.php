<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Exceptions\IntegerOverflowError;

class IntegerModularAddition extends IntegerModularOperation
{
    /**
     * Return the result of this operation.
     *
     * @return ModularInteger
     * @throws IntegerOverflowError when the sum is too large to be stored in
     * a int type variable.
     */
    public function result(): ModularInteger
    {
        return new ModularInteger(
            $this->checkIntgerOverflow($this->a->value + $this->b->value), 
            $this->modulus
        );
    }
}