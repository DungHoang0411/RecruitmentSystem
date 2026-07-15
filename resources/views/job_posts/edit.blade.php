@extends('layouts.app')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>

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

        <form action="{{ route('job-posts.update', $jobPost->id) }}" method="POST" id="jobPostForm">
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
                    <select name="status" class="form-select tom-select" required>
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('status', $jobPost->status) == $value ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="p-3 bg-light rounded border-start border-primary border-4 mb-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Công ty <span class="text-danger">*</span></label>
                        <select name="company_id" class="form-select @error('company_id') is-invalid @enderror" required>
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
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
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
                                <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    id="tag_{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tag_{{ $tag->id }}">
                                    {{ str_ireplace('tag_', '', $tag->name) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Quốc gia đến <span class="text-danger">*</span></label>
                    <select name="destination_country" class="form-select tom-select" required>
                        @foreach ($countries as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('destination_country', $jobPost->destination_country) == $value ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Hình thức công việc <span class="text-danger">*</span></label>
                    <select name="job_type" class="form-select tom-select" required>
                        @foreach ($job_types as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('job_type', $jobPost->job_type) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Loại Visa <span class="text-danger">*</span></label>
                    <select name="visa_type" class="form-select tom-select" required>
                        @foreach ($visa_types as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('visa_type', $jobPost->visa_type) == $value ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Số lượng tuyển <span class="text-danger">*</span></label>
                    <input type="number" name="headcount" class="form-control"
                        value="{{ old('headcount', $jobPost->headcount) }}" required min="1">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3"><label class="form-label">Lương tối thiểu</label><input type="number"
                        name="salary_min" class="form-control"
                        value="{{ old('salary_min', $jobPost->salary_min ? round($jobPost->salary_min) : '') }}"
                        min="0"></div>
                <div class="col-md-3 mb-3"><label class="form-label">Lương tối đa</label><input type="number"
                        name="salary_max" class="form-control"
                        value="{{ old('salary_max', $jobPost->salary_max ? round($jobPost->salary_max) : '') }}"
                        min="0"></div>
                <div class="col-md-3 mb-3"><label class="form-label">Tiền tệ</label><input type="text"
                        name="salary_currency" class="form-control"
                        value="{{ old('salary_currency', $jobPost->salary_currency) }}"></div>
                <div class="col-md-3 mb-3"><label class="form-label">Chu kỳ lương</label><input type="text"
                        name="salary_period" class="form-control"
                        value="{{ old('salary_period', $jobPost->salary_period) }}"></div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3"><label class="form-label">Kinh nghiệm tối thiểu (năm)</label><input
                        type="number" name="experience_years_min" class="form-control"
                        value="{{ old('experience_years_min', $jobPost->experience_years_min) }}" min="0">
                </div>
                <div class="col-md-3 mb-3"><label class="form-label">Tuổi tối thiểu</label><input type="number"
                        name="age_min" class="form-control" value="{{ old('age_min', $jobPost->age_min) }}"
                        min="18"></div>
                <div class="col-md-3 mb-3"><label class="form-label">Tuổi tối đa</label><input type="number"
                        name="age_max" class="form-control" value="{{ old('age_max', $jobPost->age_max) }}"></div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Yêu cầu giới tính</label>
                    <select name="gender_preference" class="form-select tom-select">
                        @foreach ($gender_preferences as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('gender_preference', $jobPost->gender_preference) == $value ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3"><label class="form-label">Địa điểm làm việc</label><input type="text"
                        name="work_location" class="form-control"
                        value="{{ old('work_location', $jobPost->work_location) }}"></div>
                <div class="col-md-4 mb-3"><label class="form-label">Ngày xuất bản</label><input type="text"
                        name="published_at" class="form-control datepicker"
                        value="{{ old('published_at', $jobPost->published_at ? $jobPost->published_at->format('Y-m-d') : '') }}"
                        placeholder="Chọn ngày"></div>
                <div class="col-md-4 mb-3"><label class="form-label">Ngày hết hạn</label><input type="text"
                        name="expired_at" class="form-control datepicker"
                        value="{{ old('expired_at', $jobPost->expired_at ? $jobPost->expired_at->format('Y-m-d') : '') }}"
                        placeholder="Chọn ngày"></div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" value="1"
                    {{ old('is_featured', $jobPost->is_featured) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">Tin nổi bật</label>
            </div>

            <div class="mb-3"><label class="form-label">Mô tả công việc <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control editor">{{ old('description', $jobPost->description) }}</textarea>
            </div>
            <div class="mb-3"><label class="form-label">Yêu cầu công việc</label>
                <textarea name="requirements" class="form-control editor">{{ old('requirements', $jobPost->requirements) }}</textarea>
            </div>
            <div class="mb-3"><label class="form-label">Quyền lợi</label>
                <textarea name="benefits" class="form-control editor">{{ old('benefits', $jobPost->benefits) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('job-posts.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.tom-select').forEach((el) => {
                new TomSelect(el, {
                    create: false,
                    controlInput: null
                });
            });
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                locale: "vn",
                allowInput: true
            });
            document.querySelectorAll('.editor').forEach((editorElement) => {
                ClassicEditor.create(editorElement).catch(error => {
                    console.error(error);
                });
            });
        });
    </script>
@endsection
