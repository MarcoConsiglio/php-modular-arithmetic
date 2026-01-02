<?php
namespace Marcoconsiglio\ModularArithmetic;

class ModularInteger
{
    /**
     * The value of this number.
     *
     * @var integer
     */
    public protected(set) int $value;

    /**
     * Construct an integer modular number.
     *
     * @param integer $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }
}