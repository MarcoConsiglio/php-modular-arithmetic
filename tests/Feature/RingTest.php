<?php
namespace MarcoConsiglio\ModularArithmetic\Tests\Feature;

use MarcoConsiglio\BCMathExtended\Number;
use MarcoConsiglio\BCMathExtended\Range;
use MarcoConsiglio\FakerPhpNumberHelpers\NextFloat;
use MarcoConsiglio\ModularArithmetic\Ring;
use MarcoConsiglio\ModularArithmetic\Tests\BaseTestCase;
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

    #[TestDox("has a \"range\" property which is a Range object.")]
    public function test_range(): void
    {
        // Arrange
        $ring = new Ring($min = -180, $max = 180);

        // Act
        $range = $ring->range;

        // Assert
        $this->assertInstanceOf(Range::class, $range);
        $this->assertEquals($min, $range->start->toInt());
        $this->assertEquals($max, $range->end->toInt());
    }

    #[TestDox("has a \"positive\" property which is a Range object.")]
    public function test_positive_range(): void
    {
        // Arrange
        $ring = new Ring($min = -180, $max = 180);

        // Act
        $range = $ring->positive;

        // Assert
        $this->assertInstanceOf(Range::class, $range);
        $this->assertEquals(0, $range->start->toInt());
        $this->assertEquals($max, $range->end->toInt());       
    }

    #[TestDox("has a \"negative\" property which is a Range object.")]
    public function test_negative_range(): void
    {
        // Arrange
        $ring = new Ring($min = -180, $max = 180);

        // Act
        $range = $ring->negative;

        // Assert
        $this->assertInstanceOf(Range::class, $range);
        $this->assertEquals($min, $range->start->toInt());
        $this->assertEquals(new Number(NextFloat::beforeZero())->value, $range->end->value);       
    }
}