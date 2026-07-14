@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('css/job-index.css') }}">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Quản lý Thẻ (Tags)</h2>
            <a href="{{ route('tags.create') }}" class="btn btn-brand px-4">+ Thêm Thẻ</a>
        </div>

        <div class="row g-3">
            @forelse($tags as $tag)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 8px;">
                        <div class="card-body d-flex justify-content-between align-items-center p-3">
                            <a href="{{ route('tags.show', $tag->slug ?? $tag->id) }}"
                                class="text-decoration-none text-dark fw-bold">
                                #{{ $tag->name }}
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                    <li><a class="dropdown-item"
                                            href="{{ route('tags.edit', $tag->slug ?? $tag->id) }}">Sửa</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('tags.destroy', $tag->slug ?? $tag->id) }}" method="POST"
                                            class="form-delete d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Xóa</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">Chưa có dữ liệu thẻ</h5>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $tags->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Xác nhận xóa?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Đồng ý'
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    style: {
                        background: "#198754"
                    }
                }).showToast();
            });
        </script>
    @endif
@endsection
