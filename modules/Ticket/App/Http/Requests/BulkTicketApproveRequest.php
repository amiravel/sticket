<?php

namespace Modules\Ticket\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\RolesEnum;

class BulkTicketApproveRequest extends FormRequest
{

    public function authorize(){
        return auth()->user()->role->name == RolesEnum::AdminLevel_1->name;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'integer', 'exists:tickets,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'description' => ['nullable', 'string'],
        ];
    }

}