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
        $sum = $this->a->value->add($this->b);
        while (! ($sum->inRange($this->ring->positive) || $sum->inRange($this->ring->negative))) {
            if ($sum->inRangeMinExcluded(new Range(
                $this->ring->end, $this->ring->length
            )))
                $sum = $sum->mod($this->negative_modulus);
            else if ($sum->inRangeMaxExcluded(new Range(
                $this->a->ring->length->opposite(), $this->ring->start
            )))
                $sum = $sum->mod($this->positive_modulus);
            else if ($sum->isGreaterThan($this->ring->length))
                $sum = $sum->mod($this->negative_modulus);
            else // $sum < $this->ring->opposite()
                $sum = $sum->mod($this->positive_modulus);
        };
        return ModularRelativeNumber::createFromRing($sum, $this->ring);
    }
}