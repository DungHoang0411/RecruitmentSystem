@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-dark">Danh Mục Tuyển Dụng</h1>
            <p class="text-muted fs-5">Khám phá hàng ngàn cơ hội việc làm hấp dẫn theo từng nhóm ngành nghề</p>
        </div>

        <div class="row g-4">
            @forelse($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('categories.show', $category->slug ?? $category->id) }}" class="text-decoration-none">
                        <div class="card h-100 shadow-sm border-0 category-card">
                            <div class="card-body text-center py-4">
                                <div class="mb-3">
                                    <i class="bi bi-briefcase text-success" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-3">{{ $category->name }}</h5>
                                <span class="badge bg-light text-success border border-success rounded-pill px-3 py-2">
                                    {{ $category->job_posts_count ?? 0 }} việc làm
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-folder-x fs-1 d-block mb-3"></i>
                        <h5>Hệ thống đang cập nhật danh mục</h5>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $categories->links() }}
        </div>
    </div>

    <style>
        .category-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            cursor: pointer;
        }
        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important;
        }
        .category-card:hover .bi-briefcase {
            color: #146c43 !important; /* Đổi màu icon khi hover */
        }
    </style>
@endsection
