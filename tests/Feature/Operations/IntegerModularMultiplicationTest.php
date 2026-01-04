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
        $a_times_c = (new IntegerModularMultiplication($a, $c))->result();
        $b_times_c = (new IntegerModularMultiplication($b, $c))->result(); 

        // Act & Assert
        $this->assertTrue($a_times_c->equals($b_times_c), $this->congruentFailure($a_times_c, $b_times_c));
    }
}