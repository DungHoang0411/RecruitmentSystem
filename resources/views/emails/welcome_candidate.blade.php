<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào mừng bạn gia nhập hệ thống</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; color: #333333; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    <!-- Header Email -->
                    <tr>
                        <td style="background-color: #198754; padding: 30px; text-align: center;">
                            <h2 style="color: #ffffff; margin: 0; font-size: 24px;">Chào mừng ứng viên mới!</h2>
                        </td>
                    </tr>

                    <!-- Nội dung chính -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="margin-top: 0; font-size: 16px;">Xin chào <strong>{{ $user->name }}</strong>,</p>

                            <p style="font-size: 15px;">Cảm ơn bạn đã đăng ký tài khoản tại <strong>Recruitment System</strong>. Chúng tôi rất vui mừng được đồng hành cùng bạn trên con đường tìm kiếm cơ hội nghề nghiệp tuyệt vời.</p>

                            <p style="font-size: 15px;">Để hoàn tất quá trình đăng ký và bắt đầu sử dụng đầy đủ các tính năng của hệ thống, vui lòng xác thực địa chỉ email của bạn bằng cách nhấn vào nút bên dưới:</p>

                            <!-- Nút Xác Thực -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('verify.email', $token) }}" style="display: inline-block; background-color: #198754; color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px;">
                                            Xác thực tài khoản ngay
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Cảnh báo thời gian -->
                            <p style="font-size: 14px; color: #d9534f; background-color: #f9f2f2; padding: 12px; border-left: 4px solid #d9534f; border-radius: 4px;">
                                <strong>Lưu ý quan trọng:</strong> Liên kết xác thực này chỉ có hiệu lực trong vòng <strong>48 giờ</strong> kể từ thời điểm bạn đăng ký.
                            </p>

                            <p style="font-size: 15px; margin-bottom: 0;">Nếu bạn gặp bất kỳ khó khăn nào trong quá trình thao tác, đừng ngần ngại liên hệ với chúng tôi để được hỗ trợ.</p>
                        </td>
                    </tr>

                    <!-- Footer Email -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px 30px; text-align: center; border-top: 1px solid #eeeeee;">
                            <p style="margin: 0; font-size: 13px; color: #6c757d;">
                                Trân trọng,<br>
                                <strong>Đội ngũ Recruitment System</strong>
                            </p>
                            <p style="margin: 10px 0 0 0; font-size: 11px; color: #adb5bd;">
                                Bạn nhận được email này vì đã đăng ký tài khoản trên hệ thống của chúng tôi. Nếu không phải bạn, vui lòng bỏ qua email này.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
