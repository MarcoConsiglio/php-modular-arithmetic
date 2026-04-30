<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Operations;

use MarcoConsiglio\ModularArithmetic\ModularNumber;
use MarcoConsiglio\ModularArithmetic\Operations\ModularMultiplication;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ModularMultiplication::class)]
#[UsesClass(ModularNumber::class)]
class ModularMultiplicationTest extends BaseTestCase
{
    public function test_result(): void
    {
        // Arrange
        $number = $this->randomModularNumberWithModulus($modulus = 360);
        $factor = $this->randomInteger(min: 0);
        $expected_value = $number->value->mul($factor)->mod($modulus);
        $expected_number = new ModularNumber($expected_value, $modulus);
        $operation = new ModularMultiplication($number, $factor);

        // Act
        $result = $operation->result();

        // Assert
        $this->assertEquals($expected_number->value, $result->value);
    }
}