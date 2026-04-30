<?php
namespace MarcoConsiglio\ModularArithmetic;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\Builders\FromExtremes;
use MarcoConsiglio\ModularArithmetic\Builders\FromRing;
use MarcoConsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use MarcoConsiglio\ModularArithmetic\Interfaces\Builder;
use MarcoConsiglio\ModularArithmetic\Operations\Relative\ModularAddition;

/**
 * The `ModularRelativeNumber`.
 */
class ModularRelativeNumber extends ModularArithmeticNumber
{
    /**
     * The `Ring` number space of this `ModularRelativeNumber`.
     */
    public protected(set) Ring $ring;

    /**
     * Construct a `ModularRelativeNumber`.
     */
    protected function __construct(
        ModularRelativeNumberBuilder $builder
    ) { 
        $builder->evaluate(); 
        if ($builder->value->isPositive()) $this->modulus = $builder->ring->length;
        else $this->modulus = $builder->ring->length->opposite();
        $this->value = $builder->value->mod($this->modulus);
        $this->ring = $builder->ring;
    }

    /**
     * Create a `ModularRelativeNumber` from its `$value` and its 
     * `$ring`.
     */
    public static function createFromRing(
        int|float|string|BcMathNumber|Number $value, 
        Ring $ring
    ): ModularRelativeNumber {
        return new ModularRelativeNumber(
            new FromRing($value, $ring)
        );
    }

    /**
     * Create a `ModularRelativeNumber` from its `$value` and the length
     * between the `$start` and `$end`.
     */
    public static function createFromExtremes(
        int|float|string|BcMathNumber|Number $value,
        int|float|string|BcMathNumber|Number $start,
        int|float|string|BcMathNumber|Number $end
    ): ModularRelativeNumber {
        return new ModularRelativeNumber(
            new FromExtremes($value, $start, $end)
        );
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