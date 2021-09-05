<?php

namespace GromIT\Instagram\Requests;

use GromIT\Instagram\Dto\CreateAccountDto;

/**
 * @property int         $instagram_id
 * @property string      $username
 * @property string|null $full_name
 * @property string|null $external_url
 * @property int         $follows_count
 * @property int         $followed_by_count
 * @property int         $media_count
 * @property string      $rapid_api_key
 * @property string|null $avatar
 */
class CreateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'instagram_id'  => 'required',
            'username'      => 'required',
            'rapid_api_key' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'instagram_id.required' => 'Ошибка добавления аккаунта',
            'username.required'     => 'Необходимо указать имя пользователя',
            'api_key.required'      => 'Не указан API-ключ',
        ];
    }

    public function toDto(): CreateAccountDto
    {
        return new CreateAccountDto([
            'instagram_id'      => $this->instagram_id,
            'username'          => $this->username,
            'full_name'         => $this->full_name,
            'external_url'      => $this->external_url,
            'follows_count'     => $this->follows_count,
            'followed_by_count' => $this->followed_by_count,
            'media_count'       => $this->media_count,
            'rapid_api_key'     => $this->rapid_api_key,
            'avatar'            => $this->avatar,
        ]);
    }
}
