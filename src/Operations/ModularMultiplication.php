<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularNumber;

/**
 * The multiplication operation on a `ModularNumber`.
 */
class ModularMultiplication extends Operation
{
    /**
     * Return the result of this operation.
     */
    public function result(): ModularNumber
    {
        $result = $this->a->value->mul($this->b);
        return new ModularNumber($result, $this->modulus);
    }
}