<?php
namespace Marcoconsiglio\ModularArithmetic\Operations\Relative;

use MarcoConsiglio\BCMathExtended\Range;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;

/**
 * The addition operation on a `ModularRelativeNumber`.
 */
class ModularAddition extends Operation
{
    /**
     * Return the result of this operation.
     */
    public function result(): ModularRelativeNumber
    {
        return ModularRelativeNumber::createFromRing(
            $this->a->value->add($this->b), 
            $this->ring
        );
    }
}