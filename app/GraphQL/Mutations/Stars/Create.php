<?php

namespace App\GraphQL\Mutations\Stars;

use App\Models\Event;
use App\Models\Star;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class Create
{
    /**
     * @param $root
     * @param array $args
     * @return mixed
     * @throws \Throwable
     */
    public function resolve($root, array $args)
    {
        $userId = GlobalId::decodeID($args['userId']);

        throw_unless(
            auth()->user()->is_admin,
            UserError::class,
            'You do not have permission to create a star'
        );

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
