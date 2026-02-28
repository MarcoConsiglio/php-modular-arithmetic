<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularNumber;

/**
 * The subtraction operation between two ModularNumbers(s).
 */
class ModularSubtraction extends Operation
{
    /**
     * Return the result of this operation.
     */
    public function result(): ModularNumber
    {
        return new ModularNumber(
            $this->a->value->sub($this->b->value),
            $this->modulus
        );
    }
}