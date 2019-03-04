<?php

namespace App\GraphQL\Mutations\Comment;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;


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
    public function resolve($rootValue, array $args, GraphQLContext $context)
    {
        $input = $args['input'];
        $user = $context->user();

        /** @var Comment $comment */
        $comment = Comment::find(
            GlobalId::decodeID($input['id'])
        );

        throw_unless(
            $comment,
            UserError::class,
            'Comment not found.'
        );

        $comment->update([
            'description' => $input['description'],
        ]);

        return $comment;
    }
}
