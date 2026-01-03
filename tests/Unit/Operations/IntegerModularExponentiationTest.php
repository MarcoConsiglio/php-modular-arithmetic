<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Operations;

use Marcoconsiglio\ModularArithmetic\Exceptions\IntegerOverflowError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularExponentiation;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The IntegerModularExponentiation operation")]
#[CoversClass(IntegerModularExponentiation::class)]
#[UsesClass(ModularInteger::class)]
#[UsesClass(IntegerOverflowError::class)]
class IntegerModularExponentiationTest extends TestCase
{
    #[TestDox("raise to power a ModularInteger.")]
    public function test_result_is_modular_integer(): void
    {
        // Arrange
        $k = $this->randomInteger(max: 3);
        $a = $this->randomModularInteger(max: 100);

        // Act & Assert
        $this->assertInstanceOf(
            ModularInteger::class, 
            (new IntegerModularExponentiation($a, $k))->result()
        );
    }

    #[TestDox("throws IntegerOverflowException if the result is is too large
    to be stored in a int type variable.")]
    public function test_integer_overflow_error(): void
    {
        // Arrange
        $a = new ModularInteger(PHP_INT_MAX - 1, PHP_INT_MAX);
        $k = $this->randomInteger(2);

        // Assert
        $this->expectException(IntegerOverflowError::class);

        // Act
        (new IntegerModularExponentiation($a, $k))->result();
    }
}