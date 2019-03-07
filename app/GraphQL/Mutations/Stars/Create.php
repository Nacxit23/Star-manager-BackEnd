<?php

namespace App\GraphQL\Mutations\Stars;

use App\Models\Event;
use App\Models\Star;
use App\Models\User;
use GraphQL\Error\UserError;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class Create
{
    /**
     * @param $root
     * @param array $args
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function resolve($root, array $args)
    {
        $userId = GlobalId::decodeID($args['userId']);
        /** @var User $user */
        $user = User::find($userId);

        throw_unless($user, UserError::class, 'User not found');

        /** @var Star $star */
        $star = Star::create([
            'user_id' => $userId,
        ]);
        $starCount = $user->stars()
            ->where([
                'event_id' => null,
                'paid_at' => null,
            ])
            ->count();

        if ($starCount == 3) {
            $event = Event::create([
                'name' => 'Thanks '.$user->name.' 🤤',
            ]);

            Star::where('user_id', $userId)
                ->where('event_id', null)
                ->where('paid_at', null)
                ->update([
                    'event_id' => $event->id,
                ]);

            $star->refresh();
        }

        return $star;
    }
}
