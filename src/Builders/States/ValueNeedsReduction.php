<?php
namespace MarcoConsiglio\ModularArithmetic\Builders\States;

class ValueNeedsReduction extends EvaluatorState
{
    public function evaluate(): void
    {
        if ($this->valueNeedsReduction())
            $this->builder->setEvaluatorState(
                new ValueInsideRingEndAndRingLength($this->value, $this->ring)
            );
        else 
            $this->builder->setEvaluatorState(
                new EvaluationEnd($this->value, $this->ring)
            );
    }

    private function valueNeedsReduction(): bool
    {
        return ! $this->value->inRange(
            $this->ring->range
        );
    }
}