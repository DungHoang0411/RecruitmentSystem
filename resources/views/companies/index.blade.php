@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-bold text-dark mb-1">Các Công Ty Hàng Đầu</h1>
                <p class="text-muted mb-0">Khám phá cơ hội nghề nghiệp từ các đối tác uy tín</p>
            </div>
            <a href="{{ route('companies.create') }}" class="btn btn-success">+ Thêm Công ty</a>
        </div>

        <div class="row g-4">
            @forelse($companies as $company)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 company-card position-relative">
                        <div class="position-absolute top-0 end-0 p-2 z-1">
                            <a href="{{ route('companies.edit', $company->slug ?? $company->id) }}" class="btn btn-sm btn-light text-warning shadow-sm me-1" title="Sửa"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('companies.destroy', $company->slug ?? $company->id) }}" method="POST" class="d-inline form-delete">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger shadow-sm" title="Xóa"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>

                        <a href="{{ route('companies.show', $company->slug ?? $company->id) }}" class="text-decoration-none text-dark d-block h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                        <i class="bi bi-building fs-2"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">{{ str_ireplace('company_', '', $company->name) }}</h5>
                                        <span class="badge bg-success">{{ $company->job_posts_count ?? 0 }} việc làm đang mở</span>
                                    </div>
                                </div>
                                <p class="text-muted small mb-0 line-clamp-3">
                                    {{ Str::limit($company->description ?? 'Đang cập nhật thông tin giới thiệu về công ty này.', 120) }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-building-slash fs-1 d-block mb-3"></i>
                        <h5>Chưa có dữ liệu công ty</h5>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $companies->links() }}
        </div>
    </div>

    <style>
        .company-card { transition: all 0.2s ease; border: 1px solid rgba(0,0,0,0.05) !important; }
        .company-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>

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
                        confirmButtonText: 'Đồng ý, Xóa tất cả!'
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
