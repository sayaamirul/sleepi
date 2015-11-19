<?php

namespace Sleepi\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class NegotiationMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $header = $request->getHeader('Content-type');

        if(0 === strpos($header[0], 'application/json')){
            return $next($request, $response);
        }else{
            $response = $response->withStatus(406)
                ->withHeader('Content-type', 'application/json')
                ->write(json_encode([
                        'status_code'=> 406,
                        'status_message' => 'Content Type Not acceptable',
                ]));

            return $response;
        }
    }
}
