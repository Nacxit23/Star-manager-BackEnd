<?php

namespace App\GraphQL\Mutations\User;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class UserAdmin
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
            "You do not have permission"
        );

        $comment = User::find(
            GlobalId::decodeID($input['id'])
        );

        $comment->update([
            'is_admin' => true
        ]);

        return $comment;


    }
}
