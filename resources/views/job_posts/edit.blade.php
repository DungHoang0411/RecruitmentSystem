@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Chỉnh Sửa Tin Tuyển Dụng</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('job-posts.update', $jobPost->slug) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $jobPost->title) }}"
                        required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="draft" {{ old('status', $jobPost->status) == 'draft' ? 'selected' : '' }}>Draft
                        </option>
                        <option value="published" {{ old('status', $jobPost->status) == 'published' ? 'selected' : '' }}>
                            Published</option>
                        <option value="closed" {{ old('status', $jobPost->status) == 'closed' ? 'selected' : '' }}>Closed
                        </option>
                        <option value="expired" {{ old('status', $jobPost->status) == 'expired' ? 'selected' : '' }}>Expired
                        </option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Quốc gia đến <span class="text-danger">*</span></label>
                    <input type="text" name="destination_country" class="form-control"
                        value="{{ old('destination_country', $jobPost->destination_country) }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Hình thức công việc <span class="text-danger">*</span></label>
                    <select name="job_type" class="form-select" required>
                        <option value="full_time"
                            {{ old('job_type', $jobPost->job_type) == 'full_time' ? 'selected' : '' }}>Full time</option>
                        <option value="part_time"
                            {{ old('job_type', $jobPost->job_type) == 'part_time' ? 'selected' : '' }}>Part time</option>
                        <option value="contract" {{ old('job_type', $jobPost->job_type) == 'contract' ? 'selected' : '' }}>
                            Contract</option>
                        <option value="internship"
                            {{ old('job_type', $jobPost->job_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Loại Visa <span class="text-danger">*</span></label>
                    <select name="visa_type" class="form-select" required>
                        <option value="tokutei" {{ old('visa_type', $jobPost->visa_type) == 'tokutei' ? 'selected' : '' }}>
                            Tokutei</option>
                        <option value="ginou_jisshu"
                            {{ old('visa_type', $jobPost->visa_type) == 'ginou_jisshu' ? 'selected' : '' }}>Ginou Jisshu
                        </option>
                        <option value="other" {{ old('visa_type', $jobPost->visa_type) == 'other' ? 'selected' : '' }}>
                            Other</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Số lượng tuyển <span class="text-danger">*</span></label>
                    <input type="number" name="headcount" class="form-control"
                        value="{{ old('headcount', $jobPost->headcount) }}" required min="1">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Lương tối thiểu</label>
                    <input type="number" name="salary_min" class="form-control"
                        value="{{ old('salary_min', $jobPost->salary_min ? round($jobPost->salary_min) : '') }}"
                        min="0">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Lương tối đa</label>
                    <input type="number" name="salary_max" class="form-control"
                        value="{{ old('salary_max', $jobPost->salary_max ? round($jobPost->salary_max) : '') }}"
                        min="0">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tiền tệ</label>
                    <input type="text" name="salary_currency" class="form-control"
                        value="{{ old('salary_currency', $jobPost->salary_currency) }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Chu kỳ lương</label>
                    <input type="text" name="salary_period" class="form-control"
                        value="{{ old('salary_period', $jobPost->salary_period) }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Kinh nghiệm tối thiểu (năm)</label>
                    <input type="number" name="experience_years_min" class="form-control"
                        value="{{ old('experience_years_min', $jobPost->experience_years_min) }}" min="0">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tuổi tối thiểu</label>
                    <input type="number" name="age_min" class="form-control"
                        value="{{ old('age_min', $jobPost->age_min) }}" min="18">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tuổi tối đa</label>
                    <input type="number" name="age_max" class="form-control"
                        value="{{ old('age_max', $jobPost->age_max) }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Yêu cầu giới tính</label>
                    <select name="gender_preference" class="form-select">
                        <option value="any"
                            {{ old('gender_preference', $jobPost->gender_preference) == 'any' ? 'selected' : '' }}>Bất kỳ
                        </option>
                        <option value="male"
                            {{ old('gender_preference', $jobPost->gender_preference) == 'male' ? 'selected' : '' }}>Nam
                        </option>
                        <option value="female"
                            {{ old('gender_preference', $jobPost->gender_preference) == 'female' ? 'selected' : '' }}>Nữ
                        </option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Địa điểm làm việc</label>
                    <input type="text" name="work_location" class="form-control"
                        value="{{ old('work_location', $jobPost->work_location) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Ngày xuất bản</label>
                    <input type="date" name="published_at" class="form-control"
                        value="{{ old('published_at', $jobPost->published_at ? $jobPost->published_at->format('Y-m-d') : '') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Ngày hết hạn</label>
                    <input type="date" name="expired_at" class="form-control"
                        value="{{ old('expired_at', $jobPost->expired_at ? $jobPost->expired_at->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" value="1"
                    {{ old('is_featured', $jobPost->is_featured) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">Tin nổi bật</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả công việc <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="4" required>{{ old('description', $jobPost->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Yêu cầu công việc</label>
                <textarea name="requirements" class="form-control" rows="3">{{ old('requirements', $jobPost->requirements) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Quyền lợi</label>
                <textarea name="benefits" class="form-control" rows="3">{{ old('benefits', $jobPost->benefits) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('job-posts.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
