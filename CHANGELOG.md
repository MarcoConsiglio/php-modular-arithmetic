# Changelog
## v4.1.0
### Changed
- `ModularRelativeNumber::$ring` setter is now `protected`, use `ModularRelativeNumber::createFromRing()` method instead.
- `ModularRelativeNumber::createFromExtremes()` `$start` and `$end` parameters now accept also `int`, `float`, `string` and `BcMath\Number` input types.
### Added
- `Ring::$range` virtual read-only property to express the range of the `Ring` object.
### Deprecated
- `

## v4.0.0 - 2026-04-17
### Changed
- Both `ModularNumber` and `ModularRelativeNumber` now extends the abstract class `ModularArithmeticNumber`.
- Operations methods on `ModularNumber` objects accept `int`, `string`, `float` and `BcMath\Number` types arguments other than `MarcoConsiglio\BCMathExtended\Number` type.
### Added
- `ModularArithmeticNumber` are now `Stringable`.
- `ModularNumber::normalizeArgument()` static method to transform `int` `string` `float` and `BcMath\Number` types into `MarcoConsiglio\BCMathExtended\Number` type.
- `ModularRelativeNumber` class to represent relative modular numbers.
- `Ring` class to represent the relative range allowed for a `ModularRelativeNumber` object.
### Removed
- `DifferentModulusError` exception class.


## v3.3.1 - 2026-03-31
### Changed
- Development dependencies:
  - `marcoconsiglio/faker-php-number-helpers` from ^1 to ^4

## v3.3.0 - 2026-02-28
### Added
- `Modular::number::subtract()` method to perform subtraction.
- `Modular::number::divide()` method to perform division.
- `Modular::number::sub()` alias of `Modular::number::subtract()`.
- `Modular::number::div()` alias of `Modular::number::divide()`.
- `Modular{`  
&ensp;&ensp;&ensp;&ensp;`Subtraction`   
&ensp;&ensp;&ensp;&ensp;`Division`   
`}` to provide arithmetic operations on modular numbers.
### Changed
- API documentation.

## v3.2.0 - 2026-02-28
### Added
- `ModularNumber::floor()` method to return the floor `ModularNumber` with the same modulus.
- `ModularNumber::ceil()` method to return the ceil `ModularNumber` with the same modulus.
### Changed
- API documentation.

## v3.1.2 - 2026-02-27
### Changed
- Dependencies version.

## v3.1.1 - 2026-02-24
### Changed
- Dependencies version.

## v3.1.0 - 2026-02-24
### Changed
- `ModularNumber` class constructor now accept `float` type input for both `$value` and `$modulus` parameters.
- API and README documentation.

## v3.0.0 - 2026-02-22
### Add
- `ModularNumber` to represent both integer and decimal modular numbers.
- `Modular{`  
&ensp;&ensp;&ensp;&ensp;`Addition`   
&ensp;&ensp;&ensp;&ensp;`Multiplication`   
&ensp;&ensp;&ensp;&ensp;`Exponentiation`   
`}` to provide arithmetic operations on modular numbers.
- `Operation` to chech common constraints of modular arithmetic.
### Changed
- `DifferentModulusError` now accept `ModularNumber` type inputs.
- API and README documentations.
### Removed
- `IntegerOverflowError` (no need anymore).
- `IntegerModular{`  
&ensp;&ensp;&ensp;&ensp;`Addition`  
&ensp;&ensp;&ensp;&ensp;`Exponentiation`  
&ensp;&ensp;&ensp;&ensp;`Multiplication`  
&ensp;&ensp;&ensp;&ensp;`Operation`  
`}`, use the respective `Modular`* class instead.
- `ModularInteger`, use `ModularNumber` class instead.


## v2.0.0 - 2025-01-08
### Changed
- BREAKING CHANGE: Parameter name `$a` to `$base` in `IntegerModularExponentiation::__construct()` method.
- API documentation.
- Improvements to exponentiation operation.
### Fixed
- Negative base exponentiation causing not to throws `IntegerOverflowException` when needed.

## v1.0.0 - 2025-01-04
### Added
- The `ModularInteger` class that represent an integer variable along with its modulus.
- The `IntegerModularOperation` class along with the arithmetic operations to perform modular arithmetic:
  - `IntegerModularAddition`
  - `IntegerModularMultiplication`
  - `IntegerModularExponentiation`.
- Exceptions `DifferentModulusError` and `IntegerOverflowError`.
- API documentation.
- README documentation.