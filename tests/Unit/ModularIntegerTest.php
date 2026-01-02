<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

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
        $value = $sign * $this->faker->numberBetween();
        $number = new ModularInteger($value);

        // Act & Assert
        $this->assertEquals($value, $number->value);
    }
}