<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Operations\Relative;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Builders\FromRing;
use Marcoconsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use Marcoconsiglio\ModularArithmetic\Builders\States\EvaluatorState;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueInsideRingEndAndRingLength;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueInsideRingLengthAndRingStart;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueNeedsReduction;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueOutsideNegativeRingLength;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueOutsidePositiveRingLength;
use Marcoconsiglio\ModularArithmetic\ModularArithmeticNumber;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;
use Marcoconsiglio\ModularArithmetic\Operations\Relative\ModularAddition;
use Marcoconsiglio\ModularArithmetic\Ring;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
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