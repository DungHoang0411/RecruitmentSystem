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

        if (!empty($this->filters['company_id'])) {
            $query->where('company_id', $this->filters['company_id']);
        }

        if (!empty($this->filters['category_id'])) {
            $query->where('category_id', $this->filters['category_id']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['created_at'])) {
            $query->whereDate('created_at', $this->filters['created_at']);
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
            'Mô tả chi tiết',
            'Yêu cầu công việc',
            'Quyền lợi',
            'Địa điểm làm việc',
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
            $jobPost->description,
            $jobPost->requirements,
            $jobPost->benefits,
            $jobPost->location,
            $jobPost->status,
            $jobPost->created_at->format('d/m/Y H:i:s'),
        ];
    }
}
