<?php

namespace App\GraphQL\Mutations\User;

use App\models\User;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class CreateAdmin
{
    /**
     * @param $root
     * @param array $args
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function resolve($root, array $args)
    {
        return tap(User::find(GlobalId::decodeID($args['id'])))->update([
            'is_admin' => true,
        ]);
    }
}
