<?php

namespace App\GraphQL\Mutations\User;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\models\User;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Illuminate\Support\Facades\Auth;

class Delete
{
   /**
     * @param $root
     * @param array $args
     * @param GraphQLContext $context
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function resolve($rootValue, array $args)
    {
        $user = Auth::user();
        $input = $args['input'];

        throw_unless(
            $user->is_admin,
            UserError::class,
            'You do not have permission to delete a user'
        );

        $comment = User::find(
            GlobalId::decodeID($input['id'])
        );
        User::destroy($comment->id);

        return $comment;
    }
}
