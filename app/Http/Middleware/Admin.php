<?php

namespace App\Http\Middleware;

use Closure;
use GraphQL\Error\UserError;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if (! $user || ! $user->is_admin) {
            throw new UserError('You are not authorized to perform this action');
        }

        return $next($request);
    }
}
