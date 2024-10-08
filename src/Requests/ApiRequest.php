<?php

namespace Harrison\LaravelFeatureManager\Requests;

use Harrison\LaravelFeatureManager\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): ValidationException
    {
        throw new ValidationException($validator);
    }
}
