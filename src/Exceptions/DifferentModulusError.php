<?php
namespace Marcoconsiglio\ModularArithmetic\Exceptions;

use ErrorException;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

/**
 * The exception thrown when two number have different modules.
 */
class DifferentModulusError extends ErrorException
{
    /**
     * Construct the exception with the two number.
     *
     * @param ModularInteger $a
     * @param ModularInteger $b
     */
    public function __construct(ModularInteger $a, ModularInteger $b)
    {
        return parent::__construct(
            "Different modules cannot be used ($a->modulus and $b->modulus)."
        );
    }
}