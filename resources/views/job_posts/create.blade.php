@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Thêm Tin Tuyển Dụng Mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('job-posts.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Quốc gia đến <span class="text-danger">*</span></label>
                    <select name="destination_country" class="form-select" required>
                        @foreach ($countries as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('destination_country') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Hình thức công việc <span class="text-danger">*</span></label>
                    <select name="job_type" class="form-select" required>
                        @foreach ($job_types as $value => $label)
                            <option value="{{ $value }}" {{ old('job_type') == $value ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Loại Visa <span class="text-danger">*</span></label>
                    <select name="visa_type" class="form-select" required>
                        @foreach ($visa_types as $value => $label)
                            <option value="{{ $value }}" {{ old('visa_type') == $value ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Số lượng tuyển <span class="text-danger">*</span></label>
                    <input type="number" name="headcount" class="form-control" value="{{ old('headcount') }}" required
                        min="1">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Lương tối thiểu</label>
                    <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min') }}"
                        min="0">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Lương tối đa</label>
                    <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max') }}"
                        min="0">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tiền tệ</label>
                    <input type="text" name="salary_currency" class="form-control" value="{{ old('salary_currency') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Chu kỳ lương</label>
                    <input type="text" name="salary_period" class="form-control" value="{{ old('salary_period') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Kinh nghiệm tối thiểu (năm)</label>
                    <input type="number" name="experience_years_min" class="form-control"
                        value="{{ old('experience_years_min') }}" min="0">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tuổi tối thiểu</label>
                    <input type="number" name="age_min" class="form-control" value="{{ old('age_min') }}" min="18">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tuổi tối đa</label>
                    <input type="number" name="age_max" class="form-control" value="{{ old('age_max') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Yêu cầu giới tính</label>
                    <select name="gender_preference" class="form-select">
                        @foreach ($gender_preferences as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('gender_preference', 'any') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Địa điểm làm việc</label>
                    <input type="text" name="work_location" class="form-control" value="{{ old('work_location') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Ngày xuất bản</label>
                    <input type="date" name="published_at" class="form-control" value="{{ old('published_at') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Ngày hết hạn</label>
                    <input type="date" name="expired_at" class="form-control" value="{{ old('expired_at') }}">
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" value="1"
                    {{ old('is_featured') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">Tin nổi bật</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả công việc <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Yêu cầu công việc</label>
                <textarea name="requirements" class="form-control" rows="3">{{ old('requirements') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Quyền lợi</label>
                <textarea name="benefits" class="form-control" rows="3">{{ old('benefits') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Lưu lại</button>
            <a href="{{ route('job-posts.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
