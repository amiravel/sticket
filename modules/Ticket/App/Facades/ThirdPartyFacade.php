<?php

namespace Modules\Ticket\App\Facades;

use Illuminate\Support\Facades\Facade;

class ThirdPartyFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ThirdParty::class;
    }
}
