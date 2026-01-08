# Changelog
## v2.0.0 - 2025-01-08
### Changed
- BREAKING CHANGE: Parameter name `$a` to `$base` in `IntegerModularExponentiation::__construct()` method.

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