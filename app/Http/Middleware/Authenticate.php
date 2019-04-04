<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;

class Authenticate extends Middleware
{
    /**
     * {@inheritdoc}
     */
    protected function authenticate($request, array $guards)
    {
        if (! $this->auth->check()) {
            throw new AuthenticationException('Unauthenticated.', $guards);
        }
    }
}
