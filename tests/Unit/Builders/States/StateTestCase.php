<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Builders\FromRing;
use Marcoconsiglio\ModularArithmetic\Builders\ModularRelativeNumberBuilder;
use Marcoconsiglio\ModularArithmetic\Builders\States\EvaluatorState;
use Marcoconsiglio\ModularArithmetic\Ring;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use Override;

abstract class StateTestCase extends BaseTestCase
{
    protected Number $value;

    protected Ring $ring;

    protected ModularRelativeNumberBuilder $builder;

    protected EvaluatorState $state;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->ring = new Ring(-180, 180);
    }

    abstract protected function setState(): void;

    protected function setContext(): void
    {
        $this->state->setBuilderContext(
            $this->createStub(FromRing::class)
        );
    }

    protected function setValue(Number $value): void
    {
        $this->value = $value;
    }

    protected function arrange(Number $value): void
    {
        $this->setValue($value);
        $this->setState();
        $this->setContext();
    }
}