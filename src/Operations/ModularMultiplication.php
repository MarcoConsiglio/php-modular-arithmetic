<?php
namespace Marcoconsiglio\ModularArithmetic\Operations;

use Marcoconsiglio\ModularArithmetic\ModularNumber;

/**
 * The multiplication operation between two ModularNumber(s).
 */
class ModularMultiplication extends Operation
{
    public function result(): ModularNumber
    {
        $result = $this->a->value->mul($this->b->value);
        return new ModularNumber($result, $this->modulus);
    }
}