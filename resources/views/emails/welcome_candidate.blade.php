<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #198754; text-align: center;">Chào mừng bạn gia nhập hệ thống!</h2>

        <p>Xin chào <strong>{{ $user->name }}</strong>,</p>

        <p>Cảm ơn bạn đã đăng ký tài khoản. Để bắt đầu trải nghiệm và tìm kiếm các cơ hội việc làm, vui lòng xác thực
            địa chỉ email của bạn bằng cách nhấn vào nút bên dưới:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('verify.email', $token) }}"
                style="background-color: #198754; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;">Xác
                thực tài khoản ngay</a>
        </div>

        <p style="font-size: 13px; color: #666;">Lưu ý: Liên kết này chỉ có hiệu lực trong vòng 48 giờ kể từ lúc đăng ký.
        </p>

        <hr style="border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 13px; color: #999; text-align: center;">
            Trân trọng,<br>
            Đội ngũ Recruitment System
        </p>
    </div>
</body>

</html>
