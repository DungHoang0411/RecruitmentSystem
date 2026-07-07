@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Chi Tiết Tin Tuyển Dụng #{{ $jobPost->id }}</h2>
            <a href="{{ route('job-posts.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $jobPost->title }}</h4>
                @if ($jobPost->is_featured)
                    <span class="badge bg-warning text-dark">Nổi bật</span>
                @endif
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Trạng thái:</strong></div>
                    <div class="col-md-9"><span class="badge bg-primary">{{ $jobPost->status }}</span></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Quốc gia đến:</strong></div>
                    <div class="col-md-9">{{ $jobPost->destination_country }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Hình thức công việc:</strong></div>
                    <div class="col-md-9">{{ $jobPost->job_type }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Loại Visa:</strong></div>
                    <div class="col-md-9">{{ $jobPost->visa_type }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Số lượng tuyển (Headcount):</strong></div>
                    <div class="col-md-9">{{ $jobPost->headcount }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Mức lương:</strong></div>
                    <div class="col-md-9">
                        @if ($jobPost->salary_min || $jobPost->salary_max)
                            {{ $jobPost->salary_min ? round($jobPost->salary_min) : '0' }} -
                            {{ $jobPost->salary_max ? round($jobPost->salary_max) : 'Không giới hạn' }}
                            {{ $jobPost->salary_currency }} / {{ $jobPost->salary_period }}
                        @else
                            Thỏa thuận
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Kinh nghiệm tối thiểu:</strong></div>
                    <div class="col-md-9">
                        {{ $jobPost->experience_years_min ? $jobPost->experience_years_min . ' năm' : 'Không yêu cầu' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Độ tuổi yêu cầu:</strong></div>
                    <div class="col-md-9">
                        @if ($jobPost->age_min || $jobPost->age_max)
                            {{ $jobPost->age_min ?? 'Không giới hạn dưới' }} -
                            {{ $jobPost->age_max ?? 'Không giới hạn trên' }} tuổi
                        @else
                            Không yêu cầu
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Yêu cầu giới tính:</strong></div>
                    <div class="col-md-9">{{ $jobPost->gender_preference }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Địa điểm làm việc:</strong></div>
                    <div class="col-md-9">{{ $jobPost->work_location ?? 'Chưa cập nhật' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Lượt xem / Ứng tuyển:</strong></div>
                    <div class="col-md-9">{{ $jobPost->view_count }} lượt xem / {{ $jobPost->application_count }} ứng
                        tuyển</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Ngày xuất bản / Hết hạn:</strong></div>
                    <div class="col-md-9">
                        {{ $jobPost->published_at ? $jobPost->published_at->format('d/m/Y') : 'Chưa xuất bản' }} /
                        {{ $jobPost->expired_at ? $jobPost->expired_at->format('d/m/Y') : 'Không hết hạn' }}
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <h5>Mô tả công việc:</h5>
                    <div class="border p-3 bg-light ck-content">{!! $jobPost->description !!}</div>
                </div>
                <div class="mb-3">
                    <h5>Yêu cầu công việc:</h5>
                    <div class="border p-3 bg-light ck-content">{!! $jobPost->requirements ?? 'Không có' !!}</div>
                </div>
                <div class="mb-3">
                    <h5>Quyền lợi:</h5>
                    <div class="border p-3 bg-light ck-content">{!! $jobPost->benefits ?? 'Không có' !!}</div>
                </div>
            </div>
            <div class="card-footer text-muted text-end fs-7">
                {{ $jobPost->created_by }} | Tạo lúc: {{ $jobPost->created_at }} | Cập nhật lúc:
                {{ $jobPost->updated_at }}
            </div>
        </div>
    </div>
@endsection
