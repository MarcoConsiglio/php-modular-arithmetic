<?php
namespace Marcoconsiglio\ModularArithmetic\Builders;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Ring;

class FromExtremes extends ModularRelativeNumberBuilder
{
    public protected(set) Ring $ring;

    public function __construct(
        string|int|float|BcMathNumber|Number $value,
        string|int|float|BcMathNumber|Number $start,
        string|int|float|BcMathNumber|Number $end
    ) {
        $this->value = Number::normalize($value);
        $this->ring = new Ring($start, $end);
    }
}