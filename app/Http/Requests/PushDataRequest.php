<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PushDataRequest extends FormRequest
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
            'propertyid'  => ['required', 'string'],
            'room_id'     => ['required', 'string'],
            'rate_id'     => ['required', 'string'],
            'currency'    => ['nullable', 'string'],
            'apikey'      => ['required', 'string'],
            'data'        => ['required', 'array'],
            'data.*'      => ['array'], // each item must be an object
            'trackingId'  => ['nullable', 'string'],
            'version'     => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'propertyid.required' => 'The propertyid is required and must be shared with STAAH.',
            'room_id.required'    => 'The room_id is required (OTA Room ID).',
            'rate_id.required'    => 'The rate_id is required (OTA Rate ID).',
            'apikey.required'     => 'The apikey is required (shared with STAAH).',
            'data.required'       => 'The data field is required and must be an array of objects.',
            'version.required'    => 'The version field is required.',
        ];
    }
}
