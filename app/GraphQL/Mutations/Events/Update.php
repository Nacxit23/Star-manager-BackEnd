<?php

namespace App\GraphQL\Mutations\Events;

use App\Models\Event;
use Nuwave\Lighthouse\Execution\Utils\GlobalId;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Update
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

        return tap(Event::find(GlobalId::decodeID($input['id'])))->update([
            'date' => $input['date'],
            'name' => $input['name'],
        ]);
    }
}
