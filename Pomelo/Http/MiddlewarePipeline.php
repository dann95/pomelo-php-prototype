<?php


namespace Pomelo\Http;


use Pomelo\Common\Collection;


class MiddlewarePipeline
{
    /**
     * @var array
     */
    private $pipeline;
    /**
     * @var Response
     */
    private $response;
    /**
     * @var Request
     */
    private $request;

    /**
     * @var \Closure
     */
    private $then;
    /**
     * MiddlewarePipeline constructor.
     * @param array $application
     * @param array $route
     */
    public function __construct(array $application = [], array $route = [])
    {
        $this->pipeline = array_merge($application, $route);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function request(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @param Response $response
     * @return $this
     */
    public function response(Response $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @param $callback
     * @return $this
     */
    public function then($callback)
    {
        $this->then = $callback;
        return $this;
    }

    public function execute()
    {
        //@TODO
    }
}