<?php

namespace App\GraphQL\Mutations\Comment;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\Comment;
use GraphQL\Error\UserError;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

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
    public function resolve($root, array $args, GraphQLContext $context)
    {
        $input = $args['input'];

        throw_unless(
            $context->user()->is_admin,
            UserError::class,
            'You do not have permission to delete a comment'
        );

        return tap(Comment::find(GlobalId::decodeID($input['id'])))->delete();
    }
}
