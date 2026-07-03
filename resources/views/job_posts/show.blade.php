@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Chi tiết Tuyển dụng</h4>
            <a href="{{ route('job-posts.index') }}" class="btn btn-sm btn-light">Quay lại</a>
        </div>
        
        <div class="card-body">
            <h2 class="text-primary">{{ $jobPost->title }}</h2>
            <hr>
            
            <div class="row mb-3">
                <div class="col-md-3"><strong>Quốc gia đến:</strong></div>
                <div class="col-md-9">{{ $jobPost->destination_country }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Số lượng tuyển:</strong></div>
                <div class="col-md-9">{{ $jobPost->headcount }} người</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Loại công việc:</strong></div>
                <div class="col-md-9">{{ $jobPost->job_type }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Loại Visa:</strong></div>
                <div class="col-md-9">{{ $jobPost->visa_type }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Trạng thái:</strong></div>
                <div class="col-md-9">
                    <span class="badge bg-secondary">{{ $jobPost->status }}</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3"><strong>Mô tả công việc:</strong></div>
                <div class="col-md-9">
                    {!! nl2br(e($jobPost->description)) !!}
                </div>
            </div>
        </div>
        
        <div class="card-footer text-end">
            <a href="{{ route('job-posts.edit', $jobPost->id) }}" class="btn btn-warning">Sửa tin này</a>
        </div>
    </div>
</div>
@endsection