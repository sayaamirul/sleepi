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
        $user = new User();

        $req = $request->getParsedBody();

        $v = new Validator($req);
        $v->rule('required', ['username', 'password', 'fullname']);

        if($v->validate()) {
            if($user->userExist($req['username']) == 0){
                $data = [
                    'username' => $req['username'],
                    'password' => $req['password'],
                    'fullname' => $req['fullname'],
                    'gender'   => $req['gender'],
                    'address'  => $req['address'],
                    'phone_number' => $req['phone_number'],
                ];

                $user->register($data);
                $responseData = [
                    'status_code' => 201,
                    'status_message' => 'Success',
                    'data'  => $data,
                ];
            }else{
                $responseData = [
                    'status_code' => 406,
                    'status_message' => 'Error',
                    'error_messages'  => 'Username already registered',
                ];
            }
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
        $user = new User();

        $req = $request->getParsedBody();

        $v = new Validator($req);
        $v->rule('required', ['username', 'password']);

        if($v->validate()){
            if ($user->login($req) == false) {
                $responseData = [
                    'status_code' => 406,
                    'status_message' => 'Error',
                    'error_messages' => 'User & password not match / not found',
                ];
            }else{
                $responseData = [
                    'status_code' => 200,
                    'status_message' => 'Success',
                    'data'  => $user->login($req),
                ];
            }
        }else{
            $responseData = [
                'status_code' => 406,
                'status_message' => 'Error',
                'error_messages'  => $v->errors(),
            ];
        }

        return $this->jsonResponse($response, $responseData);
    }
}
