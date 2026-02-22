<?php
namespace Marcoconsiglio\ModularArithmetic\Tests\Traits;

use RoundingMode;

trait WithStringFormatting
{
    /**
     * Format a $number to a numeric string.
     */
    protected static function string(int|float|string $number): string
    {
        if (self::isFloatString($number)) return self::trimTrailingZeros($number);
        else if (self::isIntString($number)) return $number;    
        if (is_int($number)) return self::formatInteger($number);
        return self::formatFloat($number);
    }

    /**
     * Return true if $number is a decimal numeric string, false otherwise.
     */
    private static function isFloatString(mixed $number): bool
    {
        return is_string($number) && strpos($number, '.');
    }

    /**
     * Return true if $number is an integer numeric string, false otherwise.
     */
    private static function isIntString(mixed $number): bool
    {
        return is_string($number) && ! strpos($number, '.');
    }

    /**
     * Remove trailing zeros from a numeric string.
     */
    protected static function trimTrailingZeros(string $number): string
    {
        $decimal_separator = strpos($number, '.');
        if($decimal_separator === false) { // It is integer number.
            return $number;
        } else return rtrim(rtrim($number, '0'), '.'); // It is a decimal number.
    }

    /**
     * Format an integer $number to string.
     */
    protected static function formatInteger(int $number): string
    {
        return sprintf("%d", $number);
    }

    /**
     * Format a float $number to string, also removing unneeded trailing zeros.
     */
    protected static function formatFloat(float $number): string
    {
        $decimal_places = self::countDecimalPlaces($number);
        $number = number_format($number, $decimal_places, thousands_separator: '');
        return self::trimTrailingZeros($number);
    }

    /**
     * Count the decimal digits of a decimal $number.
     */
    public static function countDecimalPlaces(float $number): int
    {
        for ($decimal_digits = 0; $number != round($number, $decimal_digits, RoundingMode::HalfTowardsZero); ++$decimal_digits);
        return $decimal_digits;
    }

    /**
     * Count the digits of an integer $number.
     */
    public static function countIntDigits(int $number): int
    {
        if (abs($number) == 0) return 1;
        if (abs($number) == 1) return 1;
        return intval(log(abs($number), 10) + 1);
    }

    /**
     * Count the decimal digits of a $number string.
     */
    public static function countStringDecimalPlaces(string $number): int
    {
        return strlen(substr(strrchr($number, "."), 1));
    }
}