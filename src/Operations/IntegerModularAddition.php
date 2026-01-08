<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Exceptions\IntegerOverflowError;

/**
 * The addition operation between two ModularInteger.
 */
class IntegerModularAddition extends IntegerModularOperation
{
    /**
     * Return the result of this operation.
     *
     * @throws IntegerOverflowError when the sum is too large to be stored in
     * a int type variable.
     */
    public function result(): ModularInteger
    {
        $this->checkIntegerOverflow($sum = $this->a->value + $this->b->value);
        return new ModularInteger(
            $sum, 
            $this->modulus
        );
    }
}