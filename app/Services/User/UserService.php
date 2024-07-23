<?php

namespace App\Services\User;

use App\DataTransferObjects\UserDto;
use App\Models\User;

class UserService
{
    /**
     * UserService constructor
     *
     * @param UserDto $userDto
     * @return User
     */
    public function store(UserDto $userDto): User
    {
        $user = User::query()
            ->where(function ($query) use ($userDto) {
                $query->where('username', '=', $userDto->username)
                    ->orWhere('phone', '=', $userDto->phone);
            })
            ->first();

        if (!$user) {
            $user = User::create([
                'username' => $userDto->username,
                'phone' => $userDto->phone
            ]);
            $user->save();
        }

        return $user;
    }
}
