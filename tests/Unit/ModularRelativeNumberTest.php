<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Builders\FromRing;
use Marcoconsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use Marcoconsiglio\ModularArithmetic\Builders\States\EvaluatorState;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueInsideRingEndAndRingLength;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueInsideRingLengthAndRingStart;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueNeedsReduction;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueOutsideNegativeRingLength;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueOutsidePositiveRingLength;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;
use Marcoconsiglio\ModularArithmetic\Ring;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ModularRelativeNumber::class)]
#[UsesClass(EvaluatorState::class)]
#[UsesClass(FromRing::class)]
#[UsesClass(ModularNumber::class)]
#[UsesClass(ModularRelativeNumberBuilder::class)]
#[UsesClass(ValueInsideRingEndAndRingLength::class)]
#[UsesClass(ValueInsideRingLengthAndRingStart::class)]
#[UsesClass(ValueNeedsReduction::class)]
#[UsesClass(ValueOutsideNegativeRingLength::class)]
#[UsesClass(ValueOutsidePositiveRingLength::class)]
class ModularRelativeNumberTest extends BaseTestCase
{
    public function test_construct(): void
    {
        // Set up
        $ring = new Ring(-180, 180);

        /**
         * 0 ≤ sum ≤ max 
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(120), $ring
        );

        // Act & Assert
        $this->assertEquals(new Number(120), $modular_number->value);

        /**
         * min ≤ sum < 0
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(-120), $ring
        );

        // Act & Assert
        $this->assertEquals(new Number(-120), $modular_number->value);

        /**
         * max < sum ≤ ring_length
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(270), $ring
        );

        // Act & Assert
        $this->assertEquals(new Number(-90), $modular_number->value);

        /**
         *  -ring_length ≤ sum < min
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(-270), $ring
        );

        // Act & Assert
        $this->assertEquals(new Number(90), $modular_number->value);

        /**
         * sum > ring_length
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(450), $ring
        );

        // Act & Assert
        $this->assertEquals(new Number(90), $modular_number->value);

        /**
         * sum < -ring_length
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(-450), $ring
        );

        // Act & Assert
        $this->assertEquals(new Number(-90), $modular_number->value);
    }
}