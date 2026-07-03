@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Thêm Tin Tuyển Dụng Mới</h2>
    
    <form action="{{ route('job-posts.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label>Tiêu đề <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label>Mô tả <span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Quốc gia đến <span class="text-danger">*</span></label>
                <input type="text" name="destination_country" class="form-control" placeholder="VD: JP, KR" value="{{ old('destination_country') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Số lượng tuyển <span class="text-danger">*</span></label>
                <input type="number" name="headcount" class="form-control" value="{{ old('headcount') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Nháp</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Đang hiển thị</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Loại công việc <span class="text-danger">*</span></label>
                <select name="job_type" class="form-select" required>
                    <option value="full_time" {{ old('job_type') == 'full_time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part_time" {{ old('job_type') == 'part_time' ? 'selected' : '' }}>Part-time</option>
                    <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Hợp đồng</option>
                    <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Thực tập</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Loại Visa <span class="text-danger">*</span></label>
                <select name="visa_type" class="form-select" required>
                    <option value="tokutei" {{ old('visa_type') == 'tokutei' ? 'selected' : '' }}>Tokutei (Đặc định)</option>
                    <option value="ginou_jisshu" {{ old('visa_type') == 'ginou_jisshu' ? 'selected' : '' }}>Ginou Jisshu (TTS)</option>
                    <option value="other" {{ old('visa_type') == 'other' ? 'selected' : '' }}>Khác</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Lưu tin mới</button>
        <a href="{{ route('job-posts.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection