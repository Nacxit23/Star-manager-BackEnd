<?php

namespace App\GraphQL\Mutations\Events;

use App\Models\Event;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Delete
{
    /**
     * @param $root
     * @param array $args
     * @return int
     * @throws \Throwable
     */
    public function resolve($root, array $args, GraphQLContext $context)
    {
        $context->user()->is_admin;

        return tap(Event::find(GlobalId::decodeID($args['id'])))->delete();
    }
}
