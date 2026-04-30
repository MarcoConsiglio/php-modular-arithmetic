<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use MarcoConsiglio\ModularArithmetic\Builders\States\EvaluationEnd;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EvaluationEnd::class)]
class EvaluationEndTest extends StateTestCase
{
    public function test_do_nothing(): void
    {
        // Arrange
        $this->arrange($this->randomIntNumber(
            $this->ring->start->toInt(),
            $this->ring->end->toInt()
        ));

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertSame($this->value, $this->state->value);
    }

    protected function setState(): void
    {
        $this->state = new EvaluationEnd($this->value, $this->ring);
    }
}