@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom pb-0 pt-4">
                    <h4 class="fw-bold text-success"><i class="bi bi-tags me-2"></i>Thêm Thẻ (Tag) Mới</h4>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold">Tên thẻ (Tag) <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="VD: PHP, Laravel, ReactJS..." value="{{ old('name') }}" required>
                            <small class="text-muted mt-1 d-block">Tên thẻ nên ngắn gọn và mang tính phân loại.</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('tags.index') }}" class="btn btn-light border">Hủy</a>
                            <button type="submit" class="btn btn-success px-4">Lưu thẻ mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
