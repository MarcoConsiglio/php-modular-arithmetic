<?php
namespace MarcoConsiglio\ModularArithmetic\Builders;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\Builders\States\EvaluationEnd;
use MarcoConsiglio\ModularArithmetic\Builders\States\EvaluatorState;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueNeedsReduction;
use MarcoConsiglio\ModularArithmetic\Interfaces\Builder;
use MarcoConsiglio\ModularArithmetic\Ring;

abstract class ModularRelativeNumberBuilder implements Builder
{
    public protected(set) Number $value;

    public protected(set) Ring $ring;

    private EvaluatorState $evaluator;

    public function evaluate(): void
    {
        $this->setEvaluatorState($this->startingState());
        do {
            $this->evaluator->evaluate();
        } while (! $this->evaluator instanceof EvaluationEnd);
        $this->value = $this->evaluator->value;
    }

    public function setEvaluatorState(EvaluatorState $evaluator): void
    {
        $this->evaluator = $evaluator;
        $this->evaluator->setBuilderContext($this);
    }

    protected function startingState(): EvaluatorState
    {
        return new ValueNeedsReduction($this->value, $this->ring);
    }
}