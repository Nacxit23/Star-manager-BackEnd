<?php

namespace App\GraphQL\Mutations\User;

use App\models\User;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateAdmin
{
    /**
     * @param $root
     * @param array $args
     * @param GraphQLContext $context
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function resolve($root, array $args, GraphQLContext $context)
    {
        throw_unless(
            $context->user()->is_admin,
            UserError::class,
            'You do not have permission'
        );

        return tap(User::find(GlobalId::decodeID($args['id'])))->update([
            'is_admin' => true,
        ]);
    }
}
