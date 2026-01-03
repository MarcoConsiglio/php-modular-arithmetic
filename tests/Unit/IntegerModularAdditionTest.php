<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularAddition;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

#[TestDox("The IntegerModularAddition")]
#[CoversClass(IntegerModularAddition::class)]
#[UsesClass(ModularInteger::class)]
#[UsesClass(DifferentModulusError::class)]
class IntegerModularAdditionTest extends TestCase
{
    #[TestDox("sums two ModularInteger instances.")]
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
            (new IntegerModularAddition($a, $b))->result()
        );
    }

    #[TestDox("result is a value that if it is a multiple of its modulus equals zero.")]
    public function test_result_is_modular(): void
    {
        // Arrange
        $modulus = 12;
        $a = new ModularInteger($modulus, $modulus);
        $b = new ModularInteger($modulus * 2, $modulus);
        $sum = new IntegerModularAddition($a, $b);

        // Act & Assert
        $this->assertEquals(0, $sum->result()->value);
    }

    #[TestDox("invariance property states that by increasing or decreasing two 
    congruent numbers modulo n by the same amount, the new numbers obtained 
    are still congruent to each other modulo n.")]
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
        new IntegerModularAddition($a, $b);
    }
}