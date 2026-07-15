@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom pb-0 pt-4">
                    <h4 class="fw-bold text-warning"><i class="bi bi-pencil-square me-2"></i>Sửa Thẻ</h4>
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

                    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-bold">Tên thẻ (Tag) <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', str_ireplace('tag_', '', $tag->name)) }}" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('tags.index') }}" class="btn btn-light border">Hủy</a>
                            <button type="submit" class="btn btn-warning px-4 text-dark fw-bold">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
