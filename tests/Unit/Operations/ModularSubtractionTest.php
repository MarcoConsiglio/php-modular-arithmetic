<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Operations;

use MarcoConsiglio\ModularArithmetic\ModularNumber;
use MarcoConsiglio\ModularArithmetic\Operations\ModularAddition;
use MarcoConsiglio\ModularArithmetic\Operations\ModularSubtraction;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ModularSubtraction::class)]
#[UsesClass(ModularNumber::class)]
class ModularSubtractionTest extends BaseTestCase
{
    public function test_validate(): void
    {
        // Arrange
        $number = $this->randomModularNumberWithModulus($modulus = 360);
        $minuend = $this->randomInteger(min: 0);
        $expected_value = $number->value->sub($minuend)->mod($modulus);
        $expected_number = new ModularNumber($expected_value, $modulus);
        $operation = new ModularSubtraction($number, $minuend);

        // Act
        $result = $operation->result();

        // Assert
        $this->assertEquals($expected_number->value, $result->value);
    }
}