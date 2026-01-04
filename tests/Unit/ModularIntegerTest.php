<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use DivisionByZeroError;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularAddition;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\TestCase;

#[TestDox("The ModularInteger")]
#[CoversClass(ModularInteger::class)]
#[UsesClass(IntegerModularAddition::class)]
#[UsesClass(DifferentModulusError::class)]
class ModularIntegerTest extends TestCase
{
    #[TestDox("has \"value\" property which is an integer.")]
    public function test_value_property(): void
    {
        // Arrange
        $value = $this->randomInteger();
        $modulus = $this->randomInteger(1);
        $number = new ModularInteger($value, $modulus);

        // Act & Assert
        $this->assertSame($value % $modulus, $number->value);
    }

    #[TestDox("has \"modulus\" property which is an integer.")]
    public function test_modulus_property(): void
    {
        // Arrange
        $value = $this->randomInteger();
        $modulus = $this->randomInteger(1);
        $number = new ModularInteger($value, $modulus);

        // Act & Assert
        $this->assertSame($modulus, $number->modulus);
    }

    #[TestDox("throws DifferentModulusError when performing a congruent 
    comparison if the two modulus are different.")]
    public function test_congruent_comparison_throws_different_modulus_error(): void
    {
        // Arrange
        $a = new ModularInteger($this->randomInteger(), 10);
        $b = new ModularInteger($this->randomInteger(), 20);

        // Assert
        $this->expectException(DifferentModulusError::class);

        // Act
        $a->isCongruent($b);
    }

}