<?php

namespace GromIT\Instagram\Requests;

use GromIT\Instagram\Dto\SyncMediaDto;

/**
 * @property int $account_id
 */
class SyncMediasRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'account_id.required' => 'Такого аккаунта нет',
        ];
    }

    public function toDto(): SyncMediaDto
    {
        return new SyncMediaDto([
            'account_id' => $this->account_id,
        ]);
    }
}
