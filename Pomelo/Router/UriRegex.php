<?php


namespace Pomelo\Router;

use VerbalExpressions\PHPVerbalExpressions\VerbalExpressions;

class UriRegex
{
    /**
     * @param $pattern
     * @param $uri
     * @return int
     */
    public static function matches($pattern, $uri)
    {
        return preg_match($pattern, $uri);
    }

    /**
     * @param $uri
     * @return string
     */
    public static function generate($uri)
    {
        $regex = new VerbalExpressions();
        if($uri[0] !== '/')
            $uri = '/'.$uri;

        $pieces = array_values(array_filter(explode("/", $uri), function($string) {
            return ($string) ? true : false;
        }));

        if(! count($pieces))
            return $regex->startOfLine()->then('/')->endOfLine()->getRegex();

        $regex->startOfLine()->then('/');

        for($i = 0; $i <= $max = count($pieces) - 1; $i++) {
            $_piece = $pieces[$i];
            if(self::isOptionalParameter($_piece)) {
                $regex->anything()->_or()->then('');
            }elseif(self::isParameter($_piece)) {
                $regex->anythingBut('/');
            }else {
                $regex->then($_piece);
            }
            if($i != $max)
                $regex->then('/');
        }
        $regex->endOfLine();

        return $regex->getRegex();
    }

    /**
     * @param $string
     * @return bool
     */
    private static function isParameter($string)
    {
        return $string[0] == ':';
    }

    /**
     * @param $string
     * @return bool
     */
    private static function isOptionalParameter($string)
    {
        return substr($string,0,2) == ':#';
    }
}