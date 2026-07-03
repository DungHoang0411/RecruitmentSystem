@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách Tin Tuyển Dụng</h2>
        <a href="{{ route('job-posts.create') }}" class="btn btn-primary">Thêm tin mới</a>
    </div>

    <form action="{{ route('job-posts.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- Trạng thái --</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Nháp</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Đang hiển thị</option>
                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Đã đóng</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Lọc</button>
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Tiêu đề</th>
                <th>Quốc gia</th>
                <th>Loại hình</th>
                <th>Visa</th>
                <th>Trạng thái</th>
                <th width="200">Thao tác</th>
            </tr>
        </thead>
       <tbody>
    @forelse($jobPosts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->destination_country }}</td>
            <td>{{ $post->job_type }}</td>
            <td>{{ $post->visa_type }}</td>
            <td>{{ $post->status }}</td>
            <td>
                </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">Chưa có tin tuyển dụng nào trong hệ thống.</td>
        </tr>
    @endforelse
</tbody>
    </table>

    {{ $jobPosts->links() }}
</div>
@endsection