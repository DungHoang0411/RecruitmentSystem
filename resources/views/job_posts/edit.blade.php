<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Tin tuyển dụng</title>
    <style>
        body { font-family: sans-serif; padding: 20px; max-width: 600px; }
        .form-group { margin-bottom: 15px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .text-danger { color: red; font-size: 13px; margin-top: 5px; display: block; }
        .btn { padding: 10px 15px; background: #28a745; color: white; border: none; cursor: pointer; }
        .btn-back { background: #6c757d; text-decoration: none; padding: 9px 15px; color: white; display: inline-block; }
    </style>
</head>
<body>
    <h1>Sửa Tin Tuyển Dụng #{{ $jobPost->id }}</h1>

    <form action="{{ route('job-posts.update', $jobPost) }}" method="POST">
        @csrf
        <!-- BẮT BUỘC để báo cho Laravel biết đây là hành động Update -->
        @method('PUT')

        <div class="form-group">
            <label>Tiêu đề *:</label>
            <input type="text" name="title" value="{{ old('title', $jobPost->title) }}">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Phòng ban *:</label>
            <input type="text" name="department" value="{{ old('department', $jobPost->department) }}">
            @error('department') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Hạn nộp *:</label>
            <input type="date" name="deadline" value="{{ old('deadline', $jobPost->deadline) }}">
            @error('deadline') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Lương tối thiểu:</label>
            <input type="number" name="salary_min" value="{{ old('salary_min', $jobPost->salary_min) }}">
            @error('salary_min') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Lương tối đa (Phải >= Lương tối thiểu):</label>
            <input type="number" name="salary_max" value="{{ old('salary_max', $jobPost->salary_max) }}">
            @error('salary_max') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Trạng thái:</label>
            <select name="status">
                <option value="active" {{ old('status', $jobPost->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="closed" {{ old('status', $jobPost->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                <option value="draft" {{ old('status', $jobPost->status) == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>

        <button type="submit" class="btn">Cập nhật dữ liệu</button>
        <a href="{{ route('job-posts.index') }}" class="btn-back">Quay lại</a>
    </form>
</body>
</html>