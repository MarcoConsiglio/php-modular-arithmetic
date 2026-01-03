<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use Marcoconsiglio\ModularArithmetic\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(DifferentModulusError::class)]
#[UsesClass(ModularInteger::class)]
class DifferentModulusErrorTest extends TestCase
{
    public function test_different_modulus_error_test(): void
    {
        // Arrange
        $a_modulus = 10;
        $b_modulus = 20;
        $a = new ModularInteger(
            $this->randomInteger(),
            $a_modulus
        );
        $b = new ModularInteger(
            $this->randomInteger(),
            $b_modulus
        );

        // Act
        $error = new DifferentModulusError($a, $b);

        // Assert
        $this->assertEquals(
            "Different modules cannot be used ($a->modulus and $b->modulus).",
            $error->getMessage()
        );
    }

}