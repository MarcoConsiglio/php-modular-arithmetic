![GitHub License](https://img.shields.io/github/license/MarcoConsiglio/php-modular-arithmetic)
![Static Badge](https://img.shields.io/badge/version-v1.0.0-white)<br>
![Static Badge](https://img.shields.io/badge/100%25-rgb(40%2C%20167%2C%2069)?label=Line%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/100%25-rgb(40%2C%20167%2C%2069)?label=Branch%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/100%25-rgb(40%2C%20167%2C%2069)?label=Path%20coverage&labelColor=rgb(255%2C255%2C255))
# Modular Arithmetic
A PHP libarary to support modular arithmetic, aka clock arithmetic.

## Requirement
- PHP ^8.4

## Installation
```bash
composer install marcoconsiglio/modular-arithmetic
```

## Usage
Construct a modular integer with its modulus.

```php
use Marcoconsiglio\ModularArithmetic\ModularInteger;

$hour_on_a_clock = 12;
$current_hour = new ModularInteger(15, $hour_on_a_clock);
echo "The current hour is $current_hour->value o'clock.";
```
```
The current hour is 3 o'clock.
```

## Modular Arithmetic
### Addition
You can add two `ModularInteger`: the sum will be a `ModularInteger` instance.
```php
use Marcoconsiglio\ModularArithmetic\ModularInteger;

$hour_on_a_clock = 12;
$work_start = new ModularInteger(9, $hour_on_a_clock);
$working_time = new ModularInteger(9, $hour_on_a_clock);
$work_end = $work_start->add($working_time);
echo "I'm going to start to work at {$work_start->value} o'clock a.m.\n";
echo "I'll work for {$working_time->value} hours.\n";
echo "I'll finish to work at {$work_end->value} o'clock p.m.";
```
```
I'm going to start to work at 9 o'clock a.m.
I'll work for 9 hours.
I'll finish to work at 6 o'clock p.m.
```

### Multiplication
You can multiply two `ModularInteger`: the product will be a `ModularInteger` instance.

```php
use Marcoconsiglio\ModularArithmetic\ModularInteger;

$hours_in_a_day = 24;
$start_shift = new ModularInteger(0, $hours_in_a_day); /* midnight */
$shift_duration = new ModularInteger(3, $hours_in_a_day);
$my_shift = new ModularInteger(5, $hours_in_a_day); /* 5th turn */
$time_to_wait = $shift_duration->multiply($my_shift);
$my_shift_start = $start_shift->add($time_to_wait);
echo "There is a new guard shift every {$shift_duration->value} hours.\n";
echo "My shift, starts at {$my_shift_start->value} o'clock.";
```
```
There is a new guard shift every 3 hours.
My shift, the 5th, starts at 15 o'clock.
```

### Exponentiation
You can raise to power $k$ a `ModularInteger`: the result will be a `ModularInteger` instance.
```php
use Marcoconsiglio\ModularArithmetic\ModularInteger;

$alphabet_lenght = 26;
$alphabet_set = range('A', 'Z');
$message = ['H', 'E', 'L', 'L', 'O'];
$encrypted_message = [];
$cypher_key = 3;
echo "Encrypting the message:\n";
echo implode("", $message)."\n";
foreach ($message as $char) {
    $unencrypted_index = new ModularInteger(
        array_search($char, $alphabet_set),
        $alphabet_lenght
    );
    $encrypted_index = $unencrypted_index->power($cypher_key);
    $encrypted_message[] = $alphabet_set[$encrypted_index->value];
}
echo "Encrypted message:\n";
echo implode("", array: $encrypted_message);
```
```
Encrypting the message:
HELLO
Encrypted message:
FMFFO
```

## Error Exceptions
### DifferentModulusError
This error is thrown when you try to perform an arithmetic operation using two `ModularInteger` with different modulus.

```php
use Marcoconsiglio\ModularArithmetic\ModularInteger;

$a = new ModularInteger(3, 7);
$b = new ModularInteger(5, 12);
$sum = $a->add($b); // Throws DifferentModulusError
```
```
Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError: Different modules cannot be used (7 and 12).
```
### IntegerOverflowError
This error is thrown when the value of a `ModularInteger` cannot be stored in a int type variable because it's too large.

```php
use Marcoconsiglio\ModularArithmetic\ModularInteger;

$a = new ModularInteger(100, 1000);
$sum = $a->power(100); // Throws IntegerOverflowError
```
```
Marcoconsiglio\ModularArithmetic\Exceptions\IntegerOverflowError: The number 1.0E+200 exceeds the max integer value of 9223372036854775807 on this system.
```