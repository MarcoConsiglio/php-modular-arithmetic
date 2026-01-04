<?php
namespace Marcoconsiglio\ModularArithmetic\Exceptions;

use ErrorException;

/**
 * The exception thrown when an overflowing integer is used.
 */
class IntegerOverflowError extends ErrorException
{
    public function __construct(float $exceeding_value)
    {
        return parent::__construct(
            "The number $exceeding_value exceeds the max integer value of ".
            PHP_INT_MAX." on this system."
        );
    }
}