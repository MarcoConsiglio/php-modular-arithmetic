<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Operations;

use MarcoConsiglio\ModularArithmetic\ModularNumber;
use MarcoConsiglio\ModularArithmetic\Operations\ModularExponentiation;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ModularExponentiation::class)]
#[CoversClass(ModularNumber::class)]
class ModularExponentiationTest extends BaseTestCase
{
    public function test_result(): void
    {
        // Arrange
        $number = $this->randomModularNumberWithModulus($modulus = 360);
        $exponent = $this->positiveRandomInteger(max: 10);
        $expected_value = $number->value->pow($exponent)->mod($modulus);
        $expected_number = new ModularNumber($expected_value, $modulus);
        $operation = new ModularExponentiation($number, $exponent);

        // Act
        $result = $operation->result();

        // Assert
        $this->assertEquals($expected_number->value, $result->value);
    }
}