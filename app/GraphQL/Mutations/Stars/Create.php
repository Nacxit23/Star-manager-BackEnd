<?php

namespace App\GraphQL\Mutations\Stars;

use App\Models\Star;
use GraphQL\Error\UserError;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class Create
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
        $user = Auth::user();

        throw_unless(
            $user->is_admin,
            UserError::class,
            'You do not have permission to create a star'
        );

        return Star::create([
            'user_id' => GlobalId::decodeID($args['input']['userId']),
        ]);
    }
}
