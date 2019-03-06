<?php

namespace App\GraphQL\Mutations\Events;

use App\Models\Event;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class Delete
{
    /**
     * @param $root
     * @param array $args
     * @return int
     * @throws \Throwable
     */

    public function resolve($root, array $args)
    {
        throw_unless(
            auth()->user()->is_admin,
            UserError::class,
            'You do not have permission to delete a event'
        );

        $event = Event::find(
            GlobalId::decodeID($args['id'])
        );
        $event->delete();

        return $event;
    }
}
