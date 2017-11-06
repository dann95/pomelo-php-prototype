<?php


namespace Pomelo\Common;


class Arr
{
    /**
     * @param $array
     * @param null $default
     * @return OptionalProperty
     */
    public static function optional($array, $default = null)
    {
        return new OptionalProperty($array, $default);
    }
}