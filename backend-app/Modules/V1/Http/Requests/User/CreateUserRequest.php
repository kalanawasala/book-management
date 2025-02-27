<?php

namespace Modules\V1\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $error = $validator->errors();
            $data = [];
            foreach ($error->messages() as $key => $value) {
                $data[] = $value[0];
            }
            if (!empty($data)) {

                $errors = ['success' => false, 'error' => $data];
                throw new HttpResponseException(response($errors, 422));
            }
        });
    }
}
