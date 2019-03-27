<?php

namespace App\GraphQL\Mutations\User;

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
        throw_unless(
            Auth::guard('web')->attempt($args['input']),
            UserError::class,
            'The password and the email do not apply.'
        );

        $user = Auth::guard('web')->user();

        return ['token' => $user->api_token];
    }
}
