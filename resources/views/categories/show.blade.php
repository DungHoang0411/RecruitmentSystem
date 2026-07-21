@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/job-index.css') }}">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('categories.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block"><i class="bi bi-arrow-left"></i> Quay lại</a>
                <h3 class="fw-bold text-dark mb-0">Việc làm ngành: <span class="brand-text">{{ str_ireplace('category_', '', $category->name) }}</span></h3>
            </div>
        </div>
        <div class="row g-4 mt-2">
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
                            <div class="text-muted mb-2 fw-medium"><i class="bi bi-buildings me-2"></i> {{ $item->company ? str_ireplace('company_', '', $item->company->name) : 'Bảo mật' }}</div>
                        </div>
                        <div class="job-card__footer">
                            <span class="badge @if ($item->status == 'published') bg-success @elseif($item->status == 'draft') bg-secondary @elseif($item->status == 'closed') bg-dark @else bg-danger @endif">{{ ucfirst($item->status) }}</span>
                            <a href="{{ route('job-posts.show', $item->slug) }}" class="btn btn-sm btn-brand px-3">Chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5"><h5 class="text-muted">Chưa có tin tuyển dụng nào</h5></div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-5">{{ $jobPosts->links() }}</div>
    </div>
@endsection
