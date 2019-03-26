<?php

namespace App\GraphQL\Mutations\User;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use GraphQL\Error\UserError;

class Login
{
    /**
     * @param $root
     * @param array $args
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function resolve($root, array $args){

        $input = $args['input'];
        $credentials = Arr::only($input,['email','password']);

        throw_unless(
            Auth::guard('web')->attempt($credentials),
            UserError::class,
            'The password and the mail do not apply.'
        );

        $user = Auth::guard('web')->user();
        $apiToken = $user->api_token;

        return $apiToken;
    }
}
