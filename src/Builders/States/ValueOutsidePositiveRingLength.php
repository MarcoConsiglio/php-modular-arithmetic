<?php
namespace Marcoconsiglio\ModularArithmetic\Builders\States;

class ValueOutsidePositiveRingLength extends EvaluatorState
{
    public function evaluate(): void
    {
        if ($this->valueOutsidePositiveRingLength())
            $this->value = $this->value->mod($this->ring->length->opposite());
        $this->builder->setEvaluatorState(
            new ValueOutsideNegativeRingLength($this->value, $this->ring)
        );
    }

    private function valueOutsidePositiveRingLength(): bool
    {
        return $this->value->isGreaterThan($this->ring->length);
    }
}