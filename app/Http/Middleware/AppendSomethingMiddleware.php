<?php


namespace App\Http\Middleware;

use Pomelo\Http\Middleware;
use Pomelo\Http\Request;
use Pomelo\Http\Response;

class AppendSomethingMiddleware extends Middleware
{
    public function handle(Request $request, Response $response, $next)
    {
        $response->withStatus(201);
        return $next($request, $response);
    }
}