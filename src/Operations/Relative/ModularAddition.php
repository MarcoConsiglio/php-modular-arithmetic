<?php
namespace Marcoconsiglio\ModularArithmetic\Operations\Relative;

use MarcoConsiglio\BCMathExtended\Range;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;

class ModularAddition extends Operation
{
    public function result(): ModularRelativeNumber
    {
        $sum = $this->a->value->add($this->b);
        if ($sum->inRange($this->ring->positive))
            return ModularRelativeNumber::createFromRing($sum, $this->ring);
        else if ($sum->inRange($this->ring->negative))
            return ModularRelativeNumber::createFromRing($sum, $this->ring);
        else if ($sum->inRangeMinExcluded(new Range(
            $this->ring->end, $this->ring->length
        )))
            return ModularRelativeNumber::createFromRing($sum->mod($this->negative_modulus), $this->ring);
        else if ($sum->inRangeMaxExcluded(new Range(
            $this->a->ring->length->opposite(), $this->ring->start
        )))
            return ModularRelativeNumber::createFromRing($sum->mod($this->positive_modulus), $this->ring);
        else if ($sum->isGreaterThan($this->ring->length))
            return ModularRelativeNumber::createFromRing($sum->mod($this->negative_modulus), $this->ring);
        else // $sum < $this->ring->opposite()
            return ModularRelativeNumber::createFromRing($sum->mod($this->positive_modulus), $this->ring);
    }
}