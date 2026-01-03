<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature\Operations;

use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularAddition;
use Marcoconsiglio\ModularArithmetic\Tests\Feature\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(IntegerModularAddition::class)]
#[UsesClass(ModularInteger::class)]
#[TestDox("The IntegerModularAddition operation")]
class IntegerModularAdditionTest extends TestCase
{
    #[TestDox("has the invariance property which states that by increasing or
     decreasing two congruent numbers modulo n by the same amount, the new 
     numbers obtained are still congruent to each other modulo n.")]
    public function test_invariance_property(): void
    {
        // Arrange
        $a = $this->randomModularInteger(max: self::MAX_INTEGER);
        $b = new ModularInteger(
            $this->getCongruentIntegerValue($a->value, $a->modulus, 1),
            $a->modulus
        );
        $c = new ModularInteger(
            $this->randomInteger(max: self::MAX_INTEGER, sign: 1),
            $a->modulus
        );

        // Act
        $a_plus_c = (new IntegerModularAddition($a, $c))->result();
        $b_plus_c = (new IntegerModularAddition($b, $c))->result();
        
        // Assert
        $this->assertTrue(
            $a_plus_c->isCongruent($b_plus_c), 
            $this->congruentFailure($a_plus_c, $b_plus_c)
        );
    }
}