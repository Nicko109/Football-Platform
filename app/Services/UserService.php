<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function index()
    {
        return User::latest()->get();
    }

    public static function store(array $data) : User
    {

        return User::create($data);
    }


    public static function update(User $user, array $data)
    {

        return $user->update($data);
    }

    public static function destroy(User $user)
    {


        return $user->delete();
    }
}
