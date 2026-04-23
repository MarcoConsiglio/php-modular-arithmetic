<?php
namespace Marcoconsiglio\ModularArithmetic\Builders\States;

use MarcoConsiglio\BCMathExtended\Range;

class ValueInsideRingEndAndRingLength extends EvaluatorState
{
    public function evaluate(): void
    {
        if ($this->valueInsideRingEndAndRingLength())
            $this->value = $this->value->mod($this->ring->length->opposite());
        $this->builder->setEvaluatorState(
            new ValueInsideRingLengthAndRingStart($this->value, $this->ring)
        );
    }

    private function valueInsideRingEndAndRingLength(): bool
    {
        return $this->value->inRangeMinExcluded(new Range(
                $this->ring->end, $this->ring->length
        ));
    }
}