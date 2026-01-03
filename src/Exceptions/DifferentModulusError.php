<?php
namespace Marcoconsiglio\ModularArithmetic\Exceptions;

use ErrorException;
use Marcoconsiglio\ModularArithmetic\ModularInteger;

class DifferentModulusError extends ErrorException
{
    public function __construct(ModularInteger $a, ModularInteger $b)
    {
        return parent::__construct(
            "Different modules cannot be used ($a->modulus and $b->modulus)."
        );
    }
}