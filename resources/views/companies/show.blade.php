@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/job-index.css') }}">
    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ route('companies.index') }}" class="text-decoration-none text-muted"><i class="bi bi-arrow-left"></i> Quay lại</a>
        </div>

        <div class="card border-0 shadow-sm mb-5" style="border-radius: 12px;">
            <div class="card-body p-4 p-md-5 d-flex align-items-center gap-4">
                <div class="bg-light rounded p-4 text-center border" style="width: 120px; height: 120px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-building fs-1 text-secondary"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-2">{{ str_ireplace('company_', '', $company->name) }}</h2>
                    <p class="text-muted mb-0" style="white-space: pre-line">{{ $company->description ?? 'Chưa có thông tin giới thiệu.' }}</p>
                </div>
            </div>
        </div>

        <h4 class="fw-bold mb-4">Tin tuyển dụng từ công ty này</h4>
        <div class="row g-4">
            @forelse ($jobPosts as $item)
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="job-card">
                        <div class="job-card__header">
                            <div class="job-card__logo"><i class="bi bi-building fs-3 text-secondary"></i></div>
                            <div class="flex-grow-1">
                                <a href="{{ route('job-posts.show', $item->slug) }}" class="job-card__title">{{ $item->title }}</a>
                                <div class="job-card__salary"><i class="bi bi-currency-dollar"></i>
                                    @if ($item->salary_min || $item->salary_max) {{ $item->salary_min ? round($item->salary_min) : '0' }} - {{ $item->salary_max ? round($item->salary_max) : 'Max' }} {{ $item->salary_currency }} @else Thỏa thuận @endif
                                </div>
                            </div>
                        </div>
                        <div class="job-card__body">
                            <div class="text-muted mb-2 fw-medium"><i class="bi bi-folder2-open me-2"></i> {{ $item->category ? str_ireplace('category_', '', $item->category->name) : 'Chưa phân loại' }}</div>
                        </div>
                        <div class="job-card__footer">
                            <span class="badge @if ($item->status == 'published') bg-success @elseif($item->status == 'draft') bg-secondary @elseif($item->status == 'closed') bg-dark @else bg-danger @endif">{{ ucfirst($item->status) }}</span>
                            <a href="{{ route('job-posts.show', $item->slug) }}" class="btn btn-sm btn-brand px-3">Chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5"><h5 class="text-muted">Công ty hiện chưa có tin tuyển dụng nào</h5></div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-5">{{ $jobPosts->links() }}</div>
    </div>
@endsection
