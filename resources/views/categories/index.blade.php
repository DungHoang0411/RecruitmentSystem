@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('css/job-index.css') }}">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Quản lý Danh Mục</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-brand px-4">+ Thêm Danh Mục</a>
        </div>

        <div class="row g-3">
            @forelse($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 8px;">
                        <div class="card-body p-4 text-center position-relative">
                            <div class="dropdown position-absolute top-0 end-0 mt-2 me-2">
                                <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                    <li><a class="dropdown-item" href="{{ route('categories.edit', $category->slug ?? $category->id) }}">Sửa</a></li>
                                    <li>
                                        <form action="{{ route('categories.destroy', $category->slug ?? $category->id) }}" method="POST" class="form-delete d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Xóa</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <i class="bi bi-folder2-open fs-1 brand-text mb-2 d-block"></i>
                            <a href="{{ route('categories.show', $category->slug ?? $category->id) }}" class="text-decoration-none text-dark fw-bold fs-5 stretched-link">
                                {{ str_ireplace('category_', '', $category->name) }}
                            </a>
                            <div class="text-muted small mt-2">{{ $category->job_posts_count ?? 0 }} việc làm</div>
                        </div>
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
