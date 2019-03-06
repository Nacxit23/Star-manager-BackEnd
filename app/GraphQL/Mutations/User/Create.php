<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use Illuminate\Support\Str;

class Create
{
    /**
     * @param $root
     * @param array $args
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function resolve($root, array $args)
    {
        $imput = $args['input'];

        do {
            $token = Str::random(60);
        } while (User::where('api_token', $token)->exists());

        return User::create([
            'api_token' => $token,
            'email' => $imput['email'],
            'first_name' => $imput['firstName'],
            'last_name' => $imput['lastName'],
            'password' => bcrypt($imput['password']),
        ])->refresh();
    }
}
