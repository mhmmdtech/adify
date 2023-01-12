<?php
// https://blog.avenuecode.com/the-best-way-to-use-request-validation-in-laravel-rest-api
// https://medium.com/@sgandhi132/how-to-validate-an-api-request-in-laravel-35b46470ba88
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobRequest extends FormRequest
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
                'job_title' => 'required|min:3|max:50|unique:jobs,job_title',
                'requirements' => 'required',
            ];
        } else {
            return [
                'job_title' => 'required|min:3|max:50',
                'requirements' => 'required',
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
