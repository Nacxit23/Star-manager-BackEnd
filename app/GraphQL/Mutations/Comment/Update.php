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
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function resolve($root, array $args)
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

        $comment->update([
            'description' => $input['description'],
        ]);

        return $comment;
    }
}
