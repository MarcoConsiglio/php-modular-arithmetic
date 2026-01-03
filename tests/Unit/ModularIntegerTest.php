<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use DivisionByZeroError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The ModularInteger")]
#[CoversClass(ModularInteger::class)]
class ModularIntegerTest extends TestCase
{
    #[TestDox("is an integer number used in modular arithmetic.")]
    public function test_is_integer(): void
    {
        // Arrange
        $sign = $this->faker->randomElement([1, -1]);
        $value = $sign * $this->randomInteger();
        $modulus = $this->randomInteger(1);
        $number = new ModularInteger($value, $modulus);

        // Act & Assert
        $this->assertIsInt($number->value);
    }

    #[TestDox("is a value that if it is a multiple of its modulus equals zero.")]
    public function test_is_modular(): void
    {
        // Arrange
        $modulus = 12;
        $k = 1;
        $number_1 = new ModularInteger($modulus * $k++, $modulus);
        $number_2 = new ModularInteger($modulus * $k++, $modulus);
        $number_3 = new ModularInteger($modulus * $k, $modulus);

        // Act & Assert
        $this->assertSame(0, $number_1->value);
        $this->assertSame(0, $number_2->value);
        $this->assertSame(0, $number_3->value);
        $value = $sign * $this->faker->numberBetween();
        $number = new ModularInteger($value);
        
        // Act & Assert
        $this->assertEquals($value, $number->value);
    }
}