<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Unit\Exceptions;

use Marcoconsiglio\ModularArithmetic\Exceptions\IntegerOverflowError;
use Marcoconsiglio\ModularArithmetic\Tests\Unit\TestCase;

class IntegerOverflowErrorTest extends TestCase
{
    public function test_integer_overflow_error(): void
    {
        // Arrange
        $xl_integer = PHP_INT_MAX + 1;
        $error = new IntegerOverflowError($xl_integer);

        // Act & Assert
        $this->assertEquals(
            "The number $xl_integer exceeds the max integer value of ".
            PHP_INT_MAX." on this system.",
            $error->getMessage()
        );
    }
}