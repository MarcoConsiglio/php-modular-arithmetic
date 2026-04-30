<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Unit\Builders;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\ModularArithmetic\Builders\FromRing;
use MarcoConsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use MarcoConsiglio\ModularArithmetic\Builders\States\EvaluationEnd;
use MarcoConsiglio\ModularArithmetic\Builders\States\EvaluatorState;
use MarcoConsiglio\ModularArithmetic\Ring;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(ModularRelativeNumberBuilder::class)]
#[UsesClass(FromRing::class)]
#[UsesClass(EvaluationEnd::class)]
#[UsesClass(EvaluatorState::class)]
class ModularRelativeNumberBuilderTest extends BaseTestCase
{
    public function test_end_state(): void
    {
        // Arrange
        $ring = new Ring(-180, 180);
        $builder = $this->getMockBuilder(FromRing::class);
        $builder
            ->enableOriginalConstructor()
            ->setConstructorArgs([0, $ring])
            ->onlyMethods(['startingState']);
        $builder = $builder->getMock();

        // Assert
        $builder
            ->expects($this->once())
            ->method('startingState')
            ->willReturn(new EvaluationEnd(new Number(0), $ring));

        // Act
        $builder->evaluate();
    }
}