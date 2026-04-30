<?php
namespace MarcoConsiglio\ModularArithmetic\Operations;

use MarcoConsiglio\ModularArithmetic\ModularNumber;

/**
 * The division operation on a `ModularNumber`.
 */
class ModularDivision extends Operation
{
    /**
     * Return the result of this operation.
     */
    public function result(): ModularNumber
    {
        return new ModularNumber(
            $this->a->value->div($this->b),
            $this->modulus
        );
    }
}