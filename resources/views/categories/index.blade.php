@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <link rel="stylesheet" href="{{ asset('css/category-index.css') }}">

    <div class="hero-banner text-center">
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
                    <div class="category-card">
                        <div class="dropdown category-card__dropdown">
                            <button class="btn btn-sm btn-light border-0 bg-transparent text-muted" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="{{ route('categories.edit', $category->slug ?? $category->id) }}"><i class="bi bi-pencil text-warning me-2"></i>Sửa</a></li>
                                <li>
                                    <form action="{{ route('categories.destroy', $category->slug ?? $category->id) }}" method="POST" class="form-delete d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Xóa</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <div class="category-card__icon"><i class="bi bi-folder2-open"></i></div>
                        <a href="{{ route('categories.show', $category->slug ?? $category->id) }}" class="category-card__title stretched-link">
                            {{ str_ireplace('category_', '', $category->name) }}
                        </a>
                        <div class="category-card__count">{{ $category->job_posts_count ?? 0 }} việc làm</div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">Chưa có danh mục nào</h5>
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
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Đồng ý'
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
