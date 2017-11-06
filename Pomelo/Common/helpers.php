<?php

if(! function_exists('optional')) {
    /**
     * @param $object
     * @param null $default
     * @return \Pomelo\Common\OptionalProperty
     */
    function optional($object, $default = null)
    {
        return new \Pomelo\Common\OptionalProperty($object, $default);
    }
}