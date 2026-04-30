<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Builders;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\BCMathExtended\Range;
use MarcoConsiglio\ModularArithmetic\Builders\FromExtremes;
use MarcoConsiglio\ModularArithmetic\Builders\FromRing;
use MarcoConsiglio\ModularArithmetic\Builders\States\EvaluatorState;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueInsideRingEndAndRingLength;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueInsideRingLengthAndRingStart;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueNeedsReduction;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueOutsideNegativeRingLength;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueOutsidePositiveRingLength;
use MarcoConsiglio\ModularArithmetic\ModularRelativeNumber;
use MarcoConsiglio\ModularArithmetic\Ring;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(FromExtremes::class)]
#[UsesClass(FromRing::class)]
#[UsesClass(EvaluatorState::class)]
#[UsesClass(ValueNeedsReduction::class)]
#[UsesClass(ModularRelativeNumber::class)]
#[UsesClass(ValueInsideRingEndAndRingLength::class)]
#[UsesClass(ValueInsideRingLengthAndRingStart::class)]
#[UsesClass(ValueOutsideNegativeRingLength::class)]
#[UsesClass(ValueOutsidePositiveRingLength::class)]
class FromExtremesTest extends BaseTestCase
{
    public function test_evaluate(): void
    {
        // Arrange
        $ring = new Ring(-180, 180);
        $number = new Number(361);
        $builder = new FromExtremes(
            $number,
            $ring->start,
            $ring->end
        );

        // Act
        $builder->evaluate();

        // Assert
        $this->assertTrue(
            $builder->value->inRange(
                new Range($ring->start, $ring->end)
            )
        );
    }
}