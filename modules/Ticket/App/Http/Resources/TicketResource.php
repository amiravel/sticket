<?php

namespace Modules\Ticket\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class TicketResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'file_path' => $this->file,
            'user' => new UserResource($this->user),
            'status' => $this->status->value,
        ];
    }
}