<?php
namespace Sleepi\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Sleepi\Model\User;

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
