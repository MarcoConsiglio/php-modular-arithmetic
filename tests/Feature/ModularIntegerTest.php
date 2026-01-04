<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use DivisionByZeroError;
use PHPUnit\Framework\Attributes\TestDox;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

#[TestDox("The ModularInteger")]
class ModularIntegerTest extends TestCase
{
    #[TestDox("has reflexivity property that states that every number is 
    congruent to itself modulo n, for every n other than 0.")]
    public function test_reflexivity_property(): void
    {
        /**
         * n ≠ 0 OK
         */
        // Arrange
        $value = $this->randomInteger();
        $n = $this->randomInteger(1);
        $number = new ModularInteger($value, $n);
        
        // Act & Assert
        $this->assertTrue($number->isCongruent($number), $this->congruentFailure($number, $number));
        
        /**
         * n = 0 ERROR
         */
        $this->expectException(DivisionByZeroError::class);
        new ModularInteger($value, 0);
    }

    #[TestDox("has the symmetry property which states that if a is congruent to
     b modulo n then b is congruent to a modulo n.")]
    public function test_symmetry_property(): void
    {
        // Arrange
        $n = $this->nonZeroRandomInteger();
        $value = $this->randomInteger();
        $a = new ModularInteger($value, $n);
        $b = new ModularInteger(
            $this->getCongruentIntegerValue($value, $n, 1), 
            $n
        );

        // Act & Assert
        $this->assertTrue($a->equals($b), $this->congruentFailure($a, $b));
        $this->assertTrue($b->equals($a), $this->congruentFailure($b, $a));
    }

    #[TestDox("has the transitivity property which states that if a is 
    congruent to b modulo n and b is congruent to c modulo n, then a is also 
    congruent to c modulo n.")]
    public function test_transitivity_property(): void
    {
        $n = $this->nonZeroRandomInteger();
        $value = $this->randomInteger();
        $k = 1;
        $a = new ModularInteger($value, $n);
        $b = new ModularInteger(
            $this->getCongruentIntegerValue($value, $n, $k++), 
            $n
        );
        $c = new ModularInteger(
            $this->getCongruentIntegerValue($value, $n, $k),
            $n
        );

        $this->assertTrue($a->equals($b));
        $this->assertTrue($b->equals($c));
        $this->assertTrue($a->equals($c));
    }

    #[TestDox("can be added to another.")]
    public function test_add_returns_modular_integer(): void
    {
        // Arrange
        $a = $this->randomModularInteger(max: self::MAX_INTEGER);
        $b = new ModularInteger(
            $this->randomInteger(max: self::MAX_INTEGER),
            $a->modulus
        );

        // Act & Assert
        $this->assertInstanceOf(ModularInteger::class, $a->add($b));
    }

    #[TestDox("can be multiplied to another.")]
    public function test_multiply_returns_modular_integer(): void
    {
        // Arrange
        $a = $this->randomModularInteger(max: self::MAX_INTEGER);
        $b = new ModularInteger(
            $this->randomInteger(max: self::MAX_INTEGER),
            $a->modulus
        );

        // Act & Assert
        $this->assertInstanceOf(ModularInteger::class, $a->multiply($b));
    }

    #[TestDox("can be raised to power.")]
    public function test_power_returns_modular_integer(): void
    {
        // Arrange
        $a = $this->randomModularInteger(max: 1000);
        $k = $this->randomInteger(max: 3);

        // Act & Assert
        $this->assertInstanceOf(ModularInteger::class, $a->power($k));
    }

    #[TestDox("can tell you if it is congruent with another.")]
    public function test_isCongruent_returns_boolean(): void
    {
        // Arrange
        $a = $this->randomModularInteger();
        $b = new ModularInteger(
            $this->randomInteger(),
            $a->modulus
        );

        // Act & Assert
        $this->assertIsBool($a->isCongruent($b));
    }
}