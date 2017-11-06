<?php


namespace Pomelo\Router;
use Pomelo\Common\Obj;
use Pomelo\Config\Config;
use Pomelo\Http\Request;

class Route
{
    /**
     * @var array
     */
    private $methods;
    /**
     * @var string
     */
    private $uri;
    /**
     * @var \Closure|string
     */
    private $action;
    /**
     * @var array
     */
    private $middleware;
    /**
     * @var string|null
     */
    private $name;

    /**
     * Route constructor.
     * @param $allowedMethods
     * @param $uri
     * @param $options
     */
    public function __construct(array $allowedMethods, $uri, $options)
    {
        $this->methods = $allowedMethods;
        $this->uri = $uri;
        $this->action = $options['action'];
        $this->middleware = Obj::optional($options, [])['middleware'];
        $this->name = Obj::optional($options)['name'];
        $this->namespace = Obj::optional($options, Config::get('application.routes.namespace'))['namespace'];
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param $method
     * @return bool
     */
    public function isAllowedForMethod($method)
    {
        return in_array(strtoupper($method), $this->methods);
    }

    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return ActionResolver
     */
    public function resolveAction()
    {
        $resolver = new ActionResolver();
        return $resolver->resolve($this);
    }

    /**
     * @param Request $request
     * @return \Pomelo\Common\Collection
     */
    public function resolveArguments(Request $request)
    {
        $resolver = new ArgumentsResolver();
        return $resolver->resolve($request, $this);
    }

    public function uriRegex()
    {
        return UriRegex::generate($this->uri);
    }
}