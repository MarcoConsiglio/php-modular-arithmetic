<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use DivisionByZeroError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The ModularInteger")]
#[CoversClass(ModularInteger::class)]
class ModularIntegerTest extends TestCase
{
    #[TestDox("is an integer number used in modular arithmetic.")]
    public function test_is_integer(): void
    {
        // Arrange
        $sign = $this->faker->randomElement([1, -1]);
        $value = $sign * $this->randomInteger();
        $modulus = $this->randomInteger(1);
        $number = new ModularInteger($value, $modulus);

        // Act & Assert
        $this->assertIsInt($number->value);
    }

    #[TestDox("is a value that if it is a multiple of its modulus equals zero.")]
    public function test_is_modular(): void
    {
        // Arrange
        $modulus = 12;
        $k = 1;
        $number_1 = new ModularInteger($modulus * $k++, $modulus);
        $number_2 = new ModularInteger($modulus * $k++, $modulus);
        $number_3 = new ModularInteger($modulus * $k, $modulus);

        // Act & Assert
        $this->assertSame(0, $number_1->value);
        $this->assertSame(0, $number_2->value);
        $this->assertSame(0, $number_3->value);
    }

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

    #[TestDox("that is congruent to another value modulo n means that the other value is congruent to it.")]
    public function test_symmetry_property(): void
    {
        // Arrange
        $n = $this->nonZeroRandomInteger();
        $value = $this->randomInteger();
        $reminder = $value % $n;
        $a = new ModularInteger($value, $n);
        $b = new ModularInteger($n + $reminder, $n);

        // Act & Assert
        $this->assertTrue($a->equals($b), $this->congruentFailure($a, $b));
        $this->assertTrue($b->equals($a), $this->congruentFailure($b, $a));
    }

    #[TestDox("that is congruent to b modulo n, which in turn is congruent to c modulo n, is congruent to c modulo n.")]
    public function test_transitivity_property(): void
    {
        $n = $this->nonZeroRandomInteger();
        $value = $this->randomInteger();
        $reminder = $value % $n;
        $k = 1;
        $a = new ModularInteger($value, $n);
        $b = new ModularInteger($k++ * $n + $reminder, $n);
        $c = new ModularInteger($k * $n + $reminder, $n);

        $this->assertTrue($a->equals($b));
        $this->assertTrue($b->equals($c));
        $this->assertTrue($a->equals($c));
    }
}