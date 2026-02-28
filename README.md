![GitHub License](https://img.shields.io/github/license/MarcoConsiglio/php-modular-arithmetic)
![GitHub Release](https://img.shields.io/github/v/release/MarcoConsiglio/php-modular-arithmetic)
![Static Badge](https://img.shields.io/badge/version-v3.2.0-white)<br>
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
Construct a modular number with its modulus.

```php
use Marcoconsiglio\ModularArithmetic\ModularInteger;

$hour_on_a_clock = 12;
$current_hour = new ModularNumber(15, $hour_on_a_clock);
echo "The current hour is $current_hour->value o'clock.";
```
```
The current hour is 3 o'clock.
```

## Modular Arithmetic
### Addition
You can add two `ModularNumber`: the sum will be a `ModularNumber` instance.
```php
use Marcoconsiglio\ModularArithmetic\ModularNumber;

$hour_on_a_clock = 12;
$work_start = new ModularNumber(9, $hour_on_a_clock);
$working_time = new ModularNumber(9, $hour_on_a_clock);
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
You can multiply two `ModularNumber`: the product will be a `ModularNumber` instance.

```php
use Marcoconsiglio\ModularArithmetic\ModularNumber;

$hours_in_a_day = 24;
$start_shift = new ModularNumber(0, $hours_in_a_day); /* midnight */
$shift_duration = new ModularNumber(3, $hours_in_a_day);
$my_shift = new ModularNumber(5, $hours_in_a_day); /* 5th turn */
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
You can raise to power $k$ a `ModularNumber`: the result will be a `ModularNumber` instance.
```php
use Marcoconsiglio\ModularArithmetic\ModularNumber;

$alphabet_lenght = 26;
$alphabet_set = range('A', 'Z');
$message = ['H', 'E', 'L', 'L', 'O'];
$encrypted_message = [];
$cypher_key = 3;
echo "Encrypting the message:\n";
echo implode("", $message)."\n";
foreach ($message as $char) {
    $unencrypted_index = new ModularNumber(
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
use Marcoconsiglio\ModularArithmetic\ModularNumber;

$a = new ModularNumber(3, 7);
$b = new ModularNumber(5, 12);
$sum = $a->add($b); // Throws DifferentModulusError
```
```
Marcoconsiglio\ModularArithmetic\Exceptions\DifferentModulusError: Two different modulus cannot be used (7 and 12).
```

## API documentation
See more on the API documentation at `./docs/html/index.html`.