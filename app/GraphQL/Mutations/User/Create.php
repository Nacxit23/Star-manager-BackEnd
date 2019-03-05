<?php

namespace App\GraphQL\Mutations\User;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Hash;
use GraphQL\Error\UserError;
use App\Models\User;

class Create
{
    /**
     * @param $root
     * @param array $args
     * @param GraphQLContext $context
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function resolve($rootValue, array $args, GraphQLContext $context)
    {
        $input = $args['input'];
        $emailEntered = $input['email'];

        $emailConfirm = strpos($emailEntered,'@getnerdify') !== false;
        throw_unless(
            $emailConfirm,
            UserError::class,
            'The email entered does not belong to nerdify'
        );

        $firstname = preg_match('/^[a-zA-Z\s]+$/',$input['firstName']);
        throw_unless(
            $firstname,
            UserError::class,
            'The firstname entered is not valid'
        );

        $lastname = preg_match('/^[a-zA-Z\s]+$/', $input['lastName']);
        throw_unless(
            $lastname,
            UserError::class,
            'The lastname entered is not valid'
        );

        $password = Hash::make($input['password']);

        return User::create([
            'email' => $emailEntered,
            'first_name' => $firstname,
            'last_name'=> $lastname,
            'password' => $password,
        ]);
    }
}
