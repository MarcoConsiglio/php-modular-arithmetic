<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\Ring;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The Ring of the finite modular space")]
#[CoversClass(Ring::class)]
class RingTest extends BaseTestCase
{
    #[TestDox("has a \"length\" property which is the distance between \"end\" and \"start\" properties.")]
    public function test_length_property(): void
    {
        // Arrange
        $min = new Number($this->negativeRandomInteger());
        $max = new Number($this->positiveRandomInteger());
        $ring = new Ring($min, $max);
        $expected_length = $min->sub($max)->abs();

        // Act & Assert
        $this->assertInstanceOf(Number::class, $ring->length);
        $this->assertEquals($expected_length, $ring->length);
    }
}