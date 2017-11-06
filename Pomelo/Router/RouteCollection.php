<?php


namespace Pomelo\Router;

use Pomelo\Common\Collection;

class RouteCollection extends Collection
{
    public function addRoute($allowedMethods, $uri, $options)
    {
        if(! $this->has($uri)){
            $this->items[$uri] = new Route($allowedMethods, $uri, $options);
        }
    }
}