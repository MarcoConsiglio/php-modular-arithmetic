<?php
namespace MarcoConsiglio\ModularArithmetic;

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

    /**
     * The `Range` of this `Ring`.
     */
    public Range $range {
        get {
            return new Range(
                $this->start,
                $this->end
            );
        }
    }

    /**
     * The positive `Range` of this `Ring`.
     */
    public Range $positive {
        get {
            if ($this->start->isPositive() && $this->end->isPositive())
                return $this;
            else if ($this->end->isPositive())
                return new Range(0, $this->end);
            return new Range(0, 0);
        }
    }

    /**
     * The negative `Range` of this `Ring`.
     */
    public Range $negative {
        get {
            if ($this->start->isNegative() && $this->end->isNegative())
                return $this;
            else if ($this->start->isNegative())
                return new Range($this->start, NextFloat::beforeZero());
            return new Range(0, 0);
        }
    }
}