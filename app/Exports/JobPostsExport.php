<?php

namespace App\Exports;

use App\Models\JobPost;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JobPostsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = JobPost::query()->with(['company', 'category']);

        if (!empty($this->filters['search'])) {
            $query->where('title', 'like', '%' . $this->filters['search'] . '%');
        }
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        if (!empty($this->filters['destination_country'])) {
            $query->where('destination_country', $this->filters['destination_country']);
        }
        if (!empty($this->filters['visa_type'])) {
            $query->where('visa_type', $this->filters['visa_type']);
        }
        if (!empty($this->filters['job_type'])) {
            $query->where('job_type', $this->filters['job_type']);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tiêu đề',
            'Công ty',
            'Danh mục',
            'Quốc gia',
            'Loại Visa',
            'Hình thức',
            'Mức lương tối thiểu',
            'Mức lương tối đa',
            'Đơn vị tiền tệ',
            'Trạng thái',
            'Ngày tạo'
        ];
    }

    public function map($jobPost): array
    {
        return [
            $jobPost->id,
            $jobPost->title,
            $jobPost->company ? str_ireplace('company_', '', $jobPost->company->name) : 'N/A',
            $jobPost->category ? str_ireplace('category_', '', $jobPost->category->name) : 'N/A',
            $jobPost->destination_country,
            $jobPost->visa_type,
            $jobPost->job_type,
            $jobPost->salary_min,
            $jobPost->salary_max,
            $jobPost->salary_currency,
            $jobPost->status,
            $jobPost->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
