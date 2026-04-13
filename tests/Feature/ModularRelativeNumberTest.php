<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;

#[TestDox("The ModularRelativeNumber")]
#[CoversClass(ModularRelativeNumber::class)]
class ModularRelativeNumberTest extends BaseTestCase
{
    #[TestDox("can be created from the circumference of its ring.")]
    public function test_create_from_circumference(): void
    {
        // Arrange
        $value = new Number($this->randomInteger());
        $circumference = new Number($this->nonZeroRandomInteger());

        // Act
        $number = ModularRelativeNumber::createFromCircumference(
            $value, $circumference
        );

        // Assert
        $this->assertInstanceOf(ModularRelativeNumber::class, $number);
        $this->assertEquals($circumference->abs(), $number->modulus->abs());
    }

    public function test_create_from_ring_extremes(): void
    {
        // Arrange
        $value = new Number($this->randomInteger());
        $start = new Number($start_value = -180);
        $end = new Number($end_value = 180);

        // Act
        $number = ModularRelativeNumber::createFromRingExtremes(
            $value, $start, $end
        );

        // Assert
        $this->assertInstanceOf(ModularRelativeNumber::class, $number);
        $this->assertEquals(
            abs($start_value) + abs($end_value), (int) $number->modulus->abs()->value
        );
    }
}