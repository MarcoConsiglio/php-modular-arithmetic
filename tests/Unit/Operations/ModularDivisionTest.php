<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Operations;

use MarcoConsiglio\ModularArithmetic\ModularNumber;
use MarcoConsiglio\ModularArithmetic\Operations\ModularDivision;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ModularDivision::class)]
#[UsesClass(ModularNumber::class)]
class ModularDivisionTest extends BaseTestCase
{
    public function test_result(): void
    {
        // Arrange
        $number = $this->randomModularNumberWithModulus($modulus = 360);
        $divisor = $this->randomInteger(min: 0);
        $expected_value = $number->value->div($divisor)->mod($modulus);
        $expected_number = new ModularNumber($expected_value, $modulus);
        $operation = new ModularDivision($number, $divisor);

        // Act
        $result = $operation->result();

        // Assert
        $this->assertEquals($expected_number->value, $result->value);
    }
}