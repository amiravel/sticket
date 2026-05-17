<?php

namespace Modules\Ticket\App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ticket\App\Enums\TicketStatusEnum;
use Modules\Ticket\Database\Factories\TicketFactory;
use Modules\User\App\Models\User;


#[Fillable(['title', 'description', 'status', 'user_id', 'file'])]
class Ticket extends Model
{

    use HasFactory;

    protected $casts = [
        'status' => TicketStatusEnum::class,
    ];

    public static function newFactory(): TicketFactory
    {
        return TicketFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}