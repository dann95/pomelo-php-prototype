<?php


namespace Pomelo\Config;


class Config
{
    /**
     * @param $key
     * @return array|null
     */
    public static function get($key)
    {
        $configs = ConfigCollection::instance()->all();
        $keys = explode(".", $key);
        for($i = 0; $i <= $max = count($keys) - 1; $i++){
            if(! key_exists($_key = $keys[$i], $configs))
                break;
            $configs = $configs[$_key];
            if($max == $i)
                return $configs;
        }
        return null;
    }

    public static function set($key)
    {

    }
}