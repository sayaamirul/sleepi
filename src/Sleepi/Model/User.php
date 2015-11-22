<?php

namespace Sleepi\Model;

use Illuminate\Database\Capsule\Manager as Database;
use DateTime;

class User extends Database
{
    protected $table = 'users';

    public function register($data = [])
    {
        $apiKey = hash(
                'sha512',
                $data['username'] . $data['password'] .
                (new DateTime())->format('Y-m-d H:i:s'));
        $password = hash('sha512', $data['password']);

        $this->table('users')
            ->insert([
                'username' => $data['username'],
                'password' => $password,
                'fullname' => $data['fullname'],
                'gender'   => $data['gender'],
                'address'  => $data['address'],
                'phone_number' => $data['phone_number'],
                'api_key'  => $apiKey,
            ]);
    }

    public function login($data = [])
    {
        $username = $data['username'];
        $password = hash('sha512', $data['password']);

        $user = $this->table('users')
            ->select('api_key')
            ->where('username', '=', $username)
            ->where('password','=', $password);

        $userExist = $user->count();
        $userData = $user->get();

        if($userExist == 0){
            return false;
        }

        return $userData;
    }

    public function userExist($username)
    {
        $exist = $this->table('users')
            ->select('id')
            ->where('username', '=', $username)
            ->count();

        return $exist;
    }

    public function getUsers()
    {
        $users = $this->table('users')->get();

        return $users;
    }

    public function getUserById($id)
    {
        $user = $this->table('users')
            ->select('*')
            ->where('id', '=' , $id)
            ->get();

        return $user;
    }

    public function getUserByKey($key)
    {
        $user = $this->table('users')
            ->select('*')
            ->where('api_key', '=', $key)
            ->get();

        return $user;
    }

    public function countUserbyKey($key)
    {
        $user = $this->table('users')
            ->where('api_key', '=', $key)
            ->count();

        return $user;
    }
}
