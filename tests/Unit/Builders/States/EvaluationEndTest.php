<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use Marcoconsiglio\ModularArithmetic\Builders\States\EvaluationEnd;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EvaluationEnd::class)]
class EvaluationEndTest extends StateTestCase
{
    public function test_do_nothing(): void
    {
        // Arrange
        $this->value = $this->randomIntNumber(
            $this->ring->start->toInt(),
            $this->ring->end->toInt()
        );
        $this->state = new EvaluationEnd($this->value, $this->ring);

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertSame($this->value, $this->state->value);
    }
}