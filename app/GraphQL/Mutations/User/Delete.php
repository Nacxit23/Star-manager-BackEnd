<?php

namespace App\GraphQL\Mutations\User;

use GraphQL\Type\Definition\ResolveInfo;
use App\models\User;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class Delete
{
   /**
     * @param $root
     * @param array $args
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function resolve($root, array $args)
    {
        throw_unless(
            auth()->user()->is_admin,
            UserError::class,
            'You do not have permission to delete a user'
        );

        $user = User::find(
            GlobalId::decodeID($args['id'])
        );

       $user->delete();

       return $user;
    }
}
