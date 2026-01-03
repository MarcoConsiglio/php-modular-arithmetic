<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use DivisionByZeroError;
use PHPUnit\Framework\Attributes\TestDox;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

#[TestDox("The ModularInteger")]
class ModularIntegerTest extends TestCase
{
 #[TestDox("is congruent to itself modulo n, for every n other than 0.")]
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

    #[TestDox("that is congruent to another value modulo n means that the 
    other value is congruent to it.")]
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

    #[TestDox("that is congruent to b modulo n, which in turn is congruent to c
     modulo n, is congruent to c modulo n.")]
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

    #[TestDox("sum operation return a new ModularInteger.")]
    public function test_sum_returns_modular_integer(): void
    {
        // Arrange
        $a = $this->randomModularInteger(max: self::MAX_INTEGER);
        $b = new ModularInteger(
            $this->randomInteger(max: self::MAX_INTEGER),
            $a->modulus
        );

        // Act & Assert
        $this->assertInstanceOf(ModularInteger::class, $a->sum($b));
    }
}