@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/job-index.css') }}">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-header bg-white border-bottom p-4">
                        <h4 class="mb-0 fw-bold">Chỉnh sửa Công Ty</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('companies.update', $company->slug ?? $company->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-4">
                                <label class="form-label fw-bold">Tên Công Ty <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name', str_ireplace('company_', '', $company->name)) }}" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Giới thiệu về công ty</label>
                                <textarea name="description" rows="5" class="form-control">{{ old('description', $company->description) }}</textarea>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('companies.index') }}" class="btn btn-light px-4">Hủy</a>
                                <button type="submit" class="btn btn-brand px-4">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
