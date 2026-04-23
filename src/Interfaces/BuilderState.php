<?php
namespace Marcoconsiglio\ModularArithmetic\Interfaces;

use MarcoConsiglio\BCMathExtended\Number;

interface BuilderState
{
    public function evaluate(): void;
}