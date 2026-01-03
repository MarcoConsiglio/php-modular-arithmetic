<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Operations;

use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularExponentiation;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\TestCase;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The IntegerModularExponentiation operation")]
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
}