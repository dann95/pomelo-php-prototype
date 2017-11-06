<?php


namespace App\Http\Middleware;

use Pomelo\Http\Middleware;
use Pomelo\Http\Request;
use Pomelo\Http\Response;

class RandomMiddleware extends Middleware
{
    public function handle(Request $request, Response $response, $next)
    {
        return $next($request, $response);
    }
}