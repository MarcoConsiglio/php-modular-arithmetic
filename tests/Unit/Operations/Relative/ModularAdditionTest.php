<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Operations\Relative;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\ModularArithmeticNumber;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;
use Marcoconsiglio\ModularArithmetic\Operations\Relative\ModularAddition;
use Marcoconsiglio\ModularArithmetic\Ring;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ModularAddition::class)]
#[UsesClass(ModularArithmeticNumber::class)]
#[UsesClass(ModularRelativeNumber::class)]
class ModularAdditionTest extends BaseTestCase
{
    public function test_result(): void
    {
        // Set up
        $ring = new Ring(-180, 180);

        /**
         * 0 ≤ sum ≤ max 
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(90), $ring
        );
        $number = new Number(30);
        $operation = new ModularAddition($modular_number, $number);

        // Act & Assert
        $this->assertEquals(new Number(120), $operation->result()->value);

        /**
         * min ≤ sum < 0
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(-90), $ring
        );
        $number = new Number(-30);
        $operation = new ModularAddition($modular_number, $number);

        // Act & Assert
        $this->assertEquals(new Number(-120), $operation->result()->value);

        /**
         * max < sum ≤ ring_length
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(180), $ring
        );
        $number = new Number(90);
        $operation = new ModularAddition($modular_number, $number);

        // Act & Assert
        $this->assertEquals(new Number(-90), $operation->result()->value);

        /**
         *  -ring_length ≤ sum < min
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(-180), $ring
        );
        $number = new Number(-90);
        $operation = new ModularAddition($modular_number, $number);

        // Act & Assert
        $this->assertEquals(new Number(90), $operation->result()->value);

        /**
         * sum > ring_length
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(180), $ring
        );
        $number = new Number(270);
        $operation = new ModularAddition($modular_number, $number);

        // Act & Assert
        $this->assertEquals(new Number(90), $operation->result()->value);

        /**
         * sum < -ring_length
         */
        // Arrange
        $modular_number = ModularRelativeNumber::createFromRing(
            new Number(-180), $ring
        );
        $number = new Number(-270);
        $operation = new ModularAddition($modular_number, $number);

        // Act & Assert
        $this->assertEquals(new Number(-90), $operation->result()->value);
    }
}