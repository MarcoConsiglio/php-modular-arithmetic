<?php
namespace MarcoConsiglio\ModularArithmetic\Builders\States;

use MarcoConsiglio\BCMathExtended\Range;

class ValueInsideRingLengthAndRingStart extends EvaluatorState
{
    public function evaluate(): void
    {
        if ($this->valueInsideRingLengthAndRingStart())
            $this->value = $this->value->mod($this->ring->length);
        $this->builder->setEvaluatorState(
            new ValueOutsidePositiveRingLength($this->value, $this->ring)
        );
    }

    private function valueInsideRingLengthAndRingStart(): bool
    {
        return $this->value->inRangeMaxExcluded(new Range(
                $this->ring->length->opposite(), $this->ring->start
        ));   
    }
}