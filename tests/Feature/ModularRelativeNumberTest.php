<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Feature;

use MarcoConsiglio\BCMathExtended\Number;
use Marcoconsiglio\ModularArithmetic\ModularNumber;
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;
use Marcoconsiglio\ModularArithmetic\Operations\Relative\ModularAddition;
use Marcoconsiglio\ModularArithmetic\Operations\Relative\Operation;
use Marcoconsiglio\ModularArithmetic\Ring;
use Marcoconsiglio\ModularArithmetic\Tests\BaseTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The ModularRelativeNumber")]
#[CoversClass(ModularRelativeNumber::class)]
#[UsesClass(ModularNumber::class)]
#[UsesClass(ModularAddition::class)]
#[UsesClass(Operation::class)]
#[UsesClass(Ring::class)]
class ModularRelativeNumberTest extends BaseTestCase
{
    protected Number $end_ring;

    protected Number $start_ring;

    protected Number $absolute_modulus;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->start_ring = new Number(-180);
        $this->end_ring = new Number(180);
        $this->absolute_modulus = $this->end_ring->sub($this->start_ring)->abs();
    }

    #[TestDox("can be created from the circumference of its ring.")]
    public function test_create_from_circumference(): void
    {
        // Arrange
        $value = new Number($this->randomInteger());
        $ring = new Ring($this->start_ring, $this->end_ring);

        // Act
        $number = ModularRelativeNumber::createFromRing(
            $value, $ring
        );

        // Assert
        $this->assertInstanceOf(ModularRelativeNumber::class, $number);
        $this->assertEquals($ring->length->abs(), $number->modulus->abs());
    }

    #[TestDox("can be created from the start and end extremes of its ring.")]
    public function test_create_from_ring_extremes(): void
    {
        // Arrange
        $value = new Number($this->randomInteger(
            min: $this->start_ring->toInt(), max: $this->end_ring->toInt()
        ));

        // Act
        $number = ModularRelativeNumber::createFromExtremes(
            $value, $this->start_ring, $this->end_ring
        );

        // Assert
        $this->assertInstanceOf(ModularRelativeNumber::class, $number);
        $this->assertEquals($this->absolute_modulus, $number->modulus->abs());
    }

    #[TestDox("can be added to another.")]
    public function test_addition(): void
    {
        // Arrange
        $a = ModularRelativeNumber::createFromExtremes(
            $this->randomIntNumber(
                min: $this->start_ring->toInt(), max: $this->end_ring->toInt()
            ),
            $this->start_ring, $this->end_ring
        );
        $b = $this->randomIntNumber(min: -360, max: 360);

        // Act
        $sum = $a->plus($b);

        // Assert
        $failure_message = $this->additionFailure($a, $b, $sum);
        $this->assertInstanceOf(ModularRelativeNumber::class, $sum);
        $this->assertGreaterThanOrEqual($this->start_ring->toInt(), $sum->value->toInt(), $failure_message);
        $this->assertLessThanOrEqual($this->end_ring->toInt(), $sum->value->toInt(), $failure_message);
        if ($sum->value->isPositive())
            $this->assertEquals($this->absolute_modulus->toInt(), $sum->modulus->toInt(), $failure_message);
        else
            $this->assertEquals($this->absolute_modulus->opposite()->toInt(), $sum->modulus->toInt(), $failure_message);
    }
}