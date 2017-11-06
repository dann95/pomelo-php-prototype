<?php


namespace Pomelo\Router;


use Pomelo\Common\Collection;
use Pomelo\Http\Request;

class ArgumentsResolver
{
    public function resolve(Request $request, Route $route)
    {
        return new Collection();
    }
}