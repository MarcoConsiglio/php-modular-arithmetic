![GitHub License](https://img.shields.io/github/license/MarcoConsiglio/php-modular-arithmetic)
![GitHub Release](https://img.shields.io/github/v/release/MarcoConsiglio/php-modular-arithmetic)
![Static Badge](https://img.shields.io/badge/version-v4.0.0-white)<br>
![Static Badge](https://img.shields.io/badge/100%25-rgb(40%2C%20167%2C%2069)?label=Line%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/100%25-rgb(40%2C%20167%2C%2069)?label=Branch%20coverage&labelColor=rgb(255%2C255%2C255))
![Static Badge](https://img.shields.io/badge/67%25-rgb(229%2C%20161%2C%200)?label=Path%20coverage&labelColor=rgb(255%2C255%2C255))
# Modular Arithmetic
A PHP libarary to support modular arithmetic, aka *clock arithmetic*. 

This software is made to overcome the [limit of modulo operation in PHP](https://bugs.php.net/bug.php?id=76287) where a negative modulus (divisor) would be treated as a positive one.

It also provide convenient modular arithmetic operations.

It is based on arbitrary precision calculations made with [BC Math Extended](https://github.com/MarcoConsiglio/bcmath-extended), check its API documentation to more info about the `Number` class.

# Index
- [Requirement](#requirement)
- [Usage](#usage)
- [Operations on a `ModularNumber`](#operations-on-a-modularnumber)
  - [Addition](#addition)
  - [Multiplication](#multiplication)
  - [Exponentiation](#exponentiation)
- [Operations on a `ModularRelativeNumber`](#operations-on-a-modularrelativenumber)
  - [Addition](#addition-1)
- [API documentation](#api-documentation)

## Requirement
- PHP ^8.4
- [BCMath extension](https://www.php.net/manual/en/book.bc.php)

## Installation
```bash
composer install marcoconsiglio/modular-arithmetic
```

## Usage
A `ModularNumber` is a number placed in a ring with positive numbers starting from zero.
The length of this ring is the **modulus**.

A `ModularRelativeNumber` is a number placed in a `Ring` whose **start** and **end** can be relative (like -180/180). In this case the start coincides with the end.

Construct a `ModularNumber` with its modulus if the ring has only positive numbers.

```php
use Marcoconsiglio\ModularArithmetic\ModularNumber;

$hour_on_a_clock = 12;
$current_hour = new ModularNumber(15, $hour_on_a_clock);
echo "The current hour is $current_hour->value o'clock.";
```
```
The current hour is 3 o'clock.
```

Construct a `ModularNumber` with its `Ring` (or start and end of the `Ring`)

```php
use Marcoconsiglio\ModularArithmetic\ModularRelativeNumber;
use Marcoconsiglio\ModularArithmetic\Ring;

$start = -180;
$end = 180;
$steering_wheel = ModularRelativeNumber::createFromExtremes(
    30, -180, 180
);

echo "Turn left {$steering_wheel->value}°" . PHP_EOL;

$steering_wheel = ModularRelativeNumber::createFromRing(
    -45, new Ring($start, $end)
);

echo "Now turn right {$steering_wheel->value}°" . PHP_EOL;
```
```
Turn left 30°
Now turn right -45°
```

## Operations on a `ModularNumber`
### Addition
You can add two `ModularNumber`: the sum will be a `ModularNumber` instance.
```php
use Marcoconsiglio\ModularArithmetic\ModularNumber;

$hour_on_a_clock = 12;
$work_start = new ModularNumber(9, $hour_on_a_clock);
$working_time = new ModularNumber(9, $hour_on_a_clock);
$work_end = $work_start->add($working_time->value);
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
## Operations on a `ModularRelativeNumber`
### Addition
Only addition is available for `ModularRelativeNumber`s. To perform subtraction, add a negative `Number`.
```php
$ring = new Ring(-180, 180);
$moon_longitude = new ModularNumber(56, $ring->length);
$sun_longitude = new ModularNumber(321, $ring->length);
$angular_distance = ModularRelativeNumber::createFromRing(0, $ring);
$angular_distance = $angular_distance->add($sun_longitude->value);
$angular_distance = $angular_distance->add($moon_longitude->value);

echo "The sun is at {$sun_longitude->value}°." . PHP_EOL;
echo "The moon is at {$moon_longitude->value}°." . PHP_EOL;
echo "The angular distance between the two is {$angular_distance->value}°." . PHP_EOL;
```
```
The sun is at 321°.
The moon is at 56°.
The angular distance between the two is 17°.
```

```php
$ring = new Ring(-180, 180);
echo "The ring of numbers is a range from {$ring->start} to {$ring->end}." . PHP_EOL;

$a = ModularRelativeNumber::createFromRing(90, $ring);
$b = new Number(180);
$c = new Number(270);

echo "{$a->value} + {$b->value} = {$a->plus($b)->value}" . PHP_EOL;
echo "{$a->value} + {$c->value} = {$a->plus($c)->value}" . PHP_EOL;
```
```
The ring of numbers is a range from -180 to 180.
90 + 180 = -90
90 + 270 = 0
```

## API documentation
See more on the API documentation at `./docs/html/index.html`.