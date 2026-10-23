<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'min:2', 'max:100'],
            'phone'          => ['required', 'string', 'min:9', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'email'          => ['nullable', 'email', 'max:100'],
            'event_type'     => ['nullable', 'string', 'max:50'],
            'event_date'     => ['nullable', 'date', 'after:today'],
            'event_location' => ['nullable', 'string', 'max:200'],
            'needs'          => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama wajib diisi.',
            'name.min'          => 'Nama minimal 2 karakter.',
            'phone.required'    => 'Nomor telepon wajib diisi.',
            'phone.regex'       => 'Format nomor telepon tidak valid.',
            'email.email'       => 'Format email tidak valid.',
            'event_date.after'  => 'Tanggal event harus di masa mendatang.',
            'needs.required'    => 'Deskripsi kebutuhan wajib diisi.',
            'needs.min'         => 'Deskripsi kebutuhan minimal 10 karakter.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Sanitize phone number
        if ($this->phone) {
            $this->merge(['phone' => trim($this->phone)]);
        }
    }
}
