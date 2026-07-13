@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Danh mục: <span class="text-success">{{ $category->name }}</span></h2>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Danh sách Tin tuyển dụng thuộc danh mục</h5>
            </div>
            <div class="card-body p-0">
                @if ($jobPosts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 50px;">STT</th>
                                    <th>Tiêu đề Tin tuyển dụng</th>
                                    <th>Công ty</th>
                                    <th>Địa điểm</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center" style="width: 100px;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobPosts as $key => $job)
                                    <tr>
                                        <td class="text-center align-middle">{{ $jobPosts->firstItem() + $key }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('job-posts.show', $job->slug) }}"
                                                class="text-decoration-none fw-bold text-dark">
                                                {{ $job->title }}
                                            </a>
                                            @if ($job->is_featured)
                                                <span class="badge bg-warning text-dark ms-1">Nổi bật</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-primary fw-medium">
                                            {{ $job->company->name ?? 'Chưa cập nhật' }}</td>
                                        <td class="align-middle">{{ $job->work_location ?? 'Không xác định' }}</td>
                                        <td class="align-middle">
                                            <span
                                                class="badge
                                                @if ($job->status == 'published') bg-success
                                                @elseif($job->status == 'draft') bg-secondary
                                                @elseif($job->status == 'closed') bg-dark
                                                @else bg-danger @endif">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('job-posts.show', $job->slug) }}"
                                                class="btn btn-sm btn-info text-white">Chi tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4 mb-3">
                        {{ $jobPosts->links() }}
                    </div>
                @else
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        <h5>Chưa có tin tuyển dụng nào</h5>
                        <p>Hiện tại danh mục này chưa được gán cho bất kỳ tin tuyển dụng nào trên hệ thống.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
