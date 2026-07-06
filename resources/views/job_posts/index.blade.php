@extends('layouts.app')

@section('content')
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
                <select name="status" class="form-select">
                    <option value="">-- Trạng thái --</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" name="destination_country" class="form-control" placeholder="Quốc gia (JP, KR...)"
                    value="{{ request('destination_country') }}">
            </div>
            <div class="col-md-2">
                <select name="visa_type" class="form-select">
                    <option value="">-- Loại Visa --</option>
                    <option value="tokutei" {{ request('visa_type') == 'tokutei' ? 'selected' : '' }}>Tokutei</option>
                    <option value="ginou_jisshu" {{ request('visa_type') == 'ginou_jisshu' ? 'selected' : '' }}>Ginou Jisshu
                    </option>
                    <option value="other" {{ request('visa_type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="job_type" class="form-select">
                    <option value="">-- Hình thức --</option>
                    <option value="full_time" {{ request('job_type') == 'full_time' ? 'selected' : '' }}>Full time</option>
                    <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part time</option>
                    <option value="contract" {{ request('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>Internship
                    </option>
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
                        <td>{{ $item->destination_country }}</td>
                        <td>{{ $item->visa_type }}</td>
                        <td>{{ $item->job_type }}</td>
                        <td>{{ $item->headcount }}</td>
                        <td>{{ $item->view_count }}</td>
                        <td>
                            <span
                                class="badge
                        @if ($item->status == 'published') bg-success
                        @elseif($item->status == 'draft') bg-secondary
                        @elseif($item->status == 'closed') bg-dark
                        @else bg-danger @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('job-posts.show', $item->slug) }}"
                                class="btn btn-sm btn-info text-white">Xem</a>
                            <a href="{{ route('job-posts.edit', $item->slug) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('job-posts.destroy', $item->slug) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Bạn có chắc muốn xóa?');">
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
@endsection
