<?php
namespace Marcoconsiglio\ModularArithmetic;

use ErrorException;

class DifferentModulusError extends ErrorException
{
    public function __construct(ModularInteger $a, ModularInteger $b)
    {
        return parent::__construct(
            "Different modules cannot be used ($a->modulus and $b->modulus)."
        );
    }
}