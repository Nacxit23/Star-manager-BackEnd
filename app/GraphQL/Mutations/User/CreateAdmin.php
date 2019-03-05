<?php

namespace App\GraphQL\Mutations\User;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;

class CreateAdmin
{
    /**
     * @param $root
     * @param array $args
     * @param GraphQLContext $context
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function resolve($root, array $args)
    {
        throw_unless(
            auth()->user()->is_admin,
            UserError::class,
            "You do not have permission"
        );

        $userAdmin = User::find(
            GlobalId::decodeID($args['id'])
        );

        $userAdmin->update([
            'is_admin' => true
        ]);

        return $userAdmin;
    }
}
