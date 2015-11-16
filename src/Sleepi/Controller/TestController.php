<?php
namespace Sleepi\Controller;

use Sleepi\Model\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

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
                    'data'  => $users->all(),
            ]));

        return $response;
    }
}
