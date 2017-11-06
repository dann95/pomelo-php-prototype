<?php


namespace Pomelo\Config;


class Loader
{
    /**
     * @param $path
     * @param $basePath
     * @return mixed
     */
    private static function key($path, $basePath)
    {
        return str_replace([$basePath, '/'], '', $path);
    }

    /**
     * @param $file
     * @param $basePath
     * @return mixed
     */
    private static function file($file, $basePath)
    {
        return str_replace([$basePath, '.php', '/'], '', $file);
    }

    public static function load($dir = null)
    {
        if(! file_exists($dir)) {
            throw new \Exception("Config dir does not exists");
        }
        $keys = glob($dir.'/*', GLOB_ONLYDIR);
        $result = [];
        foreach ($keys as $key) {
            $files = glob($key.'/*.php');
            foreach($files as $file) {
                $result[self::key($key, $dir)][self::file($file, $key)] = require $file;
            }
            ConfigCollection::instance($result);
        }
    }
}