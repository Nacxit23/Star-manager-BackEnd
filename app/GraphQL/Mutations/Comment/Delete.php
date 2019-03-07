<?php

namespace App\GraphQL\Mutations\Comment;

use App\Models\Comment;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Delete
{
    /**
     * @param $root
     * @param array $args
     * @param GraphQLContext $context
     *
     * @return mixed
     * @throws \Throwable
     */
    public function resolve($root, array $args, GraphQLContext $context)
    {
        $user = $context->user();
        $comment = Comment::find(
            GlobalId::decodeID($args['id'])
        );

        throw_unless(
            $comment,
            UserError::class,
            'Comment not found.'
        );

        throw_unless(
            $comment->user_id == $user->id || $user->is_admin,
            UserError::class,
            'You do not have permission to delete this comment.'
        );

        $comment->delete();

        return $comment;
    }
}
