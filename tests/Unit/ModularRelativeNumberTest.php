<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\Builders\FromRing;
use MarcoConsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use MarcoConsiglio\ModularArithmetic\Builders\States\EvaluatorState;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueInsideRingEndAndRingLength;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueInsideRingLengthAndRingStart;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueNeedsReduction;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueOutsideNegativeRingLength;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueOutsidePositiveRingLength;
use MarcoConsiglio\ModularArithmetic\ModularNumber;
use MarcoConsiglio\ModularArithmetic\ModularRelativeNumber;
use MarcoConsiglio\ModularArithmetic\Ring;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
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