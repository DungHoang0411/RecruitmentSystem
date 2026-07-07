@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Quản lý Tin Tuyển Dụng</h2>
            <a href="{{ route('job-posts.create') }}" class="btn btn-success">+ Thêm tin mới</a>
        </div>

        <form action="{{ route('job-posts.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tiêu đề..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select tom-select-filter">
                    <option value="">-- Trạng thái --</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="destination_country" class="form-select tom-select-filter">
                    <option value="">-- Quốc gia đến --</option>
                    @foreach ($countries as $value => $label)
                        <option value="{{ $value }}"
                            {{ request('destination_country') == $value ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="visa_type" class="form-select tom-select-filter">
                    <option value="">-- Loại Visa --</option>
                    @foreach ($visa_types as $value => $label)
                        <option value="{{ $value }}" {{ request('visa_type') == $value ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="job_type" class="form-select tom-select-filter">
                    <option value="">-- Hình thức --</option>
                    @foreach ($job_types as $value => $label)
                        <option value="{{ $value }}" {{ request('job_type') == $value ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Quốc gia</th>
                    <th>Visa</th>
                    <th>Hình thức</th>
                    <th>Số lượng</th>
                    <th>Lượt xem</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobPosts as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            {{ $item->title }}
                            @if ($item->is_featured)
                                <span class="badge bg-warning text-dark">Nổi bật</span>
                            @endif
                        </td>
                        <td>{{ $countries[$item->destination_country] ?? $item->destination_country }}</td>
                        <td>{{ $visa_types[$item->visa_type] ?? ucfirst($item->visa_type) }}</td>
                        <td>{{ $job_types[$item->job_type] ?? ucfirst($item->job_type) }}</td>
                        <td>{{ $item->headcount }}</td>
                        <td>{{ $item->view_count }}</td>
                        <td>
                            <span
                                class="badge
                                @if ($item->status == 'published') bg-success
                                @elseif($item->status == 'draft') bg-secondary
                                @elseif($item->status == 'closed') bg-dark
                                @else bg-danger @endif">
                                {{ $statuses[$item->status] ?? ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('job-posts.show', $item->slug) }}"
                                class="btn btn-sm btn-info text-white">Xem</a>
                            <a href="{{ route('job-posts.edit', $item->slug) }}" class="btn btn-sm btn-warning">Sửa</a>

                            <form action="{{ route('job-posts.destroy', $item->slug) }}" method="POST"
                                class="d-inline form-delete-post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
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
                        text: "Hệ thống sẽ chuyển tin tuyển dụng này vào danh sách lưu trữ xóa mềm!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Đồng ý, xóa ngay!',
                        cancelButtonText: 'Hủy bỏ'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
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
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "#198754"
                    }
                }).showToast();
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "{{ session('error') }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "#dc3545"
                    }
                }).showToast();
            });
        </script>
    @endif
    </script>
@endsection
