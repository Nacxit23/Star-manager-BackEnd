<?php

namespace App\GraphQL\Mutations\Comment;

use App\Models\Comment;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Update
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

        /** @var Comment $comment */
        $comment = Comment::find(
            GlobalId::decodeID($input['id'])
        );

        throw_unless(
            $comment,
            UserError::class,
            'Comment not found.'
        );

        throw_unless(
            $comment->user_id == $context->user()->id,
            UserError::class,
            'You do not have permission to update this comment.'
        );

        $comment->update([
            'description' => $input['description'],
        ]);

        return $comment;
    }
}
