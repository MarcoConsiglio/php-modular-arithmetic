<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Builders\States;

use MarcoConsiglio\BCMathExtended\Number;
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
}