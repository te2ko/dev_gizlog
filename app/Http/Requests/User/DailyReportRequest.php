<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
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
        return [
            'reporting_time' => 'required|before_or_equal:now',
            'title' => 'required|string|max:30',
            'content' => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'required' => '入力必須項目です。',
            'before_or_equal:now' => '今日以前の日付を入力してください。',
            'title.max' => '30文字以内で入力してください。',
            'content.max' => '1000文字以内で入力して九ださい。',
        ];
    }
}

