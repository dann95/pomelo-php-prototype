<?php

namespace Pomelo\Http;

use Pomelo\Application;
use Pomelo\Http\Cookies\CookiesBag;
use Pomelo\Http\Files\FileBag;
use Pomelo\Router\Route;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements ServerRequestInterface
{
    /**
     * @var Route
     */
    private $route;
    /**
     * @var ParameterBag
     */
    private $get;
    /**
     * @var ParameterBag
     */
    private $post;
    /**
     * @var ParameterBag
     */
    private $server;
    /**
     * @var CookiesBag
     */
    private $cookies;
    /**
     * @var FileBag
     */
    private $files;

    private $routeArguments;

    public function __construct($get, $post, $server, $cookies, $files)
    {
        $this->get = new ParameterBag($get);
        $this->post = new ParameterBag($post);
        $this->server = new ParameterBag($server);
        $this->cookies = new CookiesBag($cookies);
        $this->files = new FileBag($files);
    }

    /**
     * @param Application $application
     * @return Request
     */
    public static function detect(Application $application)
    {
        $request = new static($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES);
        $route = $application->router()->match($request);
        return $request->setRoute($route);
    }

    public function getServerParams()
    {
        // TODO: Implement getServerParams() method.
    }

    public function getCookieParams()
    {
        // TODO: Implement getCookieParams() method.
    }

    public function withCookieParams(array $cookies)
    {
        // TODO: Implement withCookieParams() method.
    }

    public function getQueryParams()
    {
        // TODO: Implement getQueryParams() method.
    }

    public function withQueryParams(array $query)
    {
        // TODO: Implement withQueryParams() method.
    }

    public function getUploadedFiles()
    {
        // TODO: Implement getUploadedFiles() method.
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        // TODO: Implement withUploadedFiles() method.
    }

    public function getParsedBody()
    {
        // TODO: Implement getParsedBody() method.
    }

    public function withParsedBody($data)
    {
        // TODO: Implement withParsedBody() method.
    }

    public function getAttributes()
    {
        // TODO: Implement getAttributes() method.
    }

    public function getAttribute($name, $default = null)
    {
        // TODO: Implement getAttribute() method.
    }

    public function withAttribute($name, $value)
    {
        // TODO: Implement withAttribute() method.
    }

    public function withoutAttribute($name)
    {
        // TODO: Implement withoutAttribute() method.
    }

    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
    }

    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }

    public function getMethod()
    {
        // TODO: Implement getMethod() method.
    }

    public function withMethod($method)
    {
        // TODO: Implement withMethod() method.
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->server->get('REQUEST_URI');
    }

    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        // TODO: Implement withUri() method.
    }

    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
    }

    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
    }

    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    public function hasHeader($name)
    {
        // TODO: Implement hasHeader() method.
    }

    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
    }

    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
    }

    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }

    public function getBody()
    {
        // TODO: Implement getBody() method.
    }

    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }

    /**
     * @param Route $route
     * @return $this
     */
    public function setRoute(Route $route = null)
    {
        $arguments = [];
        if($route !== null) {
            $this->route = $route;
            $arguments = $route->resolveArguments($this);
        }

        $this->routeArguments = $arguments;
        return $this;
    }

    public function getRoute()
    {
        return $this->route;
    }
}