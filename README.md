
# Hệ thống Quản lý Tuyển dụng - Module Job Posts

Dự án này là bài tập thực tập sinh xây dựng chức năng **Quản lý Tin tuyển dụng (Job Posts)** sử dụng framework Laravel 12.

##  Người thực hiện
- **Thực tập sinh:** Dũng
- **Vai trò:** Xây dựng CRUD, Validation, Filter và Pagination cho module Job Posts.

##  Hình ảnh minh họa (Screenshots)

**1. Giao diện Danh sách & Lọc (Pagination, Filter & Báo Hết Hạn):**
![Giao diện danh sách]

**2. Giao diện Thêm mới & Hiển thị lỗi Validation:**
![Giao diện thêm mới]

**3. Giao diện Xem chi tiết:**
![Giao diện chi tiết]

---

## 🔗 Danh sách Tuyến đường (Routes / API Endpoints) để Test

Toàn bộ hệ thống được xây dựng chuẩn RESTful qua `Route::resource`. Dưới đây là bảng thiết kế các endpoint để leader có thể test luồng dữ liệu:

| HTTP Method | Endpoint (URL) | Chức năng | Dữ liệu truyền vào (Params/Body) |
| :--- | :--- | :--- | :--- |
| **GET** | `/job-posts` | Xem danh sách tin | `?status=active/closed` & `?department=...` |
| **GET** | `/job-posts/create` | Giao diện form thêm tin | Không có |
| **POST** | `/job-posts` | Xử lý lưu tin mới | `title`, `department`, `deadline`, `salary_min`, `salary_max`, `status` |
| **GET** | `/job-posts/{id}` | Xem chi tiết 1 tin | ID của bản ghi trên URL |
| **GET** | `/job-posts/{id}/edit`| Giao diện form sửa tin | ID của bản ghi trên URL |
| **PUT** | `/job-posts/{id}` | Xử lý cập nhật tin | Giống phương thức POST |
| **DELETE** | `/job-posts/{id}` | Xử lý xóa tin | ID của bản ghi trên URL |

> **Ghi chú kỹ thuật:** Vì đây là ứng dụng Web sử dụng Blade (không phải API thuần), các route POST, PUT, DELETE đều được bảo vệ bởi lớp bảo mật CSRF Token của Laravel. Quá trình test mượt mà nhất là thao tác trực tiếp trên giao diện trình duyệt đã được cung cấp sẵn.

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

##  Hướng dẫn cài đặt và chạy thử

Để khởi chạy dự án này trên máy cục bộ, vui lòng thực hiện:

1. Clone kho lưu trữ về máy:
   ```bash
   git clone <đường-link-github-của-bạn>
