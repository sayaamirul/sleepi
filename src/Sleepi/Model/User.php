<?php

namespace Sleepi\Model;

use Illuminate\Database\Capsule\Manager as Database;

class User extends Database
{
    protected $table = 'users';

    public function registerUser($data = [])
    {
        $this->table('users')->insert([
            'username' => $data['username'],
            'password' => $data['password'],
        ]);
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