<?php
namespace Sleepi\Controller;

use Sleepi\Model\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ApiController
{
    public function getCurrentUser(Request $request)
    {
        $userModel = new User();
        $apiKey = $request->getHeader('Authorization');
        $user = $userModel->getUserByKey($apiKey);

        return $user;
    }

    public function gcmSend($code, $message)
    {
        $gcm = [
            'code' => $code,
            'message' => $message,
        ];
        return $gcm;
    }
}
