<?php
// https://blog.avenuecode.com/the-best-way-to-use-request-validation-in-laravel-rest-api
// https://medium.com/@sgandhi132/how-to-validate-an-api-request-in-laravel-35b46470ba88
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdRequest extends FormRequest
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
                'company_id' => 'required|exists:companies,id|unique:companies_blacklist,company_id',
                'job_id' => 'required|exists:jobs,id',
                'salary' => 'required|numeric|in:1,2,3,4,5,6',
                'seniority' => 'required|numeric|in:1,2,3,4,5',
                'work_type' => 'required|numeric|in:1,2,3,4',
                'ad_url' => 'required|min:5|max:255',
                'requirements' => 'required|min:5|max:255',
                'explanation' => 'nullable|min:25|max:255',
            ];
        } else {
            return [
                'company_id' => 'required|exists:companies,id',
                'job_id' => 'required|exists:jobs,id',
                'salary' => 'required|numeric|in:1,2,3,4,5,6',
                'seniority' => 'required|numeric|in:1,2,3,4,5',
                'work_type' => 'required|numeric|in:1,2,3,4',
                'ad_url' => 'required|min:5|max:255',
                'requirements' => 'required|min:5|max:255',
                'explanation' => 'nullable|min:25|max:255',
            ];
        }
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'company_id.unique' => ':attribute در لیست سیاه ثبت شده است',
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'requirements' => 'نیازمندی‌های آگهی',
        ];
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
