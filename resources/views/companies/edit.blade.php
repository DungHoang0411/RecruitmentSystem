@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Chỉnh Sửa Công Ty</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tên công ty <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', str_ireplace('company_', '', $company->name)) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả công ty</label>
                <textarea name="description" class="form-control" rows="5">{{ old('description', $company->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
