@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('css/company-index.css') }}">

    <div class="hero-banner text-center">
        <div class="container">
            <h1 class="fw-bold mb-3">Top Công Ty Hàng Đầu</h1>
            <p class="fs-5 opacity-75 mb-4">Khám phá cơ hội nghề nghiệp từ các đối tác uy tín</p>
            <ul class="nav nav-pills justify-content-center gap-2">
                <li class="nav-item"><a class="nav-link text-white border border-light px-4"
                        href="{{ route('job-posts.index') }}">Việc làm</a></li>
                <li class="nav-item"><a class="nav-link text-white border border-light px-4"
                        href="{{ route('categories.index') }}">Danh mục</a></li>
                <li class="nav-item"><a class="nav-link active bg-white text-success fw-bold px-4"
                        href="{{ route('companies.index') }}">Công ty</a></li>
            </ul>
        </div>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Danh sách công ty</h4>
            <a href="{{ route('companies.create') }}" class="btn btn-outline-success"><i class="bi bi-plus-lg me-1"></i>
                Thêm Công ty</a>
        </div>

        <div class="row g-4">
            @forelse($companies as $company)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="company-card h-100 d-flex flex-column">
                        <div class="company-card__header">
                            <div class="company-card__logo"><i class="bi bi-building"></i></div>
                            <div>
                                <a href="{{ route('companies.show', $company->slug ?? $company->id) }}"
                                    class="company-card__title stretched-link">
                                    {{ str_ireplace('company_', '', $company->name) }}
                                </a>
                                <span
                                    class="badge bg-light text-success border border-success border-opacity-25">{{ $company->job_posts_count ?? 0 }}
                                    việc làm</span>
                            </div>
                        </div>

                        <div class="company-card__desc mb-3">
                            {{ $company->description ?? 'Đang cập nhật thông tin giới thiệu về công ty này.' }}
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-auto">
                            <a href="{{ route('companies.edit', $company->slug ?? $company->id) }}"
                                class="btn btn-sm btn-outline-warning position-relative z-3">
                                <i class="bi bi-pencil"></i> Sửa
                            </a>
                            <form action="{{ route('companies.destroy', $company->slug ?? $company->id) }}" method="POST"
                                class="form-delete m-0 position-relative z-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">Chưa có dữ liệu công ty</h5>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $companies->links() }}
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
                        title: 'Xóa công ty này?',
                        text: "CẢNH BÁO: Toàn bộ tin tuyển dụng của công ty này cũng sẽ bị xóa vĩnh viễn!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Đồng ý, Xóa!',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    style: {
                        background: "#198754"
                    }
                }).showToast();
            });
        </script>
    @endif
@endsection
