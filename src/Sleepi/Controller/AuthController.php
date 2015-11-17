<?php

namespace Sleepi\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Sleepi\Model\User;
use Valitron\Validator;

class AuthController extends ApiController
{
    public function registerAction(Request $request, Response $response, $args)
    {
        $userModel = new User();

        $errorMessages = array();

        $req = $request->getParsedBody();

        $v = new Validator($req);
        $v->rule('required', ['username', 'password']);

        if($v->validate()) {
            $data = [
                'username' => $req['username'],
                'password' => md5($req['password']),
            ];

            $userModel->registerUser($data);

            $response = $response->withStatus(201)
                ->withHeader('Content-type', 'application/json')
                ->write(json_encode([
                        'status_code' => 201,
                        'status_message' => 'Success',
                        'data'  => $data,
                ]));
        } else {
            $response = $response->withStatus(406)
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode([
                    'status_code' => 406,
                    'status_message' => 'Error',
                    'error_message'  => $v->errors(),
            ]));
        }

        return $response;
    }

    public function loginAction(Request $request, Response $response, $args)
    {

    }
}