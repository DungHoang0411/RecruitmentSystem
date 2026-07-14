@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Chỉnh Sửa Tin Tuyển Dụng</h2>
            <a href="{{ route('job-posts.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>

        <form action="{{ route('job-posts.update', $jobPost->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">

                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $jobPost->title) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="draft" {{ old('status', $jobPost->status) == 'draft' ? 'selected' : '' }}>
                                    Draft</option>
                                <option value="published"
                                    {{ old('status', $jobPost->status) == 'published' ? 'selected' : '' }}>Published
                                </option>
                                <option value="closed" {{ old('status', $jobPost->status) == 'closed' ? 'selected' : '' }}>
                                    Closed</option>
                                <option value="expired"
                                    {{ old('status', $jobPost->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded border-start border-primary border-4 mb-4">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Công ty <span class="text-danger">*</span></label>
                                <select name="company_id" class="form-select @error('company_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Chọn công ty --</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            {{ old('company_id', $jobPost->company_id) == $company->id ? 'selected' : '' }}>
                                            {{ str_ireplace('company_', '', $company->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Danh mục <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $jobPost->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ str_ireplace('category_', '', $category->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="form-label fw-bold">Tags (Thẻ phân loại)</label>
                            <div class="d-flex flex-wrap gap-3">
                                @php
                                    $selectedTags = old('tags', $jobPost->tags->pluck('id')->toArray());
                                @endphp
                                @foreach ($tags as $tag)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tags[]"
                                            value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                                            {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tag_{{ $tag->id }}">
                                            {{ str_ireplace('tag_', '', $tag->name) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Quốc gia đến <span class="text-danger">*</span></label>
                            <input type="text" name="destination_country" class="form-control"
                                value="{{ old('destination_country', $jobPost->destination_country) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Hình thức công việc <span class="text-danger">*</span></label>
                            <input type="text" name="job_type" class="form-control"
                                value="{{ old('job_type', $jobPost->job_type) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Loại Visa <span class="text-danger">*</span></label>
                            <input type="text" name="visa_type" class="form-control"
                                value="{{ old('visa_type', $jobPost->visa_type) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Số lượng tuyển <span class="text-danger">*</span></label>
                            <input type="number" name="headcount" class="form-control"
                                value="{{ old('headcount', $jobPost->headcount) }}" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Lương tối thiểu</label>
                            <input type="number" name="salary_min" class="form-control"
                                value="{{ old('salary_min', $jobPost->salary_min) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Lương tối đa</label>
                            <input type="number" name="salary_max" class="form-control"
                                value="{{ old('salary_max', $jobPost->salary_max) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Tiền tệ</label>
                            <input type="text" name="salary_currency" class="form-control"
                                value="{{ old('salary_currency', $jobPost->salary_currency) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Chu kỳ lương</label>
                            <input type="text" name="salary_period" class="form-control"
                                value="{{ old('salary_period', $jobPost->salary_period) }}">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Kinh nghiệm tối thiểu (năm)</label>
                            <input type="number" name="experience_years" class="form-control"
                                value="{{ old('experience_years', $jobPost->experience_years) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Tuổi tối thiểu</label>
                            <input type="number" name="age_min" class="form-control"
                                value="{{ old('age_min', $jobPost->age_min) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Tuổi tối đa</label>
                            <input type="number" name="age_max" class="form-control"
                                value="{{ old('age_max', $jobPost->age_max) }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Yêu cầu giới tính</label>
                            <select name="gender_preference" class="form-select">
                                <option value="Bất kỳ"
                                    {{ old('gender_preference', $jobPost->gender_preference) == 'Bất kỳ' ? 'selected' : '' }}>
                                    Bất kỳ</option>
                                <option value="Nam"
                                    {{ old('gender_preference', $jobPost->gender_preference) == 'Nam' ? 'selected' : '' }}>
                                    Nam</option>
                                <option value="Nữ"
                                    {{ old('gender_preference', $jobPost->gender_preference) == 'Nữ' ? 'selected' : '' }}>
                                    Nữ</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Địa điểm làm việc</label>
                            <input type="text" name="work_location" class="form-control"
                                value="{{ old('work_location', $jobPost->work_location) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Ngày xuất bản</label>
                            <input type="date" name="published_at" class="form-control"
                                value="{{ old('published_at', $jobPost->published_at ? \Carbon\Carbon::parse($jobPost->published_at)->format('Y-m-d') : '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Ngày hết hạn</label>
                            <input type="date" name="expired_at" class="form-control"
                                value="{{ old('expired_at', $jobPost->expired_at ? \Carbon\Carbon::parse($jobPost->expired_at)->format('Y-m-d') : '') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Mô tả công việc</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $jobPost->description) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Yêu cầu công việc</label>
                        <textarea name="requirements" class="form-control" rows="4">{{ old('requirements', $jobPost->requirements) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Quyền lợi</label>
                        <textarea name="benefits" class="form-control" rows="4">{{ old('benefits', $jobPost->benefits) }}</textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5 fw-bold">Cập Nhật Tin Tuyển Dụng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
