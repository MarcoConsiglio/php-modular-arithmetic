<?php
namespace Marcoconsiglio\ModularArithmetic\Operations\Relative;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;
use Marcoconsiglio\ModularArithmetic\Ring;

abstract class Operation
{
    protected Number $positive_modulus {
        get {
            return $this->a->modulus->abs();
        }
    }

    protected Number $negative_modulus {
        get {
            return $this->a->modulus->abs()->opposite();
        }
    }

    protected Ring $ring {
        get {
            return $this->a->ring;
        }
    }

    public function __construct(
        protected ModularRelativeNumber $a,
        protected Number $b
    ) {}

    abstract public function result(): ModularRelativeNumber;
}