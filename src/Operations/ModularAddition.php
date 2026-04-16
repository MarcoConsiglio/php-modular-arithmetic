<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularNumber;

/**
 * The sum operation on a `ModularNumber`.
 */
class ModularAddition extends Operation
{
    /**
     * Return the result of this operation.
     */
    public function result(): ModularNumber
    {
        $result = $this->a->value->add($this->b);
        return new ModularNumber($result, $this->modulus);
    }
}