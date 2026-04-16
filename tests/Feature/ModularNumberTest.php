<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use DivisionByZeroError;
use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The ModularNumber")]
class ModularNumberTest extends BaseTestCase
{
    #[TestDox("is never congruent with another one with different modulus.")]
    public function test_congruence_with_different_modulus(): void
    {
        $this->markTestSkipped("This test is now meaningless.");
        // Arrange
        do {
            $a = $this->randomModularNumber();
            $b = $this->randomModularNumber();
        } while ($a->modulus->value == $b->modulus->value);

        // Act & Assert
        $this->assertFalse($a->equals($b->value));
    }

    #[TestDox("has reflexivity property that states that every number is 
    congruent to itself modulo n, for every n other than 0.")]
    public function test_reflexivity_property(): void
    {
        /**
         * n ≠ 0 OK
         */
        // Arrange
        $value = $this->randomFloatNumber($this::MIN, $this::MAX);
        $n = $this->randomFloatModulus($this::MIN, $this::MAX);
        $number = new ModularNumber($value, $n);
        $congruent_number = $this->getCongruentNumber($number);
        
        // Act & Assert
        $this->assertTrue($number->isCongruent($congruent_number), $this->congruentFailure($number, $number));
    }

    #[TestDox("has the symmetry property which states that if a is congruent to
     b modulo n then b is congruent to a modulo n.")]
    public function test_symmetry_property(): void
    {
        // Arrange
        $n = $this->randomFloatModulus($this::MIN, $this::MAX);
        $value = $this->randomFloatNumber($this::MIN, $this::MAX);
        $a = new ModularNumber($value, $n);
        $b = new ModularNumber($this->getCongruentNumber($a, 1), $n);

        // Act & Assert
        $this->assertTrue($a->equals($b->value), $this->congruentFailure($a, $b));
        $this->assertTrue($b->equals($a->value), $this->congruentFailure($b, $a));
    }

    #[TestDox("has the transitivity property which states that if a is 
    congruent to b modulo n and b is congruent to c modulo n, then a is also 
    congruent to c modulo n.")]
    public function test_transitivity_property(): void
    {
        $n = $this->randomFloatModulus($this::MIN, $this::MAX);
        $value = $this->randomFloatNumber($this::MIN, $this::MAX);
        $a = new ModularNumber($value, $n);
        $b = new ModularNumber($this->getCongruentNumber($a, 1), $n);
        $c = new ModularNumber($this->getCongruentNumber($b, 2), $n);

        $this->assertTrue($a->equals($b->value), $this->congruentFailure($a, $b));
        $this->assertTrue($b->equals($c->value), $this->congruentFailure($b, $c));
        $this->assertTrue($a->equals($c->value), $this->congruentFailure($a, $c));
    }
    
    #[TestDox("can be added to another.")]
    public function test_addition(): void
    {
        // Arrange
        $a = $this->randomModularNumber($this::MIN, $this::MAX);
        $b = $this->randomIntNumber($this::MIN, $this::MAX);

        // Act & Assert
        $this->assertInstanceOf(ModularNumber::class, $result = $a->plus($b));
        $this->assertEquals($a->value->plus($b->value)->mod($a->modulus)->value, $result->value);
    }

    #[TestDox("can be subtracted from another.")]
    public function test_subtraction(): void
    {
        // Arrange
        $a = $this->randomModularNumber($this::MIN, $this::MAX);
        $b = $this->randomIntNumber($this::MIN, $this::MAX);

        // Act & Assert
        $this->assertInstanceOf(ModularNumber::class, $result = $a->sub($b));
        $this->assertEquals($a->value->sub($b->value)->mod($a->modulus)->value, $result->value);
    }

    #[TestDox("can be multiplied to another.")]
    public function test_multiplication(): void
    {
        // Arrange
        $a = $this->randomModularNumber($this::MIN, $this::MAX);
        $b = $this->randomIntNumber($this::MIN, $this::MAX);

        // Act & Assert
        $this->assertInstanceOf(ModularNumber::class, $product = $a->mul($b));
        $this->assertEquals($a->value->mul($b->value)->mod($a->modulus)->value, $product->value);
    }

    #[TestDox("can be divide by another.")]
    public function test_division(): void
    {
        // Arrange
        $a = $this->randomModularNumber($this::MIN, $this::MAX);
        do {
            $b = $this->randomIntNumber($this::MIN, $this::MAX);
        } while ($b->isEqual(0));

        // Act & Assert
        $this->assertInstanceOf(ModularNumber::class, $quotient = $a->div($b));
        $this->assertEquals($a->value->div($b->value)->mod($a->modulus)->value, $quotient->value);
    }

    #[TestDox("can be raised to power.")]
    public function test_power(): void
    {
        // Arrange
        $a = $this->randomModularNumber(min: -1000, max: 1000);
        $k = $this->randomInteger(min: -100, max: 100);

        // Act & Assert
        $this->assertInstanceOf(ModularNumber::class, $power = $a->pow($k));
        $this->assertEquals($a->value->pow($k)->mod($a->modulus), $power->value);
    }

    #[TestDox("can calculate the floor of itself.")]
    public function test_floor(): void
    {
        // Arrange
        $number = $this->randomModularNumber($this::MIN, $this::MAX);
        $value = $number->value;

        // Act & Assert
        $this->assertEquals($value->floor()->value, $number->floor()->value->value);
    }

    #[TestDox("can calculate the ceil of itself.")]
    public function test_ceil(): void
    {
        // Arrange
        $number = $this->randomModularNumber($this::MIN, $this::MAX);
        $value = $number->value;

        // Act & Assert
        $this->assertEquals($value->ceil()->value, $number->ceil()->value->value);
    }

    #[TestDox("can tell you if it is congruent with another one .")]
    public function test_isCongruent_returns_boolean(): void
    {
        // Arrange
        $a = $this->randomModularNumber($this::MIN, $this::MAX);
        $b = $this->randomIntNumber($this::MIN, $this::MAX);

        // Act & Assert
        $this->assertIsBool($a->isCongruent($b));
    }

    #[TestDox("cannot have a zero modulus.")]
    public function test_null_mudulus(): void
    {
        // Assert
        $this->expectException(DivisionByZeroError::class);

        // Act
        $this->randomModularNumberWithModulus(new Number(0));
    }
}