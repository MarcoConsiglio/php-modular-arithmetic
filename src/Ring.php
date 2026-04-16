<?php
namespace Marcoconsiglio\ModularArithmetic;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\BCMathExtended\Range;
use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;

/**
 * The ring of finite space of numbers.
 */
class Ring extends Range
{
    /**
     * The length of this `Ring`.
     */
    public Number $length {
        get {
            return $this->start->sub($this->end)->abs();
        }
    }

    public Range $positive {
        get {
            if ($this->start->isPositive() && $this->end->isPositive())
                return $this;
            else if ($this->end->isPositive())
                return new Range(0, $this->end);
            else
                return new Range(0, 0);
        }
    }

    public Range $negative {
        get {
            if ($this->start->isNegative() && $this->end->isNegative())
                return $this;
            else if ($this->start->isNegative())
                return new Range($this->start, NextFloat::beforeZero());
            else
                return new Range(0, 0);
        }
    }
}