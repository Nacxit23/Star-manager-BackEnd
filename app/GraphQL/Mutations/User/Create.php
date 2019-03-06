<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;

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

        return User::create([
            'email' => $imput['email'],
            'first_name' => $imput['firstName'],
            'last_name' => $imput['lastName'],
            'password' => bcrypt($imput['password']),
        ])->refresh();
    }
}
