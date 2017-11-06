<?php


namespace Pomelo;

use Pomelo\Config\Config;
use Pomelo\Http\Kernel;
use Pomelo\Http\Request;
use Pomelo\Http\Response;
use Pomelo\Router\Router;
use Pomelo\Session\SessionHandler;
use Pomelo\Container\Container;

class Application
{
    /**
     * @var Router
     */
    private $router;
    /**
     * @var SessionHandler
     */
    private $session;

    private $files;

    private $container;

    /**
     * Application constructor.
     * @param null $container
     * @param array $custom
     */
    public function __construct($container = null, $custom = [])
    {
        $this->router = new Router(Config::get('application.routes.files'));
        $this->session = new SessionHandler();
        $this->container = ($container instanceof Container) ? $container : new Container();
    }

    public function router()
    {
        return $this->router;
    }

    public function session()
    {
        return $this->session;
    }

    /**
     * @param $key
     */
    public function config($key)
    {
        return Config::get($key);
    }

    /**
     * @return mixed
     */
    public function files()
    {
        return $this->file;
    }

    /**
     * @return Request
     */
    public function request()
    {
        return $this->container->make(Request::class);
    }

    /**
     * @return mixed
     */
    public function response()
    {
        return $this->container->make(Response::class);
    }

    /**
     * @return $this
     */
    public function handleHttpRequest()
    {
        $this->container->singleton(Request::class, function (){
            $request = \Pomelo\Http\Request::detect($this);
            return $request;
        });
        $this->container->singleton(Response::class, function ($container){
            $response = new Response();
            return $response;
        });
        $kernel = new Kernel();
        $request = $this->request();
        $response = $this->response();
        $this->container->execute([$kernel, 'handle'], [$request, $response]);
        return $this;
    }
}