<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The ModularNumber")]
class ModularNumberTest extends TestCase
{
    #[TestDox("is never congruent with another one with different modulus.")]
    public function test_congruence_with_different_modulus(): void
    {
        // Arrange
        do {
            $a = $this->randomModularNumber();
            $b = $this->randomModularNumber();
        } while ($a->modulus->value == $b->modulus->value);

        // Act & Assert
        $this->assertFalse($a->equals($b));
    }
}