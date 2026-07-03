@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Chỉnh sửa Tin: <span class="text-primary">{{ $jobPost->title }}</span></h2>
        <a href="{{ route('job-posts.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            Vui lòng kiểm tra lại dữ liệu nhập vào!
        </div>
    @endif
    
    <form action="{{ route('job-posts.update', $jobPost->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- NHÓM 1: THÔNG TIN CƠ BẢN --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white"><strong>1. Thông tin cơ bản (Bắt buộc)</strong></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Tiêu đề tin <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $jobPost->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả công việc <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $jobPost->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Quốc gia đến <span class="text-danger">*</span></label>
                        <input type="text" name="destination_country" class="form-control @error('destination_country') is-invalid @enderror" value="{{ old('destination_country', $jobPost->destination_country) }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Số lượng tuyển <span class="text-danger">*</span></label>
                        <input type="number" name="headcount" class="form-control @error('headcount') is-invalid @enderror" min="1" value="{{ old('headcount', $jobPost->headcount) }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Loại công việc <span class="text-danger">*</span></label>
                        <select name="job_type" class="form-select" required>
                            <option value="full_time" {{ old('job_type', $jobPost->job_type) == 'full_time' ? 'selected' : '' }}>Full-time</option>
                            <option value="part_time" {{ old('job_type', $jobPost->job_type) == 'part_time' ? 'selected' : '' }}>Part-time</option>
                            <option value="contract" {{ old('job_type', $jobPost->job_type) == 'contract' ? 'selected' : '' }}>Hợp đồng</option>
                            <option value="internship" {{ old('job_type', $jobPost->job_type) == 'internship' ? 'selected' : '' }}>Thực tập</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Loại Visa <span class="text-danger">*</span></label>
                        <select name="visa_type" class="form-select" required>
                            <option value="tokutei" {{ old('visa_type', $jobPost->visa_type) == 'tokutei' ? 'selected' : '' }}>Tokutei</option>
                            <option value="ginou_jisshu" {{ old('visa_type', $jobPost->visa_type) == 'ginou_jisshu' ? 'selected' : '' }}>Ginou Jisshu</option>
                            <option value="other" {{ old('visa_type', $jobPost->visa_type) == 'other' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- NHÓM 2: MỨC LƯƠNG & ĐỊA ĐIỂM --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white"><strong>2. Mức lương & Địa điểm</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Nơi làm việc thực tế</label>
                        <input type="text" name="work_location" class="form-control" value="{{ old('work_location', $jobPost->work_location) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Lương tối thiểu</label>
                        <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min', $jobPost->salary_min) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Lương tối đa</label>
                        <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max', $jobPost->salary_max) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Đơn vị tiền tệ</label>
                        <select name="salary_currency" class="form-select">
                            <option value="">-- Chọn --</option>
                            <option value="JPY" {{ old('salary_currency', $jobPost->salary_currency) == 'JPY' ? 'selected' : '' }}>Yên Nhật (JPY)</option>
                            <option value="KRW" {{ old('salary_currency', $jobPost->salary_currency) == 'KRW' ? 'selected' : '' }}>Won (KRW)</option>
                            <option value="USD" {{ old('salary_currency', $jobPost->salary_currency) == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="VND" {{ old('salary_currency', $jobPost->salary_currency) == 'VND' ? 'selected' : '' }}>VNĐ</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Kỳ hạn trả lương</label>
                        <select name="salary_period" class="form-select">
                            <option value="">-- Chọn --</option>
                            <option value="monthly" {{ old('salary_period', $jobPost->salary_period) == 'monthly' ? 'selected' : '' }}>Hàng tháng</option>
                            <option value="hourly" {{ old('salary_period', $jobPost->salary_period) == 'hourly' ? 'selected' : '' }}>Theo giờ</option>
                            <option value="yearly" {{ old('salary_period', $jobPost->salary_period) == 'yearly' ? 'selected' : '' }}>Hàng năm</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- NHÓM 3: YÊU CẦU & PHÚC LỢI --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white"><strong>3. Yêu cầu ứng viên & Phúc lợi</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kinh nghiệm tối thiểu (Năm)</label>
                        <input type="number" name="experience_years_min" class="form-control" value="{{ old('experience_years_min', $jobPost->experience_years_min) }}" min="0">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Độ tuổi (Từ - Đến)</label>
                        <div class="input-group">
                            <input type="number" name="age_min" class="form-control" placeholder="Từ" value="{{ old('age_min', $jobPost->age_min) }}">
                            <span class="input-group-text">-</span>
                            <input type="number" name="age_max" class="form-control" placeholder="Đến" value="{{ old('age_max', $jobPost->age_max) }}">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Giới tính yêu cầu</label>
                        <select name="gender_preference" class="form-select">
                            <option value="">-- Bất kỳ --</option>
                            <option value="male" {{ old('gender_preference', $jobPost->gender_preference) == 'male' ? 'selected' : '' }}>Nam</option>
                            <option value="female" {{ old('gender_preference', $jobPost->gender_preference) == 'female' ? 'selected' : '' }}>Nữ</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Yêu cầu công việc</label>
                    <textarea name="requirements" class="form-control" rows="3">{{ old('requirements', $jobPost->requirements) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phúc lợi</label>
                    <textarea name="benefits" class="form-control" rows="3">{{ old('benefits', $jobPost->benefits) }}</textarea>
                </div>
            </div>
        </div>

        {{-- NHÓM 4: CÀI ĐẶT HIỂN THỊ --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white"><strong>4. Cài đặt hiển thị</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="draft" {{ old('status', $jobPost->status) == 'draft' ? 'selected' : '' }}>Lưu Nháp</option>
                            <option value="published" {{ old('status', $jobPost->status) == 'published' ? 'selected' : '' }}>Hiển thị</option>
                            <option value="closed" {{ old('status', $jobPost->status) == 'closed' ? 'selected' : '' }}>Đã đóng</option>
                            <option value="expired" {{ old('status', $jobPost->status) == 'expired' ? 'selected' : '' }}>Hết hạn</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ngày đăng</label>
                        <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', $jobPost->published_at ? date('Y-m-d\TH:i', strtotime($jobPost->published_at)) : '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ngày hết hạn</label>
                        <input type="datetime-local" name="expired_at" class="form-control" value="{{ old('expired_at', $jobPost->expired_at ? date('Y-m-d\TH:i', strtotime($jobPost->expired_at)) : '') }}">
                    </div>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $jobPost->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold text-danger" for="is_featured">
                        Đánh dấu đây là "Tin Tuyển Dụng Nổi Bật"
                    </label>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-warning btn-lg px-5">Cập nhật Tin Tuyển Dụng</button>
        </div>
    </form>
</div>
@endsection