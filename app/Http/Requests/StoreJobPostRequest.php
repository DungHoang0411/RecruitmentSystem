<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Phải đổi thành true
    }

    public function rules(): array
    {
        return [
            'title'      => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'deadline'   => 'required|date',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min',
            'status'     => 'nullable|string|in:active,closed,draft'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'      => 'Vui lòng nhập tiêu đề tin tuyển dụng.',
            'department.required' => 'Vui lòng nhập phòng ban.',
            'deadline.required'   => 'Vui lòng chọn hạn nộp hồ sơ.',
            'salary_max.gte'      => 'Mức lương tối đa phải lớn hơn hoặc bằng mức lương tối thiểu.'
        ];
    }
}