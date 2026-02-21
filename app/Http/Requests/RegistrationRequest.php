<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Imię jest wymagane.',
            'name.string' => 'Imię musi być tekstem.',
            'name.max' => 'Imię nie może być dłuższe niż 255 znaków.',
            'email.required' => 'E-mail jest wymagany.',
            'email.string' => 'E-mail musi być tekstem.',
            'email.email' => 'E-mail musi być poprawnym adresem e-mail.',
            'email.max' => 'E-mail nie może być dłuższy niż 255 znaków.',
            'email.unique' => 'E-mail jest już zajęty.',
            'password.required' => 'Hasło jest wymagane.',
            'password.string' => 'Hasło musi być tekstem.',
            'password.min' => 'Hasło musi mieć co najmniej 8 znaków.',
            'password.confirmed' => 'Hasła muszą się zgadzać.',
            'terms.accepted' => 'Musisz zaakceptować regulamin.'
        ];
    }

}
