<?php
namespace Marcoconsiglio\ModularArithmetic;

use BcMath\Number;
use MarcoConsiglio\BCMathExtended\Number as BCMathExtendedNumber;

class ModularRelativeNumber extends ModularArithmeticNumber
{
    protected function __construct(
        int|float|string|Number|BCMathExtendedNumber $value, 
        int|float|string|Number|BCMathExtendedNumber $modulus
    ) {
        throw new \Exception('Not implemented');
    }
}