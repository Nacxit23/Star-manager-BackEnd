<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;
use http\Message;
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

        $loginapi = Arr::only($input,['email','password']);

        throw_unless(
            Auth::guard('web')->attempt($loginapi),
            UserError::class,
            'You do not have permission to comment on this event.'
        );

        $user = User::where('email','=',$input['email'])->first();
         return $user;
    }
}
