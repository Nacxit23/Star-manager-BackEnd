<?php

namespace App\GraphQL\Mutations\Comment;

use App\Models\Event;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Create
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
        $user = $context->user();

        /** @var Event $event */
        $event = Event::find(
            GlobalId::decodeID($input['eventId'])
        );

        throw_unless(
            $event,
            UserError::class,
            'Event not found.'
        );

        $userExists = $event->users()->where('id', $user->id)->exists();

        throw_unless(
            $userExists,
            UserError::class,
            'You do not have permission to comment on this event.'
        );

        return $event->comments()->create([
            'description' => $input['description'],
            'user_id' => $user->id,
        ])->refresh();
    }
}
