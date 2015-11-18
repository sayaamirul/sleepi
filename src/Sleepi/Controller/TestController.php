<?php
namespace Sleepi\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class TestController extends ApiController
{
    public function indexAction(Request $request, Response $response, $args)
    {
        $responseData = [
            'status_code' => 200,
            'status_message' => 'Welcome to Sleepi :D',
        ];

        return $this->jsonResponse($response, $responseData);
    }
}
