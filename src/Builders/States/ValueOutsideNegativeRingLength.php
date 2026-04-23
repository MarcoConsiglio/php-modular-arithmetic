<?php
namespace Marcoconsiglio\ModularArithmetic\Builders\States;

class ValueOutsideNegativeRingLength extends EvaluatorState
{
    public function evaluate(): void
    {
        if ($this->valueOutsideNegativeRingLength())
            $this->value = $this->value->mod($this->ring->length);
        $this->builder->setEvaluatorState(
            new ValueNeedsReduction($this->value, $this->ring)
        );
    }

    private function valueOutsideNegativeRingLength(): bool
    {
        return $this->value->isLessThan($this->ring->length->opposite());
    }
}