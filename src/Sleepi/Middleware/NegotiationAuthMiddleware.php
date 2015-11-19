<?php

namespace Sleepi\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Sleepi\Model\User;

class NegotiationAuthMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $header = $request->getHeader('Content-type');

        if(0 === strpos($header[0], 'application/json')){
            if($this->isAuthorized($request) === TRUE){
                return $next($request, $response);
            }else{
                $response = $response->withStatus(401)
                    ->withHeader('Content-type', 'application/json')
                    ->write(json_encode([
                        'status_code'=> 401,
                        'status_message' => 'Unauthorized !',
                    ]));

                return $response;
            }
        }else{
            $response = $response->withStatus(406)
                ->withHeader('Content-type', 'application/json')
                ->write(json_encode([
                        'status_code'=> 406,
                        'status_message' => 'Content-type Not acceptable',
                ]));

            return $response;
        }
    }

    private function isAuthorized(Request $request)
    {
        $userModel = new User();
        $apiKey = $request->getHeader('Authorization');

        if (empty($apiKey[0])) {
            return false;
        }

        $user = $userModel->countUserByKey($apiKey);

        if($user == 0){
            return false;
        }

        return true;
    }
}
