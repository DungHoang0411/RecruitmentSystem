    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết Tin tuyển dụng</title>
    <style>
        body { font-family: sans-serif; padding: 20px; max-width: 600px; }
        .detail-box { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .detail-box p { font-size: 16px; line-height: 1.6; border-bottom: 1px dashed #ccc; padding-bottom: 10px; }
        .btn-back { background: #6c757d; text-decoration: none; padding: 10px 15px; color: white; display: inline-block; margin-top: 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Chi tiết Tin Tuyển Dụng</h1>

    <div class="detail-box">
        <p><strong>ID:</strong> {{ $jobPost->id }}</p>
        <p><strong>Tiêu đề:</strong> {{ $jobPost->title }}</p>
        <p><strong>Phòng ban:</strong> {{ $jobPost->department }}</p>
        <p><strong>Mức lương:</strong> {{ number_format($jobPost->salary_min) }} VNĐ - {{ number_format($jobPost->salary_max) }} VNĐ</p>
        <p><strong>Hạn nộp:</strong> {{ \Carbon\Carbon::parse($jobPost->deadline)->format('d/m/Y') }}</p>
        <p><strong>Trạng thái:</strong> {{ ucfirst($jobPost->status) }}</p>
        <p><strong>Ngày tạo:</strong> {{ $jobPost->created_at->format('d/m/Y H:i:s') }}</p>
    </div>

    <a href="{{ route('job-posts.index') }}" class="btn-back">Quay lại danh sách</a>
</body>
</html>