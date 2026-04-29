<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use Marcoconsiglio\ModularArithmetic\Builders\States\ValueOutsidePositiveRingLength;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ValueOutsidePositiveRingLength::class)]
class ValueOutsidePositiveRingLengthTest extends StateTestCase
{
    public function test_evaluate(): void
    {
        /**
         * Outside range
         */
        // Arrange
        $this->arrange(
            $this->randomIntNumber(
                min: $this->ring->length->toInt() + 1
            )
        );

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertTrue($this->state->value->lte($this->ring->length));

        /**
         * Inside range
         */
        // Arrange
        $this->arrange(
            $this->randomIntNumber(
                max: $this->ring->length->toInt()
            )
        );

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertEquals(
            $this->value, $this->state->value
        );
    }

    #[Override]
    protected function setState(): void
    {
        $this->state = new ValueOutsidePositiveRingLength(
            $this->value, $this->ring
        );
    }
}