<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachUserClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'classroom_id.required' => 'A turma é obrigatória.',
            'classroom_id.exists' => 'A turma informada não existe.',
        ];
    }
}