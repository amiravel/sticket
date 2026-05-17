<?php

namespace Modules\Ticket\App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['action', 'class', 'response'])]
class Log extends Model
{
    protected $casts = [
        'response' => 'json',
    ];
}
