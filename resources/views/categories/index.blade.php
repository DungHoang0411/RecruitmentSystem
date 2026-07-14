@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <div class="hero-banner text-center" style="background-color: #00a651; color: white; padding: 50px 0;">
        <div class="container">
            <h1 class="fw-bold mb-3">Khám phá theo lĩnh vực</h1>
            <p class="fs-5 opacity-75 mb-4">Lựa chọn ngành nghề phù hợp với định hướng của bạn</p>
            <ul class="nav nav-pills justify-content-center gap-2">
                <li class="nav-item"><a class="nav-link text-white border border-light px-4" href="{{ route('job-posts.index') }}">Việc làm</a></li>
                <li class="nav-item"><a class="nav-link active bg-white text-success fw-bold px-4" href="{{ route('categories.index') }}">Danh mục</a></li>
                <li class="nav-item"><a class="nav-link text-white border border-light px-4" href="{{ route('companies.index') }}">Công ty</a></li>
            </ul>
        </div>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Tất cả danh mục</h4>
            <a href="{{ route('categories.create') }}" class="btn btn-outline-success"><i class="bi bi-plus-lg me-1"></i> Thêm Danh Mục</a>
        </div>

        <div class="row g-4">
            @forelse($categories as $category)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card h-100 d-flex flex-column border rounded shadow-sm">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="fw-bold mb-3 mt-2">
                                <a href="{{ route('categories.show', $category->slug ?? $category->id) }}" class="text-decoration-none text-dark stretched-link">
                                    {{ str_ireplace('category_', '', $category->name) }}
                                </a>
                            </h5>
                            <span class="badge bg-light text-success border border-success border-opacity-25 mb-4 mx-auto">{{ $category->job_posts_count ?? 0 }} việc làm</span>

                            <div class="d-flex justify-content-center gap-2 border-top pt-3 mt-auto position-relative z-3">
                                <a href="{{ route('categories.edit', $category->slug ?? $category->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i> Sửa
                                </a>
                                <form action="{{ route('categories.destroy', $category->slug ?? $category->id) }}" method="POST" class="form-delete m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">Chưa có dữ liệu danh mục</h5>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $categories->links() }}
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
                        title: 'Xóa danh mục này?',
                        text: "CẢNH BÁO: Toàn bộ tin tuyển dụng thuộc danh mục này cũng sẽ bị xóa vĩnh viễn!",
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
