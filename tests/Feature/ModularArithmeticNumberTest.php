<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Feature;

use BcMath\Number as BcMathNumber;
use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\ModularArithmeticNumber;
use MarcoConsiglio\ModularArithmetic\ModularNumber;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The ModuluarArithmeticNumber")]
#[CoversClass(ModularArithmeticNumber::class)]
#[UsesClass(ModularNumber::class)]
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

    #[TestDox("accepts inputs of type int.")]
    public function test_normalize_int_type_argument(): void
    {
        // Arrange
        $value = $this->randomInteger();
        $modulus = $this->nonZeroRandomInteger();

        // Act
        $number = new ModularNumber($value, $modulus);

        // Assert
        $this->assertInstanceOf(Number::class, $number->value);
        $this->assertInstanceOf(Number::class, $number->modulus);
    }

    #[TestDox("accepts inputs of type float.")]
    public function test_normalize_float_type_argument(): void
    {
        // Arrange
        $value = $this->randomFloat();
        $modulus = $this->nonZeroRandomFloat();

        // Act
        $number = new ModularNumber($value, $modulus);

        // Assert
        $this->assertInstanceOf(Number::class, $number->value);
        $this->assertInstanceOf(Number::class, $number->modulus);
    }

    #[TestDox("accepts inputs of type string.")]
    public function test_normalize_string_type_argument(): void
    {
        // Arrange
        $value = Number::string($this->randomFloat());
        $modulus = Number::string($this->nonZeroRandomFloat());

        // Act
        $number = new ModularNumber($value, $modulus);

        // Assert
        $this->assertInstanceOf(Number::class, $number->value);
        $this->assertInstanceOf(Number::class, $number->modulus);
    }

    #[TestDox("accepts inputs of type BcMath\Number.")]
    public function test_normalize_BcMath_Number_type_argument(): void
    {
        // Arrange
        $value = new BcMathNumber($this->randomInteger());
        $modulus = new BcMathNumber($this->nonZeroRandomInteger());

        // Act
        $number = new ModularNumber($value, $modulus);

        // Assert
        $this->assertInstanceOf(Number::class, $number->value);
        $this->assertInstanceOf(Number::class, $number->modulus);
    }

    #[TestDox("accepts inputs of type BcMathExtendend\Number.")]
    public function test_normalize_BcMathExtended_Number_type_argument(): void
    {
        // Arrange
        $value = new Number($this->randomInteger());
        $modulus = new Number($this->nonZeroRandomInteger());

        // Act
        $number = new ModularNumber($value, $modulus);

        // Assert
        $this->assertInstanceOf(Number::class, $number->value);
        $this->assertInstanceOf(Number::class, $number->modulus);
    }
}