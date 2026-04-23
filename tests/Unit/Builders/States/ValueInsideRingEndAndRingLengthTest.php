<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use MarcoConsiglio\BCMathExtended\Range;
use Marcoconsiglio\ModularArithmetic\Builders\FromRing;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueInsideRingEndAndRingLength;
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
        $this->value = $this->randomIntNumber(
            $this->ring->end->toInt() + 1,
            $this->ring->length->toInt()
        );
        $this->setState();
        $this->setContext();

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
        $this->value = $this->ring->end;
        $this->setState();
        $this->setContext();

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

    protected function setContext(): void
    {
        $this->state->setBuilderContext(
            $this->createStub(FromRing::class)
        );
    }
}