<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Exceptions;

use MarcoConsiglio\BCMathExtended\Number;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;

#[CoversClass(DifferentModulusError::class)]
#[UsesClass(ModularNumber::class)]
#[TestDox("The DifferentModulusError")]
class DifferentModulusErrorTest extends BaseTestCase
{
    #[TestDox("is thrown when two ModularNumber have different modulus.")]
    public function test_different_modulus_error(): void
    {
        // Arrange
        $a_modulus = 10;
        $b_modulus = 20;
        $a = $this->randomModularNumberWithModulus(new Number($a_modulus));
        $b = $this->randomModularNumberWithModulus(new Number($b_modulus));

        // Act
        $error = new DifferentModulusError($a, $b);

        // Assert
        $this->assertEquals(
            "Two different modulus cannot be used ($a->modulus and $b->modulus).",
            $error->getMessage()
        );
    }

}