<?php

// https://blog.avenuecode.com/the-best-way-to-use-request-validation-in-laravel-rest-api
// https://medium.com/@sgandhi132/how-to-validate-an-api-request-in-laravel-35b46470ba88
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyRequest extends FormRequest
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
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'company_name' => 'required|min:3|max:25|unique:companies,company_name',
                'office_population' => 'required|numeric|in:1,2,3,4,5',
                'company_url' => 'required|min:5|max:255',
                'central_office' => 'required|min:3|max:25',
            ];
        } else {
            return [
                'company_name' => 'required|min:3|max:25',
                'office_population' => 'required|numeric|in:1,2,3,4,5',
                'company_url' => 'required|min:5|max:255',
                'central_office' => 'required|min:3|max:25',
            ];
        }
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'   => false,
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ]));
    }
}
