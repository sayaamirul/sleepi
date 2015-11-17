<?php
namespace Sleepi\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Sleepi\Model\User;

class TestController extends ApiController
{
    public function indexAction(Request $request, Response $response, $args)
    {
        $users = new User();

        $response = $response->withStatus(200)
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode([
                    'status_code' => 200,
                    'status_message' => 'Success',
                    'data'  => $users->getUsers(),
            ]));

        return $response;
    }
}
