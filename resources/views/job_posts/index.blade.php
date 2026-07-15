@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <link rel="stylesheet" href="{{ asset('css/job-index.css') }}">

    <div class="hero-banner text-center">
        <div class="container">
            <h1 class="fw-bold mb-3">Khám phá cơ hội nghề nghiệp</h1>
            <p class="fs-5 opacity-75 mb-4">Hàng ngàn việc làm chất lượng đang chờ đón bạn</p>

            <ul class="nav nav-pills justify-content-center gap-2">
                <li class="nav-item"><a class="nav-link active bg-white text-success fw-bold px-4"
                        href="{{ route('job-posts.index') }}">Việc làm</a></li>
                <li class="nav-item"><a class="nav-link text-white border border-light px-4"
                        href="{{ route('categories.index') }}">Danh mục</a></li>
                <li class="nav-item"><a class="nav-link text-white border border-light px-4"
                        href="{{ route('companies.index') }}">Công ty</a></li>
            </ul>
        </div>
    </div>

    <div class="container mb-5">
        <div class="container mb-5">
            <div class="filter-bar">
                <form action="{{ route('job-posts.index') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <!-- Ô tìm kiếm & Nút Đặt lại -->
                        <div class="col-lg-12 mb-2">
                            <div class="input-group input-group-lg border rounded">
                                <span class="input-group-text bg-white border-0 text-muted"><i
                                        class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control border-0 shadow-none ps-0"
                                    placeholder="Nhập tên vị trí, kỹ năng hoặc công ty..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-brand px-4">Tìm kiếm</button>
                                <a href="{{ route('job-posts.index') }}" class="btn btn-light px-4 border-start text-muted"
                                    title="Xóa tất cả bộ lọc">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Đặt lại
                                </a>
                            </div>
                        </div>

                        <!-- Các bộ lọc ngang -->
                        <div class="col-md-3">
                            <div class="filter-bar__label">Quốc gia</div>
                            <select name="destination_country" class="form-select tom-select-filter"
                                onchange="this.form.submit()">
                                <option value="" {{ empty(request('destination_country')) ? 'selected' : '' }}>Tất cả
                                </option>
                                @foreach ($countries as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ request('destination_country') == $value ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <div class="filter-bar__label">Loại Visa</div>
                            <select name="visa_type" class="form-select tom-select-filter" onchange="this.form.submit()">
                                <option value="" {{ empty(request('visa_type')) ? 'selected' : '' }}>Tất cả</option>
                                @foreach ($visa_types as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ request('visa_type') == $value ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <div class="filter-bar__label">Hình thức</div>
                            <select name="job_type" class="form-select tom-select-filter" onchange="this.form.submit()">
                                <option value="" {{ empty(request('job_type')) ? 'selected' : '' }}>Tất cả</option>
                                @foreach ($job_types as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ request('job_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <div class="filter-bar__label">Trạng thái (Admin)</div>
                            <select name="status" class="form-select tom-select-filter" onchange="this.form.submit()">
                                <option value="" {{ empty(request('status')) ? 'selected' : '' }}>Tất cả</option>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ request('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Hiển thị {{ $jobPosts->total() }} kết quả phù hợp</h4>
            <a href="{{ route('job-posts.create') }}" class="btn btn-outline-success"><i class="bi bi-plus-lg me-1"></i>
                Tạo tin mới</a>
        </div>

        <div class="row g-4">
            @forelse ($jobPosts as $item)
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="job-card">
                        <div class="job-card__header">
                            <div class="job-card__logo">
                                <i class="bi bi-building fs-3 text-secondary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <a href="{{ route('job-posts.show', $item->id) }}" class="job-card__title">
                                    {{ $item->title }}
                                </a>
                                <div class="job-card__salary">
                                    <i class="bi bi-currency-dollar"></i>
                                    @if ($item->salary_min || $item->salary_max)
                                        {{ $item->salary_min ? round($item->salary_min) : '0' }} -
                                        {{ $item->salary_max ? round($item->salary_max) : 'Max' }}
                                        {{ $item->salary_currency }}
                                    @else
                                        Thỏa thuận
                                    @endif
                                    @if ($item->is_featured)
                                        <span class="badge-hot ms-2"><i class="bi bi-fire"></i> Mới</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="job-card__body">
                            <div class="text-muted mb-2 fw-medium">
                                <i class="bi bi-buildings me-2"></i>
                                {{ $item->company ? str_ireplace('company_', '', $item->company->name) : 'Công ty đối tác bảo mật' }}
                            </div>
                            <div class="job-card__tags">
                                <span class="job-card__tag-item"><i class="bi bi-geo-alt me-1"></i>
                                    {{ $countries[$item->destination_country] ?? $item->destination_country }}</span>
                                <span class="job-card__tag-item"><i class="bi bi-passport me-1"></i>
                                    {{ $visa_types[$item->visa_type] ?? ucfirst($item->visa_type) }}</span>
                                <span class="job-card__tag-item"><i class="bi bi-briefcase me-1"></i>
                                    {{ $job_types[$item->job_type] ?? ucfirst($item->job_type) }}</span>
                            </div>
                        </div>

                        <div class="job-card__footer">
                            <div>
                                <span
                                    class="badge @if ($item->status == 'published') bg-success @elseif($item->status == 'draft') bg-secondary @elseif($item->status == 'closed') bg-dark @else bg-danger @endif">
                                    {{ $statuses[$item->status] ?? ucfirst($item->status) }}
                                </span>
                                <small class="text-muted ms-2"><i class="bi bi-eye"></i> {{ $item->view_count }} lượt
                                    xem</small>
                            </div>

                            <div class="btn-group">
                                <a href="{{ route('job-posts.show', ['job_post' => $item->id]) }}"
                                    class="btn btn-sm btn-brand px-3">Chi tiết</a>

                                <button type="button" class="btn btn-sm btn-brand dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('job-posts.edit', ['job_post' => $item->id]) }}">
                                            <i class="bi bi-pencil text-warning me-2"></i>Sửa
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('job-posts.destroy', ['job_post' => $item->id]) }}"
                                            method="POST" class="form-delete-post d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash me-2"></i>Xóa
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <img src="https://www.topcv.vn/v4/image/empty.svg" alt="Empty"
                                    style="width: 150px; opacity: 0.5;" class="mb-3">
                                <h5 class="text-muted">Không tìm thấy công việc phù hợp</h5>
                                <p class="text-muted small">Vui lòng thay đổi tiêu chí tìm kiếm hoặc xóa bộ lọc.</p>
                                <a href="{{ route('job-posts.index') }}" class="btn btn-brand mt-2">Xóa bộ lọc</a>
                            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $jobPosts->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.tom-select-filter').forEach((el) => {
                new TomSelect(el, {
                    create: false,
                    controlInput: null,
                    plugins: ['dropdown_input']
                });
            });

            document.querySelectorAll('.form-delete-post').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Xác nhận xóa?',
                        text: "Hệ thống sẽ chuyển tin tuyển dụng này vào danh sách lưu trữ!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Đồng ý, xóa!'
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
