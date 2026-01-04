<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use Override;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use Marcoconsiglio\ModularArithmetic\Tests\Traits\WithFaker;

class TestCase extends BaseTestCase
{
    use WithFaker;

    /**
     * This method is called before each test.
     */
    #[Override]
    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }
}