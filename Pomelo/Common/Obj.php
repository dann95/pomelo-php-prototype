<?php


namespace Pomelo\Common;


class Obj
{
    /**
     * @param $object
     * @param null $default
     * @return OptionalProperty
     */
    public static function optional($object, $default = null)
    {
        return new OptionalProperty($object, $default);
    }
}