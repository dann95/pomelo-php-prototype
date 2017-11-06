<?php


namespace Pomelo\Http;


abstract class Middleware
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return mixed
     */
    public abstract function handle(Request $request, Response $response, $next);
}