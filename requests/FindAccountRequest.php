<?php

namespace GromIT\Instagram\Requests;

use GromIT\Instagram\Dto\FindAccountDto;

/**
 * @property string $username
 * @property string $api_key
 */
class FindAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required',
            'api_key'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Необходимо указать имя пользователя',
            'api_key.required'  => 'Не указан API-ключ',
        ];
    }

    public function toDto(): FindAccountDto
    {
        return new FindAccountDto([
            'username' => $this->username,
            'api_key'  => $this->api_key,
        ]);
    }
}
