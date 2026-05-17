<?php

namespace Modules\Ticket\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\User\Enums\RolesEnum;
use Symfony\Component\HttpFoundation\Response;


class IsAdmin
{

    public function handle(Request $request, Closure $next): Response
    {
        if(
            !in_array($request->user()->role->name, [RolesEnum::AdminLevel_1->name, RolesEnum::AdminLevel_2->name])
        ) {
             abort(401);
        }

        return $next($request);
    }

}