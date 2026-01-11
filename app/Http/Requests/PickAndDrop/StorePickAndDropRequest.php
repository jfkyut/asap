<?php

namespace App\Http\Requests\PickAndDrop;

use Illuminate\Foundation\Http\FormRequest;

class StorePickAndDropRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sender_location' => 'required|string|max:255',
            'sender_full_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:20',
            'sender_note' => 'nullable|string',
            'receiver_location' => 'required|string|max:255',
            'receiver_full_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'receiver_note' => 'nullable|string',
            'status' => 'required|string|max:50',
            'payment_method' => 'required|string|max:100',
        ];
    }
}
