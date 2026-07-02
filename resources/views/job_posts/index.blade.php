<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Tin tuyển dụng</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 8px 12px; text-decoration: none; border: 1px solid #ccc; background: #eee; color: #000; border-radius: 4px; cursor: pointer; }
        .btn-primary { background: #007bff; color: white; border: none; }
        .btn-danger { background: #dc3545; color: white; border: none; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .text-danger { color: red; font-weight: bold; font-size: 14px; }
    </style>
</head>
<body>
    <h1>Danh sách Tin tuyển dụng</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('job-posts.create') }}" class="btn btn-primary">+ Thêm tin mới</a>

    <!-- Form Lọc Dữ Liệu -->
    <form action="{{ route('job-posts.index') }}" method="GET" style="margin-top: 20px; background: #f9f9f9; padding: 15px; border-radius: 5px;">
        <label>Trạng thái:</label>
        <select name="status">
            <option value="">-- Tất cả --</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>

        <label style="margin-left: 15px;">Phòng ban:</label>
        <input type="text" name="department" value="{{ request('department') }}" placeholder="Nhập phòng ban...">
        
        <button type="submit" class="btn">Lọc</button>
        <a href="{{ route('job-posts.index') }}" class="btn">Xóa lọc</a>
    </form>

    <!-- Bảng Dữ Liệu -->
    <table>
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Phòng ban</th>
                <th>Mức lương</th>
                <th>Hạn nộp</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobPosts as $post)
            <tr>
                <td><strong>{{ $post->title }}</strong></td>
                <td>{{ $post->department }}</td>
                <td>
                    {{ number_format($post->salary_min) }} - {{ number_format($post->salary_max) }}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($post->deadline)->format('d/m/Y') }}
                    <!-- Logic hiển thị chữ Hết hạn -->
                    @if(\Carbon\Carbon::parse($post->deadline)->endOfDay()->isPast())
                        <br><span class="text-danger">(Hết hạn)</span>
                    @endif
                </td>
                <td>{{ ucfirst($post->status) }}</td>
                <td>
                    <a href="{{ route('job-posts.show', $post) }}" class="btn">Xem</a>
                    <a href="{{ route('job-posts.edit', $post) }}" class="btn">Sửa</a>
                    <!-- Form Xóa cần phải dùng method DELETE bảo mật qua @csrf -->
                    <form action="{{ route('job-posts.destroy', $post) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tin này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div style="margin-top: 20px;">
        {{ $jobPosts->withQueryString()->links() }}
    </div>
</body>
</html>