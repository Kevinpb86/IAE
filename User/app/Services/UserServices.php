<?php

namespace App\Services;

class UserService
{
    public static function getAllUsers()
    {
        return self::$users;
    }

    public static function addUser($name, $email)
    {
        $id = count(self::$users) + 1;
        $user = ['id' => $id, 'name' => $name, 'email' => $email];
        self::$users[] = $user;
        return $user;
    }

    public static function getUserById($id)
    {
        foreach (self::$users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        return null;
    }
}
