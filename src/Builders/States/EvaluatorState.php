<?php
namespace MarcoConsiglio\ModularArithmetic\Builders\States;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use MarcoConsiglio\ModularArithmetic\Interfaces\BuilderState;
use MarcoConsiglio\ModularArithmetic\Ring;

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