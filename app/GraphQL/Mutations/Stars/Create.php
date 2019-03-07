<?php

namespace App\GraphQL\Mutations\Stars;

use App\Models\Event;
use App\Models\Star;
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
        $userId = GlobalId::decodeID($args['userId']);
        $context->user()->is_admin;

        $star = Star::create([
            'user_id' => $userId,
        ]);

        $stars = Star::where('user_id', $userId)
            ->where('event_id', null)
            ->where('paid_at', null)
            ->count();

        if ($stars >= 3) {
            $event = Event::create();

            Star::where('user_id', $userId)
                ->where('event_id', null)
                ->where('paid_at', null)
                ->update([
                    'event_id' => $event->id,
                ]);
        }

        return $star;
    }
}
