<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature\Operations;

use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\Tests\Feature\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The Operation")]
#[UsesClass(DifferentModulusError::class)]
#[UsesClass(ModularNumber::class)]
class OperationTest extends TestCase
{
    #[TestDox("check both operand have the same modulus.")]
    public function test_different_modulus(): void
    {
        // Arrange
        do {
            $a = $this->randomModularNumber();
            $b = $this->randomModularNumber();
        } while ($a->modulus->eq($b->modulus));

        // Assert
        $this->expectException(DifferentModulusError::class);

        // Act
        $a->add($b);
        $a->mul($b);
    }
}