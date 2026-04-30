<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use MarcoConsiglio\BCMathExtended\Range;
use MarcoConsiglio\ModularArithmetic\Builders\States\ValueInsideRingEndAndRingLength;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ValueInsideRingEndAndRingLength::class)]
class ValueInsideRingEndAndRingLengthTest extends StateTestCase
{
    public function test_evaluate(): void
    {
        /**
         * Value inside range
         */
        // Arrange
        $this->arrange($this->randomIntNumber(
            $this->ring->end->toInt() + 1,
            $this->ring->length->toInt()
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
        $this->arrange($this->ring->end);

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertEquals(
            $this->value, $this->state->value
        );
    }

    protected function setState(): void
    {
        $this->state = new ValueInsideRingEndAndRingLength(
            $this->value, $this->ring
        );
    }


}