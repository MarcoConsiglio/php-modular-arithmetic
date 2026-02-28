<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularNumber;

/**
 * The division operation between two ModularNumber(s).
 */
class ModularDivision extends Operation
{
    /**
     * Return the result of this operation.
     */
    public function result(): ModularNumber
    {
        return new ModularNumber(
            $this->a->value->div($this->b->value),
            $this->modulus
        );
    }
}