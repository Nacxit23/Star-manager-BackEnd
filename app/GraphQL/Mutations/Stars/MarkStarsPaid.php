<?php

namespace App\GraphQL\Mutations\Stars;

use App\Models\Star;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class MarkStarsPaid
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
        $context->user()->is_admin;
        $eventId = GlobalId::decodeID($input['eventId']);

        return tap(Star::where('event_id', $eventId)->where('paid_at', null)->update([
            'paid_at' => $input['paidAt'],
        ]));
    }
}
