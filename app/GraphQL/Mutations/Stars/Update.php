<?php

namespace App\GraphQL\Mutations\Stars;

use App\Models\Star;
use GraphQL\Error\UserError;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class Update
{
    /**
     * @param $root
     * @param array $args
     *
     * @return mixed
     * @throws \Throwable
     */

    public function resolve($root, array $args)
    {

        $input = $args['input'];

        $eventId = GlobalId::decodeID($input['eventId']);

        $stars = Star::where('event_id', $eventId)
            ->where('paid_at', null)
            ->get();

        $totalrows = $stars->count();

        throw_unless(
            Auth::user()->is_admin,
            UserError::class,
            'You do not have permission to update a star'
        );

        if ($totalrows >= 3) {
            $stars = Star::where('event_id', $eventId)
                ->where('paid_at', null)
                ->limit(3)
                ->update([
                    'paid_at' => $input['paidAt'],
                ]);
            return $stars;
        }
    }
}
