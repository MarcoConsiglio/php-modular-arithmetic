<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Operations;

use Marcoconsiglio\ModularArithmetic\Exceptions\IntegerOverflowError;
use Marcoconsiglio\ModularArithmetic\ModularInteger;
use Marcoconsiglio\ModularArithmetic\Operations\IntegerModularExponentiation;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;

#[TestDox("The IntegerModularExponentiation operation")]
#[CoversClass(IntegerModularExponentiation::class)]
#[UsesClass(ModularInteger::class)]
#[UsesClass(IntegerOverflowError::class)]
class IntegerModularExponentiationTest extends TestCase
{
    #[TestDox("raise to power a base ModularInteger.")]
    public function test_result_is_modular_integer(): void
    {
        // Arrange
        $base = $this->randomModularInteger(min: 10_000_000, sign: 1);
        $exponent = $this->randomInteger(max: log(PHP_INT_MAX, $base->value));

        // Act & Assert
        $this->assertInstanceOf(
            ModularInteger::class, 
            $result = (new IntegerModularExponentiation($base, $exponent))->result()
        );
        $this->assertEquals(($base->value ** $exponent) % $base->modulus, $result->value);
    }

    public function test_integer_overflow_error_with_negative_base(): void
    {
        /**
         * Negative base
         */
        // Arrange
        $base = new ModularInteger($this->randomInteger(min: 2, sign: -1), $this->randomInteger(sign: 1));
        $exponent = $this->randomInteger(min: log(PHP_INT_MIN, abs($base->value)));

        // Assert
        $this->expectException(IntegerOverflowError::class);
        
        // Act
        $base->power($exponent);
        $this->fail("{$base->value}^$exponent (mod {$base->modulus})");
    }

    public function test_integer_overflow_error_with_positive_base(): void
    {  
        /**
         * Positive base different from 1.
        */
        // Arrange
        $base = $this->randomModularInteger(min: 2, sign: 1);
        $exponent = $this->randomInteger(min: log(PHP_INT_MAX, $base->value), sign: 1);
        
        // Assert
        $this->expectException(IntegerOverflowError::class);

        // Act
        $base->power($exponent);
        $this->fail("{$base->value}^$exponent (mod {$base->modulus})");
    }

    public function test_exponentiation_shortcuts(): void
    {
        /**
         * Base = 0
         */
        // Arrange
        $base = new ModularInteger(0, $this->randomInteger());
        $exponent = $this->randomInteger();

        // Act
        $result = $base->power($exponent);

        // Assert
        $this->assertEquals(0, $result->value);
    
        /**
         * Base = 1
         */
        // Arrange
        $base = new ModularInteger(1, $this->randomInteger());
        $exponent = $this->randomInteger();

        // Act
        $result = $base->power($exponent);

        // Assert
        $this->assertEquals(1, $result->value);
    }
}