<?php


namespace Pomelo\Common;


class Collection
{
    /**
     * @var array
     */
    protected $items;

    /**
     * Collection constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public static function collect(array $items = [])
    {
        return new static($items);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return key_exists($key, $this->items);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->items[$key];
    }

    public function add($item, $key = null)
    {

    }

    public function forget($name)
    {

    }

    /**
     * @return mixed|null
     */
    public function first()
    {
        return array_shift($this->items);
    }

    /**
     * @return mixed|null
     */
    public function last()
    {
        return array_pop($this->items);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    public function only($keys = [])
    {

    }

    public function except($keys = [])
    {

    }

    /**
     * @param $callback
     * @return $this
     */
    public function map($callback)
    {
        $result = array_map($callback, $this->items);
        $this->items = $result;
        return $this;
    }

    public function filter($callback)
    {
        $result = [];
        foreach($this->items as $key => $value) {
            if($callback($value, $key)) {
                $result[$key] = $value;
            }
        }
        $this->items = $result;
        return $this;
    }
}