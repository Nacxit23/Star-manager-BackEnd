<?php

namespace App\GraphQL\Mutations\Star;

use App\Models\Event;
use App\Models\Star;
use Illuminate\Support\Facades\DB;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class Delete
{
    public function resolve($root, array $args)
    {

        $star = Star::findOrFail(
            GlobalId::decodeID($args['id'])
        );

        $event = $star->event;

        if ($event) {
            return DB::transaction(function () use ($event, $star) {
                $event->stars()->update(['event_id' => null]);

                $event->users()->detach();

                $event->delete();

                return $star->delete();
            });
        } else {
            return $star->delete();
        }
    }
}
