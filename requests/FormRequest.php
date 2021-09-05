<?php

namespace GromIT\Instagram\Requests;

use Backend\Models\User;
use Illuminate\Contracts\Validation\Validator;
use October\Rain\Exception\ValidationException;


/**
 * @method User|null user($guard = null)
 */
abstract class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    abstract public function rules(): array;

    /**
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator->errors()->toArray());
    }
}

