<?php
namespace Marcoconsiglio\ModularArithmetic\Builders;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Builders\States\EvaluationEnd;
use Marcoconsiglio\ModularArithmetic\Builders\States\EvaluatorState;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueNeedsReduction;
use Marcoconsiglio\ModularArithmetic\Interfaces\Builder;
use Marcoconsiglio\ModularArithmetic\Ring;

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