<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularNumber;

/**
 * The sum operation between two ModularNumber(s).
 */
class ModularAddition extends Operation
{
    /**
     * Return the result of this operation.
     */
    public function result(): ModularNumber
    {
        $result = $this->a->value->add($this->b->value);
        return new ModularNumber($result, $this->modulus);
    }
}