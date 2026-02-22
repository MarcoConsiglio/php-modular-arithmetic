<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Exceptions;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\TestCase;

#[CoversClass(DifferentModulusError::class)]
#[UsesClass(ModularNumber::class)]
#[TestDox("The DifferentModulusError")]
class DifferentModulusErrorTest extends TestCase
{
    #[TestDox("is thrown when two ModularNumber have different modulus.")]
    public function test_different_modulus_error(): void
    {
        // Arrange
        $a_modulus = 10;
        $b_modulus = 20;
        $a = new ModularNumber(
            $this->randomInteger(),
            $a_modulus
        );
        $b = new ModularNumber(
            $this->randomInteger(),
            $b_modulus
        );

        // Act
        $error = new DifferentModulusError($a, $b);

        // Assert
        $this->assertEquals(
            "Two different modulus cannot be used ($a->modulus and $b->modulus).",
            $error->getMessage()
        );
    }

}