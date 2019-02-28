<?php

namespace App\GraphQL\Mutations\Comment;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\Comment;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CreateComment
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
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        Auth::loginUsingId(1);
        $user = Auth::user();
        $inputEvent = $args['input'];

        if ($user) {
          $eventArgs = $inputEvent['eventId'];
          $findEventId = Event::findOrFail($eventArgs);

          $inputs = [
            'description' => $inputEvent['description'],
            'event_id'    => $eventArgs,
            'user_id'     => $user->id
          ];
          return Comment::create($inputs);
        }
    }
}
