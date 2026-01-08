<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use Marcoconsiglio\ModularArithmetic\ModularInteger;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;

#[CoversNothing]
class PlaygroundTest extends TestCase
{
    #[Test]
    public function construct_modular_integer(): void
    {
        $this->markTestSkipped("This test is just a playground. Nothing important here.");
        $this->expectNotToPerformAssertions();
    }
}