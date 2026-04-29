<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueOutsideNegativeRingLength;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ValueOutsideNegativeRingLength::class)]
class ValueOutsideNegativeRingLengthTest extends StateTestCase
{
    public function test_evaluate(): void
    {
        /**
         * Value outside range
         */
        // Arrange
        $this->arrange(
            $this->randomIntNumber(
                max: $this->ring->length->opposite()->toInt() - 1
            )
        );

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertTrue(
            $this->state->value->gte($this->ring->length->opposite())
        );

        /**
         * Value inside range
         */
        // Arrange
        $this->arrange(
            $this->randomIntNumber(
                min: $this->ring->length->opposite()->toInt()
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
        $this->state = new ValueOutsideNegativeRingLength(
            $this->value, $this->ring
        );
    }
}