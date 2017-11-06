<?php


namespace Pomelo\Http;


use App\Http\Middleware\AbortMiddleware;
use App\Http\Middleware\AppendSomethingMiddleware;
use App\Http\Middleware\RandomMiddleware;
use Pomelo\Router\ActionExecuter;

class Kernel
{
    public function handle(Request $request, Response $response)
    {
        $destination = function ($request, $response) {
            return (new ActionExecuter())->execute($request->getRoute());
        };

        /**
         * Hardcoded Middlewares..
         */
        $app = [];
        $route = [];

        $pipeline = (new MiddlewarePipeline($app, $route))
            ->request($request)
            ->response($response)
            ->then($destination);

        $result = $pipeline->execute();
        //@TODO assert result type (String, Int, Array) append it to response.
    }
}