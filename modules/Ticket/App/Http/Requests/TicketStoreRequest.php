<?php

namespace Modules\Ticket\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\Ticket\App\Enums\TicketStatusEnum;

class TicketStoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }

    public function rules()
    {
        return [
            'title' => [ 'required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000',],
            'user_id' => ['required','integer','exists:users,id'],
            'file' => ['required', 'file', 'max:4096', 'mimes:pdf,jpg,png,docx'],
        ];
    }

}