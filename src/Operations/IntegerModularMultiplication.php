<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularInteger;

/**
 * The multiplication operation between two ModularInteger.
 */
class IntegerModularMultiplication extends IntegerModularOperation
{
    /**
     * Return the result of this operation.
     *
     * @throws IntegerOverflowError when the product is too large to be stored in
     * a int type variable.
     */
    public function result(): ModularInteger
    {
        $this->checkIntegerOverflow($product = $this->a->value * $this->b->value);
        return new ModularInteger(
            $product,
            $this->modulus
        );
    }
}