@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Đăng ký tài khoản</h3>

                        <form action="{{ route('register.process') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required maxlength="100">
                                @error('name')<span class="text-danger fs-7">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required maxlength="255">
                                @error('email')<span class="text-danger fs-7">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required minlength="8" maxlength="64">
                                <small class="text-muted">Từ 8-64 ký tự, bao gồm ít nhất 1 chữ hoa và 1 chữ số.</small>
                                @error('password')<br><span class="text-danger fs-7">{{ $message }}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="terms" class="form-check-input" id="terms" required>
                                <label class="form-check-label fs-7" for="terms">
                                    Tôi đã đọc và đồng ý với Điều khoản dịch vụ và Chính sách quyền riêng tư (Bắt buộc)
                                </label>
                                @error('terms')<br><span class="text-danger fs-7">{{ $message }}</span>@enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2 mb-3">Đăng ký <i class="bi bi-arrow-right"></i></button>

                            <div class="text-center mt-3">
                                <span>Bạn đã có tài khoản? </span>
                                <a href="{{ route('login') }}" class="text-success text-decoration-none fw-bold">Đăng nhập ngay</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: { background: "#198754" }
                }).showToast();
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "{{ session('error') }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: { background: "#dc3545" }
                }).showToast();
            });
        </script>
    @endif
@endsection
