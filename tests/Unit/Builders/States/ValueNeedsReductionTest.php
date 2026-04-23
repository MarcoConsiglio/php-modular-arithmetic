<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\BCMathExtended\Range;
use Marcoconsiglio\ModularArithmetic\Builders\FromRing;
use Marcoconsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use Marcoconsiglio\ModularArithmetic\Builders\States\EvaluationEnd;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueInsideRingEndAndRingLength;
use Marcoconsiglio\ModularArithmetic\Builders\States\ValueNeedsReduction;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\MockObject\MockObject;

#[CoversClass(ValueNeedsReduction::class)]
#[UsesClass(FromRing::class)]
class ValueNeedsReductionTest extends StateTestCase
{
    public function test_evaluate(): void
    {
        /**
         * Positive value needs reduction
         */
        // Arrange
        $this->setValue(new Number(181));
        $this->setState();
        $this->state->setBuilderContext($this->getContextIfValueNeedsReduction());

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertSame($this->value, $this->state->value);

        /**
         * Negative value needs reduction
         */
        // Arrange
        $this->setValue(new Number(-181));
        $this->setState();
        $this->state->setBuilderContext($this->getContextIfValueNeedsReduction());

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertSame($this->value, $this->state->value);

        /**
         * Evaluation end
         */
        // Arrange
        $this->setValue($this->randomIntNumber(
            $this->ring->start->toInt(),
            $this->ring->end->toInt()
        ));
        $this->setState();
        $this->state->setBuilderContext($this->getContextIfValueDoesNotNeedReduction());

        // Act
        $this->state->evaluate();

        // Assert
        $this->assertSame($this->value, $this->state->value);
    }

    protected function setState(): void
    {
        $this->state = new ValueNeedsReduction(
            $this->value, $this->ring
        );
    }

    protected function getContextIfValueNeedsReduction(): ModularRelativeNumberBuilder&MockObject
    {
        $builder = 
            $this->getMockBuilder(FromRing::class)
            ->onlyMethods(['setEvaluatorState'])
            ->setConstructorArgs([$this->value, $this->ring])
            ->getMock();
        $builder
            ->expects($this->exactly(1))
            ->method('setEvaluatorState')
            ->with(new ValueInsideRingEndAndRingLength($this->value, $this->ring));
        return $builder;
    }

    protected function getContextIfValueDoesNotNeedReduction(): ModularRelativeNumberBuilder&MockObject
    {
        $builder = 
            $this->getMockBuilder(FromRing::class)
            ->onlyMethods(['setEvaluatorState'])
            ->setConstructorArgs([$this->value, $this->ring])
            ->getMock();
        $builder
            ->expects($this->exactly(1))
            ->method('setEvaluatorState')
            ->with(new EvaluationEnd($this->value, $this->ring));
        return $builder;
    }
}