<?php
namespace Marcoconsiglio\ModularArithmetic;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\BCMathExtended\Range;
use Marcoconsiglio\ModularArithmetic\Operations\Relative\ModularAddition;

/**
 * The `ModularRelativeNumber`.
 */
class ModularRelativeNumber extends ModularArithmeticNumber
{
    /**
     * The `Ring` of this `ModularRelativeNumber`.
     */
    public Ring $ring {
        set(Ring $ring) {
            if (! isset($this->ring))
                $this->ring = $ring;
        }
    }

    /**
     * Construct a `ModularRelativeNumber`.
     */
    protected function __construct(
        int|float|string|BcMathNumber|Number $value,
        Ring $ring,
    ) {
        // $modulus = $this->normalizeArgument($modulus);
        $value = $this->normalizeArgument($value);
        $this->ring = $ring;
        while (! ($value->inRange($this->ring->positive) || $value->inRange($this->ring->negative))) {
            if ($value->inRangeMinExcluded(new Range(
                $this->ring->end, $this->ring->length
            )))
                $value = $value->mod($this->ring->length->opposite());
            else if ($value->inRangeMaxExcluded(new Range(
                $this->ring->length->opposite(), $this->ring->start
            )))
                $value = $value->mod($this->ring->length);
            else if ($value->isGreaterThan($this->ring->length))
                $value = $value->mod($this->ring->length->opposite());
            else // $value < $this->ring->opposite()
                $value = $value->mod($this->ring->length);
        };

        if ($value->isPositive()) $this->modulus = $ring->length->abs();
        else $this->modulus = $ring->length->abs()->opposite();
        $this->value = $value->mod($this->modulus);
    }

    /**
     * Create a `ModularRelativeNumber` from its `$value` and its 
     * `$ring`.
     */
    public static function createFromRing(
        int|float|string|BcMathNumber|Number $value, 
        Ring $ring
    ): ModularRelativeNumber {
        $number = new ModularRelativeNumber($value, $ring);
        $number->ring = $ring;
        return $number;
    }

    /**
     * Create a `ModularRelativeNumber` from its `$value` and the length
     * between the `$start` and `$end`.
     */
    public static function createFromExtremes(
        int|float|string|BcMathNumber|Number $value,
        Number $start,
        Number $end
    ): ModularRelativeNumber {
        $ring = new Ring($start, $end);
        $number = new ModularRelativeNumber($value, $ring);
        $number->ring = $ring;
        return $number;
    }

    /**
     * Add $addend.
    */
    public function add(Number $addend): ModularRelativeNumber
    {
        return new ModularAddition($this, $addend)->result();
    }
    
    /**
     * Alias of add() method.
     */
    public function plus(Number $addend): ModularRelativeNumber
    {
        return $this->add($addend);
    }
}