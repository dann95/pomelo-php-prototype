<?php


namespace Pomelo\Common;


class OptionalProperty implements \ArrayAccess
{
    private $object;
    private $default;

    /**
     * OptionalProperty constructor.
     * @param $object
     * @param null $default
     */
    public function __construct($object, $default = null)
    {
        $this->object = $object;
        $this->default = $default;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return is_array($this->object) && key_exists($offset, $this->object);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return ($this->offsetExists($offset)) ? $this->object[$offset] : $this->default;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->object[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->object[$offset]);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return (property_exists($this->object, $name)) ? $this->object->$name : $this->default;
    }
}