@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Lịch sử xuất dữ liệu</h4>
        <a href="{{ route('job-posts.index') }}" class="btn btn-outline-secondary">Quay lại danh sách</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Thời gian yêu cầu</th>
                        <th>Trạng thái</th>
                        <th>Tên File</th>
                        <th class="text-end pe-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr id="log-row-{{ $log->id }}" data-status="{{ $log->status }}">
                            <td class="ps-4">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="status-col">
                                @if ($log->status == 'pending')
                                    <span class="badge bg-secondary">Đang chờ...</span>
                                @elseif ($log->status == 'processing')
                                    <span class="badge bg-warning text-dark">Đang xử lý</span>
                                @elseif ($log->status == 'completed')
                                    <span class="badge bg-success">Hoàn thành</span>
                                @else
                                    <span class="badge bg-danger">Thất bại</span>
                                @endif
                            </td>
                            <td>{{ $log->file_name ?? '---' }}</td>
                            <td class="text-end pe-4 action-col">
                                @if ($log->status == 'completed')
                                    <a href="{{ route('exports.download', $log->id) }}" class="btn btn-sm btn-success btn-download">
                                        <i class="bi bi-download me-1"></i> Tải xuống
                                    </a>
                                @elseif ($log->status == 'failed')
                                    <button class="btn btn-sm btn-danger btn-show-error" data-error="{{ $log->error_message }}">
                                        <i class="bi bi-exclamation-triangle me-1"></i> Xem lỗi
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-light disabled">
                                        <span class="spinner-border spinner-border-sm text-secondary me-1" role="status" aria-hidden="true"></span>
                                        Đang tạo...
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Bạn chưa có lịch sử xuất file nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if (session('success'))
            Toastify({ text: "{{ session('success') }}", duration: 4000, style: { background: "#198754" } }).showToast();
        @endif

        @if (session('error'))
            Toastify({ text: "{{ session('error') }}", duration: 4000, style: { background: "#dc3545" } }).showToast();
        @endif

        document.body.addEventListener('click', function(e) {
            let downloadBtn = e.target.closest('.btn-download');
            if (downloadBtn) {
                Toastify({ text: "Đang tải file xuống...", duration: 3000, style: { background: "#0d6efd" } }).showToast();
            }

            let errorBtn = e.target.closest('.btn-show-error');
            if (errorBtn) {
                Swal.fire({
                    title: 'Lỗi xuất file!',
                    text: errorBtn.getAttribute('data-error'),
                    icon: 'error',
                    confirmButtonText: 'Đã hiểu'
                });
            }
        });

        function pollExportStatus() {
            fetch('{{ route('exports.check-status') }}')
                .then(response => response.json())
                .then(logs => {
                    logs.forEach(log => {
                        let row = document.getElementById('log-row-' + log.id);
                        if (row) {
                            let currentStatus = row.getAttribute('data-status');

                            if (currentStatus !== log.status) {
                                row.setAttribute('data-status', log.status);
                                let statusCol = row.querySelector('.status-col');
                                let actionCol = row.querySelector('.action-col');

                                if (log.status === 'completed') {
                                    statusCol.innerHTML = '<span class="badge bg-success">Hoàn thành</span>';
                                    let downloadUrl = '{{ url("/export/download") }}/' + log.id;
                                    actionCol.innerHTML = `<a href="${downloadUrl}" class="btn btn-sm btn-success btn-download"><i class="bi bi-download me-1"></i> Tải xuống</a>`;
                                    Toastify({ text: "Một tệp đã xuất thành công!", duration: 4000, style: { background: "#198754" } }).showToast();
                                }
                                else if (log.status === 'failed') {
                                    statusCol.innerHTML = '<span class="badge bg-danger">Thất bại</span>';
                                    actionCol.innerHTML = `<button class="btn btn-sm btn-danger btn-show-error" data-error="${log.error_message}"><i class="bi bi-exclamation-triangle me-1"></i> Xem lỗi</button>`;
                                }
                                else if (log.status === 'processing') {
                                    statusCol.innerHTML = '<span class="badge bg-warning text-dark">Đang xử lý</span>';
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Lỗi khi cập nhật trạng thái:', error));
        }

        setInterval(pollExportStatus, 3000);
    });
</script>
@endsection
