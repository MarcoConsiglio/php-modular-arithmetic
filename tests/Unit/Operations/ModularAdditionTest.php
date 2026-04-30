<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Operations;

use MarcoConsiglio\ModularArithmetic\ModularNumber;
use MarcoConsiglio\ModularArithmetic\Operations\ModularAddition;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ModularAddition::class)]
#[UsesClass(ModularNumber::class)]
class ModularAdditionTest extends BaseTestCase
{
    public function test_result(): void
    {
        // Arrange
        $number = $this->randomModularNumberWithModulus($modulus = 360);
        $addend = $this->randomInteger(min: 0);
        $expected_value = $number->value->plus($addend)->mod($modulus);
        $expected_number = new ModularNumber($expected_value, $modulus);
        $operation = new ModularAddition($number, $addend);

        // Act
        $result = $operation->result();

        // Assert
        $this->assertEquals($expected_number->value, $result->value);
    }
}