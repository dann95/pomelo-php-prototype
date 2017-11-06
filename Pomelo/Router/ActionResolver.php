<?php


namespace Pomelo\Router;


class ActionResolver
{
    public function resolve(Route $route)
    {
        if(is_callable($action = $route->getAction())) {
            return $action;
        }
        // logic to find Controller and return [Class,Method]
    }
}