<?php


namespace Pomelo\Config;

use Pomelo\Common\Collection;

class ConfigCollection
{
    /**
     * @var Collection
     */
    private static $instance;

    /**
     * @param array $settings
     */
    private static function initialize(array $settings)
    {
        self::$instance = new Collection($settings);
    }

    /**
     * @param array $settings
     * @return Collection
     */
    public static function instance(array $settings = [])
    {
        if(! self::$instance instanceof Collection) {
            self::initialize($settings);
        }
        return self::$instance;
    }
}