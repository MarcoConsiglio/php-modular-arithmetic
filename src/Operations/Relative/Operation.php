<?php
namespace Marcoconsiglio\ModularArithmetic\Operations\Relative;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;
use Marcoconsiglio\ModularArithmetic\Ring;

/**
 * An `Operation` of the modular arithmetic when its `Ring` is
 * a relative space of numbers.
 */
abstract class Operation
{
    /**
     * The positive modulus.
     */
    protected Number $positive_modulus {
        get {
            return $this->a->modulus->abs();
        }
    }

    /**
     * The negative modulus.
     */
    protected Number $negative_modulus {
        get {
            return $this->a->modulus->abs()->opposite();
        }
    }

    /**
     * The ring that constitutes the finite space of numbers.
     */
    protected Ring $ring {
        get {
            return $this->a->ring;
        }
    }

    /**
     * Construct a modular operation between `$a` and `$b`.
     */
    public function __construct(
        protected ModularRelativeNumber $a,
        protected Number $b
    ) {}

    /**
     * Return the result of this `Operation`.
     */
    abstract public function result(): ModularRelativeNumber;
}