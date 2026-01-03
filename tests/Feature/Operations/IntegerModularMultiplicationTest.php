<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature\Operations;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularMultiplication;
use Marcoconsiglio\ModularArithmetic\Tests\Feature\TestCase;

#[CoversClass(IntegerModularMultiplication::class)]
#[UsesClass(ModularInteger::class)]
#[TestDox("The IntegerModularMultiplication operation")]
class IntegerModularMultiplicationTest extends TestCase
{
    #[TestDox("has the invariance property which states that multiply two 
    congruent numbers modulo n, produces two new numbers that are still 
    congruent to each other modulo n.")]
    public function test_invariance_property(): void
    {
        // Arrange
        $n = $this->nonZeroRandomInteger();
        $k = 1;
        $value_a = $this->randomInteger(max: self::MAX_INTEGER);
        $value_b = $this->getCongruentIntegerValue($value_a, $n, $k++);
        $value_c = $this->getCongruentIntegerValue($value_a, $n, $k);
        $a = new ModularInteger($value_a * $value_c, $n);
        $b = new ModularInteger($value_b * $value_c, $n);

        // Act & Assert
        $this->assertTrue($a->equals($b), $this->congruentFailure($a, $b));
    }
}