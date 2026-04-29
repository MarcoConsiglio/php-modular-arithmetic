<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use MarcoConsiglio\BCMathExtended\Range;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueInsideRingLengthAndRingStart;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ValueInsideRingLengthAndRingStart::class)]
class ValueInsideRingLengthAndRingStartTest extends StateTestCase
{
    public function test_evaluate(): void
    {
        /**
         * Value inside range
         */
        // Arrange
        $this->arrange($this->randomIntNumber(
            $this->ring->length->opposite()->toInt(), 
            $this->ring->start->toInt() - 1
        ));
        
        // Act
        $this->state->evaluate();

        // Assert
        $this->assertTrue(
            $this->state->value->inRange(
                new Range($this->ring->start, $this->ring->end)
            )
        );

        /**
         * Value outside range
         */
        // Arrange
        $this->arrange($this->ring->start);

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertSame($this->value, $this->state->value);

    }

    protected function setState(): void
    {
        $this->state = new ValueInsideRingLengthAndRingStart(
            $this->value, $this->ring
        );
    }
}