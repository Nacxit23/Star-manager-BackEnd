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
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
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

        return $comment->update([
            'description' => $input['description'],
            'user_id' => $user->id,
        ]);
        }
    }
