<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'password' => 'required',
        ];
    }

    public function getCredentials(): array
    {
        $username = $this->get('username');

        if ($this->isEmail($username)) {
            return [
                'email' => $username,
                'password' => $this->get('password')
            ];
        }

        return $this->only('name', 'password');
    }

    private function isEmail($param)
    {
        $factory = $this->container->make(Factory::class);

        return ! $factory->make(
            ['name' => $param],
            ['name' => 'email']
        )->fails();
    }
}
