<?php
namespace Marcoconsiglio\ModularArithmetic;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Operations\Relative\ModularAddition;

class ModularRelativeNumber extends ModularArithmeticNumber
{
    public Ring $ring {
        set(Ring $ring) {
            if (! isset($this->ring))
                $this->ring = $ring;
        }
    }

    protected function __construct(
        int|float|string|BcMathNumber|Number $value,
        int|float|string|BcMathNumber|Number $modulus,
    ) {
        $modulus = $this->normalizeArgument($modulus);
        $value = $this->normalizeArgument($value);
        if ($value->isPositive()) $this->modulus = $modulus->abs();
        else $this->modulus = $modulus->abs()->opposite();
        $this->value = $value->mod($this->modulus);
    }

    /**
     * Create a `ModularRelativeNumber` from its `$value` and the 
     * `$circumference` of its ring.
     */
    public static function createFromRing(
        Number $value, 
        Ring $ring
    ): ModularRelativeNumber {
        if ($value->isPositive())
            $modulus = $ring->length;
        else
            $modulus = $ring->length->opposite();
        $number = new ModularRelativeNumber($value, $modulus);
        $number->ring = $ring;
        return $number;
    }

    /**
     * Create a `ModularRelativeNumber` from its `$value` and the length
     * between the `$start` and `$end`.
     */
    public static function createFromExtremes(
        Number $value,
        Number $start,
        Number $end
    ): ModularRelativeNumber {
        $ring = new Ring($start, $end);
        if ($value->isPositive())
            $modulus = $ring->length;
        else
            $modulus = $ring->length->opposite();
        $number = new ModularRelativeNumber($value, $modulus);
        $number->ring = $ring;
        return $number;
    }

    /**
     * Add $addend.
    *
    * @throws DifferentModulusError when this instance and $addend have
    * different modulus.
    */
    public function add(Number $addend): ModularRelativeNumber
    {
        return new ModularAddition($this, $addend)->result();
    }
    
    /**
     * Alias of add() method.
     * 
     * @throws DifferentModulusError when this instance and $addend have
     * different modulus.
     */
    public function plus(Number $addend): ModularRelativeNumber
    {
        return $this->add($addend);
    }
}