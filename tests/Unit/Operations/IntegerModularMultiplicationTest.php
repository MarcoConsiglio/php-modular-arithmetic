<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Operations;

use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularMultiplication;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\TestCase;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The IntegerModularMultiplication operation")]
class IntegerModularMultiplicationTest extends TestCase
{
    #[TestDox("multiply two ModularInteger instances.")]
    public function test_result_is_modular_integer(): void
    {
        // Arrange
        $a = $this->randomModularInteger(max: self::MAX_INTEGER);
        $b = new ModularInteger(
            $this->randomInteger(max: self::MAX_INTEGER),
            $a->modulus
        );

        // Act & Assert
        $this->assertInstanceOf(
            ModularInteger::class,
            (new IntegerModularMultiplication($a, $b))->result()
        );
    }

    #[TestDox("throws DifferentModulusError exception if the two operands have
    different modulus.")]
    public function test_different_modulus_error(): void
    {
        // Arrange
        $a = new ModularInteger($this->randomInteger(), 10);
        $b = new ModularInteger($this->randomInteger(), 20);

        // Assert
        $this->expectException(DifferentModulusError::class);

        // Act
        new IntegerModularMultiplication($a, $b);
    }
}