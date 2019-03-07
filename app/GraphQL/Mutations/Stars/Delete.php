<?php

namespace App\GraphQL\Mutations\Stars;

use App\Models\Star;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Delete
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
        $context->user()->is_admin;

        return tap(Star::find(GlobalId::decodeID($args['id'])))->delete();
    }
}
