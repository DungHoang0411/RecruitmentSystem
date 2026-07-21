@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <div class="hero-banner text-center" style="background-color: #00a651; color: white; padding: 50px 0;">
        <div class="container">
            <h1 class="fw-bold mb-3">Quản lý Thẻ (Tags)</h1>
            <p class="fs-5 opacity-75 mb-4">Phân loại và gắn thẻ cho các tin tuyển dụng</p>
            <ul class="nav nav-pills justify-content-center gap-2">
                <li class="nav-item"><a class="nav-link text-white border border-light px-4" href="{{ route('job-posts.index') }}">Việc làm</a></li>
                <li class="nav-item"><a class="nav-link text-white border border-light px-4" href="{{ route('categories.index') }}">Danh mục</a></li>
                <li class="nav-item"><a class="nav-link text-white border border-light px-4" href="{{ route('companies.index') }}">Công ty</a></li>
                <li class="nav-item"><a class="nav-link active bg-white text-success fw-bold px-4" href="{{ route('tags.index') }}">Thẻ (Tags)</a></li>
            </ul>
        </div>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Tất cả Thẻ (Tags)</h4>
            <a href="{{ route('tags.create') }}" class="btn btn-outline-success"><i class="bi bi-plus-lg me-1"></i> Thêm Thẻ</a>
        </div>

        <div class="row g-4">
            @forelse($tags as $tag)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card h-100 border rounded shadow-sm">
                        <div class="card-body text-center d-flex flex-column justify-content-center p-4">
                            <h5 class="fw-bold mb-4 text-dark text-truncate" title="{{ str_ireplace('tag_', '', $tag->name) }}">
                                <i class="bi bi-tag-fill text-success me-2"></i>
                                {{ str_ireplace('tag_', '', $tag->name) }}
                            </h5>

                            <div class="d-flex justify-content-center gap-2 mt-auto">
                                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-outline-warning w-50">
                                    <i class="bi bi-pencil me-1"></i> Sửa
                                </a>
                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="form-delete m-0 w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                        <i class="bi bi-trash me-1"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted"><i class="bi bi-tags fs-1 d-block mb-3"></i>Chưa có dữ liệu thẻ (Tags)</h5>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $tags->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Xóa thẻ này?',
                        text: "Thẻ này sẽ bị gỡ khỏi tất cả các tin tuyển dụng đang gắn nó!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Đồng ý, Xóa!',
                        cancelButtonText: 'Hủy'
                    }).then((result) => { if (result.isConfirmed) form.submit(); });
                });
            });
        });
    </script>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({ text: "{{ session('success') }}", duration: 3000, style: { background: "#198754" } }).showToast();
            });
        </script>
    @endif
@endsection
