<?php


namespace Pomelo\Router;

use Pomelo\Http\Request;
use Pomelo\Router\Uri;

class Router
{
    /**
     * @var array
     */
    private $verbs = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'OPTIONS',
        'PATCH'
    ];
    /**
     * @var RouteCollection
     */
    private $collection;

    public function __construct()
    {
        $this->collection = new RouteCollection();
    }

    /**
     * @param Request $request
     * @return Route
     */
    public function match(Request $request)
    {
        $uri = $request->getUri();
        $route = $this->collection
            ->filter(function ($_route) use($uri){
                return UriRegex::matches($_route->uriRegex(), $uri);
            });
        return $route->first();
    }

    /**
     * @param $allowedMethods
     * @param $uri
     * @param $options
     * @return $this
     */
    public function addRoute($allowedMethods, $uri, $options)
    {
        if($options instanceof \Closure) {
            $options = ['action' => $options];
        }
        $this->collection->addRoute($allowedMethods, $uri, $options);
        return $this;
    }

    public function group($options, $callback)
    {
        $group = new RouterGroup($options);
        $callback($group);
    }

    /**
     * @param $verboses
     * @param $options
     * @return Router
     */
    public function many($verboses, $uri, $options)
    {
        return $this->addRoute($verboses, $uri, $options);
    }
    /**
     * @param $options
     * @return Router
     */
    public function any($uri, $options)
    {
        return $this->addRoute($this->verboses, $uri, $options);
    }

    public function __call($name, $arguments)
    {
        if(in_array($_verbose = strtoupper($name), $this->verbs))
            return $this->addRoute([$_verbose], ...$arguments);

        throw new \Exception("Invalid Route Method");
    }
}