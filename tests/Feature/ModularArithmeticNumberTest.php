<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\ModularArithmeticNumber;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClassesThatExtendClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The ModuluarArithmeticNumber")]
#[CoversClassesThatExtendClass(ModularArithmeticNumber::class)]
class ModularArithmeticNumberTest extends BaseTestCase
{
    #[TestDox("has a \"value\" property which is a Number.")]
    public function test_value(): void
    {
        // Arrange
        $number = $this->randomModularNumber();

        // Act & Assert
        $this->assertInstanceOf(Number::class, $number->value);
    }

    #[TestDox("has a \"modulus\" property which is a Number.")]
    public function test_modulus(): void
    {
        // Arrange
        $number = $this->randomModularNumber();

        // Act & Assert
        $this->assertInstanceOf(Number::class, $number->modulus);
    }
}