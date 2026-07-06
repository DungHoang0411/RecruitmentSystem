# Hệ thống Quản lý Tuyển dụng - Module Job Posts

##  Thông tin thực hiện
* **Người thực hiện:** Dũng (Thực tập sinh IT)
* **Vai trò:** Lên cấu trúc Database, xây dựng logic Controller (CRUD, Validation, Routing) và thiết kế giao diện View (Blade Template).
* **Công nghệ:** Framework Laravel 12, Bootstrap 5, MySQL.

---

## Các tính năng kỹ thuật nổi bật đã hoàn thiện

### 1. Quản lý Dữ liệu & Routing Nâng cao
* **Route Model Binding với Custom Slug:** Thay vì sử dụng `id` khóa chính trên URL (ví dụ: `/job-posts/20`), hệ thống đã được custom để tự động trích xuất và truy vấn theo `slug` (ví dụ: `/job-posts/thuc-tap-sinh-nhat-ban-6a4753...`), giúp URL thân thiện và bảo mật hơn.
* **Tự động sinh Slug:** Hệ thống tự động tạo slug chuẩn kết hợp hàm `uniqid()` mỗi khi thêm mới hoặc cập nhật tiêu đề, đảm bảo tính duy nhất tuyệt đối trên toàn hệ thống.
* **Soft Deletes (Xóa mềm):** Tích hợp tính năng xóa mềm của Laravel, bảo vệ dữ liệu không bị mất vĩnh viễn khi người dùng thao tác xóa.

### 2. Validation & Xử lý Logic Nghiệp vụ (Form Request)
* **Custom Rule chống trùng lặp:** Tích hợp logic `Rule::unique` kết hợp tùy chỉnh câu thông báo Tiếng Việt ("Tiêu đề bị trùng lặp") để chặn ngay lập tức nếu người dùng nhập trùng tiêu đề bài đăng.
* **Logic Ràng buộc chặt chẽ:** * Lương tối đa (`salary_max`) bắt buộc phải $\ge$ Lương tối thiểu (`salary_min`).
  * Tuổi tối đa (`age_max`) bắt buộc phải $\ge$ Tuổi tối thiểu (`age_min`).
  * Tuổi lao động tối thiểu phải từ 18 tuổi trở lên.
  * Ngày hết hạn (`expired_at`) phải sau ngày đăng bài (`published_at`).

### 3. Tối ưu Giao diện Người dùng (UI/UX)
* **Xử lý hiển thị số liệu:** Sử dụng hàm `round()` ép kiểu số nguyên để loại bỏ các số thập phân thừa (`.00`) khi hiển thị mức lương, giúp giao diện gọn gàng.
* **Tối ưu Input Thời gian:** Chuyển đổi định dạng thu thập thời gian từ `datetime-local` sang `date` chuẩn, chỉ tập trung vào Ngày/Tháng/Năm, bỏ qua chọn Giờ/Phút gây rườm rà cho người nhập liệu.
* **Đánh dấu trường bắt buộc:** Bổ sung hiển thị `*` màu đỏ trực quan tại tất cả các trường không được phép `null`.
* **Quản lý Session Alerts:** Cấu trúc lại hệ thống thông báo flash session, đảm bảo chỉ hiển thị 1 thông báo duy nhất, chính xác và đã được Việt hóa 100% sau mỗi hành động (Thêm/Sửa/Xóa).

### 4. Hiển thị & Tra cứu
* **Hệ thống Lọc (Filter) Đa luồng:** Cho phép lọc tin tuyển dụng đồng thời theo: *Trạng thái*, *Quốc gia đến*, *Loại Visa*, *Hình thức công việc* và *Tìm kiếm theo tiêu đề*.
* **Phân trang & Sắp xếp:** Dữ liệu được phân trang (10 bản ghi/trang), luôn ưu tiên hiển thị các tin được đánh dấu **"Nổi bật" (Featured)** lên đầu, sau đó mới sắp xếp theo thời gian tạo mới nhất.

---

## Tổng quan Cấu trúc Cơ sở dữ liệu (Bảng `job_posts`)

Bảng dữ liệu được thiết kế mở rộng, chia làm 2 nhóm chính:

1. **Nhóm Bắt buộc (Required):**
   * `title`, `slug`, `description`.
   * `status` (Enum: draft, published, closed, expired).
   * `destination_country`, `job_type`, `visa_type`, `headcount`, `created_by`.

2. **Nhóm Tùy chọn (Nullable):**
   * `salary_min`, `salary_max`, `salary_currency`, `salary_period`.
   * `experience_years_min`, `age_min`, `age_max`, `gender_preference`.
   * Thống kê hệ thống: `view_count` (Tự động tăng khi xem), `application_count`, `is_featured`.
   * `published_at`, `expired_at`.

---

##  Hướng dẫn cài đặt & Chạy dự án (Dành cho Laragon/Localhost)

1. Clone dự án về máy:
   ```bash
   git clone [https://github.com/DungHoang0411/RecruitmentSystem.git](https://github.com/DungHoang0411/RecruitmentSystem.git) RecruitmentSystem
   cd RecruitmentSystem
Cài đặt các thư viện PHP phụ thuộc:

Bash
composer install
Thiết lập biến môi trường và tạo Application Key:

Bash
copy .env.example .env
php artisan key:generate
Cấu hình kết nối Cơ sở dữ liệu trong file .env (Tạo database recruitment_system bằng HeidiSQL/phpMyAdmin).

Chạy Migration để tạo bảng cấu trúc:

Bash
php artisan migrate
Truy cập hệ thống (Nếu dùng Laragon Virtual Host):

[http://recruitmentsystem.test/job-posts](http://recruitmentsystem.test/job-posts)
(Hoặc chạy lệnh php artisan serve và truy cập http://127.0.0.1:8000/job-posts)
