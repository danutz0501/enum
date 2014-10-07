# PHP Enum Emulator [![Build Status](https://travis-ci.org/danielcosta/enum.png?branch=master)](https://travis-ci.org/danielcosta/enum) [![Coverage Status](https://img.shields.io/coveralls/danielcosta/enum.svg)](https://coveralls.io/r/danielcosta/enum)

## Why?

First, and mainly, `SplEnum` is not integrated to PHP, you have to install the extension separately.

Using an enum instead of class constants provides the following advantages:

- You can type-hint: `function setAction(Action $action) {`
- You can enrich the enum with methods (e.g. `format`, `parse`, …)
- You can extend the enum to add new values (make your enum `final` to prevent it)
- You can get a list of all the possible values (see below for `values()` and `keys()`)

This Enum class is not intended to replace class constants, but only to be used when it makes sense.


## Declaration

```php
use DanielCosta\Enum\Enum;

/**
 * Action enum
 */
class Action extends Enum
{
    const VIEW = 'view';
    const EDIT = 'edit';
}
```


## Usage

```php
$action = new Action(Action::VIEW);

// or
$action = Action::VIEW();
```

As you can see, static methods are automatically implemented to provide quick access to an enum value.

One advantage over using class constants is to be able to type-hint enum values:

```php
function setAction(Action $action) {
    // ...
}
```

## Documentation

- `__construct($key)` The constructor checks that the value exist in the enum
- `__toString()` You can `echo $myValue`, it will display the enum value (value of the constant)
- `getValue()` Returns the current value of the enum
- `values()` (static) Returns an array of all possible values (constant name in key, constant value in value)
- `keys()` (static) Returns an array of all possible keys (constant names as values on return array)
- `isValidKey($key)` (static) Returns true if passed `key` is a valid constant key

### Static methods

```php
class Action extends Enum
{
    const VIEW = 'view';
    const EDIT = 'edit';
}

// Static method:
$action = Action::VIEW();
$action = Action::EDIT();
```

Static method helpers are implemented using [`__callStatic()`](http://www.php.net/manual/en/language.oop5.overloading.php#object.callstatic).

If you care about IDE autocompletion, you can either implement the static methods yourself:

```php
class Action extends Enum
{
    const VIEW = 'view';

    /**
     * @return Action
     */
    public static function VIEW() {
        return new Action(self::VIEW);
    }
}
```

or you can use phpdoc (this is supported in PhpStorm for example):

```php
/**
 * @method static Action VIEW()
 * @method static Action EDIT()
 */
class Action extends Enum
{
    const VIEW = 'view';
    const EDIT = 'edit';
}
```
