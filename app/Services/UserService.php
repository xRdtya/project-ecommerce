<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function create(array $data)
    {
        return User::create($data);
    }
}