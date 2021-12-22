<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as DB;

class UserModel
{
    public static function getUserActiveData(string $email): ?object
    {
        return DB::table('users')->where('active', "=", 1)->where('email', "=", $email)->first();
    }
}