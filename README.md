# Hệ thống Quản lý Tuyển dụng - Module Job Posts

Dự án này là bài tập thực tập sinh xây dựng chức năng **Quản lý Tin tuyển dụng (Job Posts)** sử dụng framework Laravel 12.

## Người thực hiện
- **Thực tập sinh:** Dũng
- **Vai trò:** Xây dựng CRUD, Validation, Filter và Pagination cho module Job Posts.

## Các tính năng đã hoàn thành
- [x] Khởi tạo project Laravel 12 và cấu hình Git.
- [x] Commit chia nhỏ theo từng chức năng (Conventional Commits).
- [x] Tạo Model, Migration và cấu hình Eloquent ORM.
- [x] Tạo Seeder sinh ít nhất 20 bản ghi mẫu tự động.
- [x] Xây dựng Resource Controller và Route Resource (Không dùng auto CRUD package).
- [x] Form Request Validation:
  - Bắt buộc nhập: Tiêu đề, Phòng ban, Hạn nộp.
  - Logic tùy chỉnh: `salary_max` luôn phải >= `salary_min`.
- [x] Xây dựng giao diện bằng Blade thuần.
- [x] Phân trang dữ liệu (10 bản ghi/trang).
- [x] **[Bonus]** Lọc dữ liệu theo "Trạng thái" và "Phòng ban".
- [x] **[Bonus]** Tự động hiển thị nhãn **(Hết hạn)** nếu deadline nhỏ hơn ngày hiện tại.

##  Hướng dẫn cài đặt

Để chạy dự án này trên máy tính cục bộ, vui lòng thực hiện các bước sau:

1. Clone kho lưu trữ về máy:
   ```bash
   git clone <đường-link-github-của-bạn>