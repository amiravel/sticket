<?php

namespace Modules\Ticket\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Ticket\App\Enums\TicketStatusEnum;

class TicketUpdateRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->id(),
            'ticket_id' => $this->route('id')
        ]);
    }

    public function rules(): array
    {
        return [
            'ticket_id' => ['required' ,'integer', 'exists:tickets,id'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', Rule::in(TicketStatusEnum::values())],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}