<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit;

use Marcoconsiglio\ModularArithmetic\ModularInteger;

class IntegerSumTest extends TestCase
{
    public function test_invariance_property(): void
    {
        // Arrange
        $n = $this->nonZeroRandomInteger();
        $k = 1;
        $value_a = $this->randomInteger();
        $value_b = $k++ * $n + ($value_a % $n);
        $value_c = $k * $n + ($value_a % $n);
        $c = new ModularInteger($value_c, $n);
        $a = new ModularInteger($value_a + $value_c, $n);
        $b = new ModularInteger($value_b + $value_c, $n);

        // Act & Assert
        $this->assertEquals($a->equals($b), $this->congruentFailure($a, $b));
    }
}