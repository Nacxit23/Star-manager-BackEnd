<?php

namespace App\GraphQL\Mutations\Stars;

use App\Models\Event;
use App\Models\Star;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Delete
{

    public function resolve($root, array $args, GraphQLContext $context)
    {

        $star = Star::findOrFail(
            GlobalId::decodeID($args['id'])
        );

        $event = $star->event_id;

        $eventCount = $star->user->stars()
            ->whereNotNull('event_id')
            ->whereNull('paid_at')
            ->count();

        $starCount = $star->user->stars()
            ->where([
                'event_id' => null,
                'paid_at' => null,
            ])->count();

        if ($eventCount == 3) {
            Star::where('event_id', $event)
                ->update(['event_id' => null]);
            $eventId = Event::find($event);
            $eventId->delete();
            $star->user->events()->detach($star->event_id);
            return $star->delete();
        } elseif ($starCount <= 2) {
            return $star->delete();
        }

    }
}
