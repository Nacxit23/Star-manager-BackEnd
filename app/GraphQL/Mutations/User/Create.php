<?php

namespace App\GraphQL\Mutations\User;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use GraphQL\Error\UserError;
use App\Models\User;

class Create
{
    /**
     * @param $root
     * @param array $args
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function resolve($root, array $args)
    {
        $imput = $args['input'];

        $password = Hash::make($imput['password']);

        return User::create([
            'email' => $imput['email'],
            'first_name' => $imput['firstName'],
            'last_name'=> $imput['lastName'],
            'password' => $password,
        ]);
    }
}
