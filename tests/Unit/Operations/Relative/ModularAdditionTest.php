<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Operations\Relative;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\Builders\FromRing;
use MarcoConsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use MarcoConsiglio\ModularArithmetic\Builders\States\EvaluatorState;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueInsideRingEndAndRingLength;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueInsideRingLengthAndRingStart;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueNeedsReduction;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueOutsideNegativeRingLength;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueOutsidePositiveRingLength;
use MarcoConsiglio\ModularArithmetic\ModularArithmeticNumber;
use MarcoConsiglio\ModularArithmetic\ModularNumber;
use MarcoConsiglio\ModularArithmetic\ModularRelativeNumber;
use MarcoConsiglio\ModularArithmetic\Operations\Relative\ModularAddition;
use MarcoConsiglio\ModularArithmetic\Ring;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ModularAddition::class)]
#[UsesClass(EvaluatorState::class)]
#[UsesClass(FromRing::class)]
#[UsesClass(ModularArithmeticNumber::class)]
#[UsesClass(ModularNumber::class)]
#[UsesClass(ModularRelativeNumber::class)]
#[UsesClass(ModularRelativeNumberBuilder::class)]
#[UsesClass(ValueInsideRingEndAndRingLength::class)]
#[UsesClass(ValueInsideRingLengthAndRingStart::class)]
#[UsesClass(ValueNeedsReduction::class)]
#[UsesClass(ValueOutsideNegativeRingLength::class)]
#[UsesClass(ValueOutsidePositiveRingLength::class)]
class ModularAdditionTest extends BaseTestCase
{
    public function test_result(): void
    {
        // Arrange
        $ring = new Ring(-180, 180);
        $modular_number = ModularRelativeNumber::createFromRing(
            $this->randomIntNumber(min: -360 * 2, max: 360 * 2),
            $ring
        );
        $number = $this->randomIntNumber(min: -360 * 2, max: 360 * 2);
        $operation = new ModularAddition($modular_number, $number);

        // Act & Assert
        $this->assertInstanceOf(ModularRelativeNumber::class, $operation->result());
    }
}