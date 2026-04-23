<?php
namespace Marcoconsiglio\ModularArithmetic\Builders\States;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use Marcoconsiglio\ModularArithmetic\Interfaces\BuilderState;
use Marcoconsiglio\ModularArithmetic\Ring;

abstract class EvaluatorState implements BuilderState
{
    protected  ModularRelativeNumberBuilder $builder;

    public function __construct(
        public protected(set) Number $value,
        public protected(set) Ring $ring
    ) {}

    public function setBuilderContext(ModularRelativeNumberBuilder $builder)
    {
        $this->builder = $builder;
    }
}