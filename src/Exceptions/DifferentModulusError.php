<?php
namespace Marcoconsiglio\ModularArithmetic\Exceptions;

use ErrorException;
use Marcoconsiglio\ModularArithmetic\ModularNumber;

/**
 * The exception thrown when two number have different modulus.
 */
class DifferentModulusError extends ErrorException
{
    /**
     * Construct the exception with the two number.
     */
    public function __construct(ModularNumber $a, ModularNumber $b)
    {
        return parent::__construct(
            "Two different modulus cannot be used ($a->modulus and $b->modulus)."
        );
    }
}