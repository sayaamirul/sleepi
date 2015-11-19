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

            $responseData = [
                'status_code' => 201,
                'status_message' => 'Success',
                'data'  => $data,
            ];
        } else {
            $responseData = [
                'status_code' => 406,
                'status_message' => 'Error',
                'error_messages'  => $v->errors(),
            ];
        }

        return $this->jsonResponse($response, $responseData);
    }

    public function loginAction(Request $request, Response $response, $args)
    {

    }
}
