<?php
namespace Marcoconsiglio\ModularArithmetic\Builders;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Ring;

class FromRing extends ModularRelativeNumberBuilder
{
    public function __construct(
        string|int|float|BcMathNumber|Number $value,
        Ring $ring
    ) {
        $this->value = Number::normalize($value);
        $this->ring = $ring;
    }
}