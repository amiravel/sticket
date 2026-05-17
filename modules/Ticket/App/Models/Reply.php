<?php

namespace Modules\Ticket\App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ticket\Database\Factories\ReplyFactory;

#[Fillable('user_id', 'ticket_id', 'description')]
class Reply extends Model
{

    use HasFactory;
    public static function newFactory(): ReplyFactory
    {
        return ReplyFactory::new();
    }

}