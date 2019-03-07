<?php

namespace App\GraphQL\Mutations\Stars;

use App\Models\Star;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class MarkStarsAsPaid
{
    /**
     * @param $root
     * @param array $args
     *
     * @return bool
     */
    public function resolve($root, array $args)
    {
        $input = $args['input'];
        $eventId = GlobalId::decodeID($input['eventId']);

        return !! Star::query()
            ->where('event_id', $eventId)
            ->where('paid_at', null)
            ->update([
                'paid_at' => $input['paidAt'],
            ]);
    }
}
