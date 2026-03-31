<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use DivisionByZeroError;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use Marcoconsiglio\ModularArithmetic\Tests\Feature\Operations\OperationTest;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\Exceptions\DifferentModulusErrorTest;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DependsOnClass;
use PHPUnit\Framework\Attributes\TestDox;
use Throwable;

#[TestDox("The ModularNumber")]
class ModularNumberTest extends BaseTestCase
{
    #[Depends("test_isCongruent_returns_boolean")]
    #[TestDox("has reflexivity property that states that every number is 
    congruent to itself modulo n, for every n other than 0.")]
    public function test_reflexivity_property(): void
    {
        /**
         * n ≠ 0 OK
         */
        // Arrange
        $value = $this->randomNumber(max: $this::MAX);
        $n = $this->randomModulus(max: $this::MAX);
        $number = new ModularNumber($value, $n);
        
        // Act & Assert
        $this->assertTrue($number->isCongruent($number), $this->congruentFailure($number, $number));
        
        /**
         * n = 0 ERROR
         */
        $this->expectException(DivisionByZeroError::class);
        new ModularNumber($value, 0);
    }

    #[Depends("test_isCongruent_returns_boolean")]
    #[TestDox("has the symmetry property which states that if a is congruent to
     b modulo n then b is congruent to a modulo n.")]
    public function test_symmetry_property(): void
    {
        // Arrange
        $n = $this->randomModulus(max: $this::MAX);
        $value = $this->randomNumber(max: $this::MAX);
        $a = new ModularNumber($value, $n);
        $b = new ModularNumber(
            $this->getCongruentNumber($value, $n, 1), 
            $n
        );

        // Act & Assert
        $this->assertTrue($a->equals($b), $this->congruentFailure($a, $b));
        $this->assertTrue($b->equals($a), $this->congruentFailure($b, $a));
    }

    #[Depends("test_isCongruent_returns_boolean")]
    #[TestDox("has the transitivity property which states that if a is 
    congruent to b modulo n and b is congruent to c modulo n, then a is also 
    congruent to c modulo n.")]
    public function test_transitivity_property(): void
    {
        $n = $this->randomModulus(max: $this::MAX);
        $value = $this->randomNumber(max: $this::MAX);
        $a = new ModularNumber($value, $n);
        $b = new ModularNumber($this->getCongruentNumber($value, $n, 1), $n);
        $c = new ModularNumber($this->getCongruentNumber($value, $n, 2), $n);

        $this->assertTrue($a->equals($b), $this->congruentFailure($a, $b));
        $this->assertTrue($b->equals($c), $this->congruentFailure($b, $c));
        $this->assertTrue($a->equals($c), $this->congruentFailure($a, $c));
    }
    
    #[DependsOnClass(DifferentModulusErrorTest::class)]
    #[DependsOnClass(OperationTest::class)]
    #[TestDox("can be added to another.")]
    public function test_addition(): void
    {
        // Arrange
        $a = $this->randomModularNumber(max: $this::MAX);
        $b = $this->randomModularNumberWithModulus($a->modulus, max: $this::MAX);

        // Act & Assert
        $this->assertInstanceOf(ModularNumber::class, $result = $a->plus($b));
        $this->assertEquals($a->value->plus($b->value)->mod($a->modulus)->value, $result->value);
    }

    #[DependsOnClass(DifferentModulusErrorTest::class)]
    #[DependsOnClass(OperationTest::class)]
    #[TestDox("can be subtracted from another.")]
    public function test_subtraction(): void
    {
        // Arrange
        $a = $this->randomModularNumber(max: $this::MAX);
        $b = $this->randomModularNumberWithModulus($a->modulus, max: $this::MAX);

        // Act & Assert
        $this->assertInstanceOf(ModularNumber::class, $result = $a->sub($b));
        $this->assertEquals($a->value->sub($b->value)->mod($a->modulus)->value, $result->value);
    }

    #[DependsOnClass(DifferentModulusErrorTest::class)]
    #[DependsOnClass(OperationTest::class)]
    #[TestDox("can be multiplied to another.")]
    public function test_multiplication(): void
    {
        // Arrange
        $a = $this->randomModularNumber(max: $this::MAX);
        $b = $this->randomModularNumberWithModulus($a->modulus, max: $this::MAX);

        // Act & Assert
        $this->assertInstanceOf(ModularNumber::class, $product = $a->mul($b));
        $this->assertEquals($a->value->mul($b->value)->mod($a->modulus)->value, $product->value);
    }

    #[DependsOnClass(DifferentModulusErrorTest::class)]
    #[DependsOnClass(OperationTest::class)]
    #[TestDox("can be divide by another.")]
    public function test_division(): void
    {
        // Arrange
        $a = $this->randomModularNumber(max: $this::MAX);
        do {
            $b = $this->randomModularNumberWithModulus($a->modulus, max: $this::MAX);
        } while ($b->value->isEqual(0));

        // Act & Assert
        $this->assertInstanceOf(ModularNumber::class, $quotient = $a->div($b));
        $this->assertEquals($a->value->div($b->value)->mod($a->modulus)->value, $quotient->value);
    }

    #[DependsOnClass(DifferentModulusErrorTest::class)]
    #[DependsOnClass(OperationTest::class)]
    #[TestDox("can be raised to power.")]
    public function test_power(): void
    {
        // Arrange
        $a = $this->randomModularNumber(min: -1000, max: 1000);
        $k = $this->randomInteger(min: -100, max: 100);

        // Act & Assert
        try {
            $this->assertInstanceOf(ModularNumber::class, $power = $a->pow($k));
            $this->assertEquals($a->value->pow($k)->mod($a->modulus), $power->value);
        } catch (Throwable $e) {
            $this->fail("Base: {$a->value}\nExponent: {$k}\n{$e->getMessage()}");
        }
    }

    #[TestDox("can calculate the floor of itself.")]
    public function test_floor(): void
    {
        // Arrange
        $number = $this->randomModularNumber(max: $this::MAX);
        $value = $number->value;

        // Act & Assert
        $this->assertEquals($value->floor()->value, $number->floor()->value->value);
    }

    #[TestDox("can calculate the ceil of itself.")]
    public function test_ceil(): void
    {
        // Arrange
        $number = $this->randomModularNumber(max: $this::MAX);
        $value = $number->value;

        // Act & Assert
        $this->assertEquals($value->ceil()->value, $number->ceil()->value->value);
    }

    #[TestDox("can tell you if it is congruent with another one .")]
    public function test_isCongruent_returns_boolean(): void
    {
        // Arrange
        $a = $this->randomModularNumber();
        $b = $this->randomModularNumberWithModulus($a->modulus);

        // Act & Assert
        $this->assertIsBool($a->isCongruent($b));
    }
}