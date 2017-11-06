<?php


namespace Pomelo;


class ApplicationFactory
{
    /**
     * @var Application
     */
    private static $instance;

    private static function make()
    {
        self::$instance = new Application();
    }

    /**
     * @return Application
     */
    public static function instance()
    {
        if(! self::$instance instanceof Application) {
            self::make();
        }
        return self::$instance;
    }
}