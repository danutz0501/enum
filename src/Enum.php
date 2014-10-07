<?php

namespace DanielCosta\Enum;

/**
 * Class Enum
 *
 * Create an enum by implementing this class and adding class constants.
 *
 * @package DanielCosta\Enum
 * @author  Daniel Costa
 */
abstract class Enum
{
    /**
     * Enum value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Store existing constants in a static cache per object.
     *
     * @var array
     */
    private static $cache = array();

    /**
     * Creates a new value of some type
     *
     * @param mixed $value
     *
     * @throws \UnexpectedValueException if incompatible type is given.
     */
    public function __construct($value)
    {
        if (!in_array($value, self::values())) {
            throw new \UnexpectedValueException("Value '$value' is not part of the enum " . get_called_class());
        }

        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * Returns the names (or keys) of all of constants in the enum
     *
     * @return array
     */
    public static function keys()
    {
        return array_keys(static::values());
    }

    /**
     * Returns all possible values as an array
     *
     * @return array Constant name in key, constant value in value
     */
    public static function values()
    {
        $class = get_called_class();
        if (!array_key_exists($class, self::$cache)) {
            $reflection = new \ReflectionClass($class);
            self::$cache[$class] = $reflection->getConstants();
        }

        return self::$cache[$class];
    }

    /**
     * Check if is valid enum value
     *
     * @static
     *
     * @param $value
     *
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, self::values());
    }

    /**
     * Check if is valid enum key
     *
     * @static
     *
     * @param $key
     *
     * @return bool
     */
    public static function isValidKey($key)
    {
        return in_array($key, self::keys());
    }

    /**
     * Returns a value when called statically like so: MyEnum::SOME_VALUE() given SOME_VALUE is a class constant
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return static
     * @throws \BadMethodCallException
     */
    public static function __callStatic($name, $arguments)
    {
        if (defined("static::$name")) {
            return new static(constant("static::$name"));
        }

        throw new \BadMethodCallException("No static method or enum constant '$name' in class " . get_called_class());
    }
}
