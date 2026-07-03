<<<<<<< HEAD
# Hệ thống Quản lý Tuyển dụng - Job Posts
=======

# Hệ thống Quản lý Tuyển dụng - Module Job Posts

Dự án này là bài tập thực tập sinh xây dựng chức năng **Quản lý Tin tuyển dụng (Job Posts)** sử dụng framework Laravel 12.
>>>>>>> aaeb8b47b865a2ef6431cd162498840c0c3858e6

##  Người thực hiện
- **Thực tập sinh:** Dũng
- **Vai trò:** Xây dựng CRUD, Validation, Filter và Pagination cho module Job Posts.

---

## 🔗 Danh sách Tuyến đường (Routes / API Endpoints) để Test

Toàn bộ hệ thống được xây dựng chuẩn RESTful qua `Route::resource`. Dưới đây là bảng thiết kế các endpoint để test luồng dữ liệu:

| HTTP Method | Endpoint (URL) | Chức năng | Dữ liệu truyền vào (Params/Body) |
| :--- | :--- | :--- | :--- |
| **GET** | `/job-posts` | Xem danh sách tin | `?status=active/closed` & `?department=...` |
| **GET** | `/job-posts/create` | Giao diện form thêm tin | Không có |
| **POST** | `/job-posts` | Xử lý lưu tin mới | `title`, `department`, `deadline`, `salary_min`, `salary_max`, `status` |
| **GET** | `/job-posts/{id}` | Xem chi tiết 1 tin | ID của bản ghi trên URL |
| **GET** | `/job-posts/{id}/edit`| Giao diện form sửa tin | ID của bản ghi trên URL |
| **PUT** | `/job-posts/{id}` | Xử lý cập nhật tin | Giống phương thức POST |
| **DELETE** | `/job-posts/{id}` | Xử lý xóa tin | ID của bản ghi trên URL |

> **Ghi chú:** Các route POST, PUT, DELETE đều được bảo vệ bởi CSRF Token của Laravel. Quá trình test mượt mà nhất là thao tác trực tiếp trên giao diện trình duyệt.

---

##  Các tính năng kỹ thuật đã hoàn thành
- [x] Khởi tạo project Laravel 12 và cấu hình Git (Commit chia nhỏ theo tính năng).
- [x] Tạo Model, Migration và cấu hình Eloquent ORM.
- [x] Tạo Seeder sinh 20 bản ghi mẫu tự động.
- [x] Xây dựng Resource Controller và Route Resource (Code thủ công 100%, không dùng auto package).
- [x] Form Request Validation (`salary_max >= salary_min` và các trường bắt buộc).
- [x] Phân trang dữ liệu (10 bản ghi/trang).
- [x] Lọc dữ liệu theo "Trạng thái" và "Phòng ban".
- [x] Tự động hiển thị nhãn **(Hết hạn)** nếu deadline nhỏ hơn ngày hiện tại.

---

##  Hướng dẫn cài đặt và chạy thử (Tối ưu cho Laragon)

Cách tiện lợi và chuyên nghiệp nhất để test dự án này là sử dụng tính năng **Virtual Host** của môi trường Laragon.

**Quy trình thực hiện:**

1. Mở Terminal của Laragon, di chuyển vào thư mục `www`:
   ```bash
<<<<<<< HEAD
   cd C:\laragon\www
Clone dự án về máy (đảm bảo đúng tên thư mục RecruitmentSystem):

Bash
git clone https://github.com/DungHoang0411/RecruitmentSystem.git RecruitmentSystem
Di chuyển vào thư mục dự án và cài đặt các thư viện PHP:

Bash
cd RecruitmentSystem
composer install
Copy file cấu hình và tạo Application Key:

Bash
copy .env.example .env
php artisan key:generate
Cấu hình Database:

Mở giao diện quản lý Database của Laragon (HeidiSQL/phpMyAdmin).

Tạo một database rỗng với tên là: recruitment_system.

Chạy lệnh tạo bảng và gieo 20 bản ghi mẫu:

Bash
php artisan migrate --seed
Khởi động lại Apache/Nginx trên Laragon (Bấm nút Stop rồi Start lại) để hệ thống nhận diện Virtual Host.

Test dự án: Không cần phải chạy lệnh php artisan serve. Có thể truy cập trực tiếp hệ thống thông qua tên miền ảo nội bộ:
 http://recruitmentsystem.test/job-posts

(Trường hợp không sử dụng Laragon, vui lòng chạy lệnh php artisan serve và truy cập http://127.0.0.1:8000/job-posts)
=======
   git clone <đường-link-github-của-bạn>
>>>>>>> aaeb8b47b865a2ef6431cd162498840c0c3858e6
