<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature\Operations;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularExponentiation;
use Marcoconsiglio\ModularArithmetic\Tests\Feature\TestCase;

#[TestDox("The IntegerModularExponentiation operation")]
#[CoversClass(IntegerModularExponentiation::class)]
#[UsesClass(ModularInteger::class)]
class IntegerModularExponentiationTest extends TestCase
{
    #[TestDox("has the invariance property which states that by raising two 
    congruent numbers modulo n to the same power k, the numbers obtained are 
    still congruent to each other modulo n.")]
    public function test_invariance_property(): void
    {
        // Arrange
        $k = $this->randomInteger(max: 3);
        $a = $this->randomModularInteger(max: 100);
        $b = new ModularInteger(
            $this->getCongruentIntegerValue($a->value, $a->modulus, 1),
            $a->modulus
        );

        // Act
        $a_pow_k = (new IntegerModularExponentiation($a, $k))->result();
        $b_pow_k = (new IntegerModularExponentiation($b, $k))->result();

        // Assert
        $this->assertTrue($a_pow_k->isCongruent($b_pow_k), $this->congruentFailure($a_pow_k, $b_pow_k));
    }
}