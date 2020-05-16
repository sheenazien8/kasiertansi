<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch (request()->method) {
            case 'PATCH':
                $validation = [
                    'name' => 'required',
                    'code' => 'required',
                    'category_id' => 'required',
                ];
                break;
            case 'POST':
                $validation = [
                    'name' => 'required',
                    'code' => 'required',
                    'category_id' => 'required',
                ];
                break;

            default:
                $validation = [
                    'name' => ''
                ];
                break;
        }

        return $validation;
    }

    /**
     * Custome validation message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required.',
        ];
    }
}
