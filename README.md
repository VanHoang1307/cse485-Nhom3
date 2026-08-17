# 🎓 Hệ thống quản lý học bổng

## 1. Giới thiệu

**Hệ thống quản lý học bổng** là một ứng dụng Web được xây dựng nhằm hỗ trợ nhà trường trong việc quản lý các chương trình học bổng, điều kiện xét duyệt, hồ sơ sinh viên, minh chứng, tiêu chí đánh giá, hội đồng xét duyệt, điểm đánh giá và kết quả xếp hạng.

Project được thực hiện trong khuôn khổ **Project cuối môn CSE485 – Phát triển ứng dụng Web**.

### Thông tin project

| Nội dung              | Thông tin                                        |
| --------------------- | ------------------------------------------------ |
| Đề tài                | Quản lý học bổng, hỗ trợ và thành tích sinh viên |
| Môn học               | CSE485 – Phát triển ứng dụng Web                 |
| Trường                | Đại học Thủy Lợi                                 |
| Công nghệ             | Laravel 12                                       |
| Ngôn ngữ              | PHP 8.2+                                         |
| Cơ sở dữ liệu         | MySQL                                            |
| Frontend              | Blade, HTML, CSS, Bootstrap 5                    |
| ORM                   | Laravel Eloquent                                 |
| Môi trường phát triển | XAMPP                                            |
| Quản lý mã nguồn      | Git / GitHub                                     |

---

## 2. Mục tiêu hệ thống

Hệ thống được xây dựng nhằm:

* Quản lý chương trình học bổng.
* Quản lý điều kiện xét học bổng.
* Quản lý thông tin sinh viên.
* Quản lý hồ sơ đăng ký học bổng.
* Quản lý các tài liệu/minh chứng của hồ sơ.
* Quản lý tiêu chí chấm điểm.
* Quản lý hội đồng xét duyệt.
* Quản lý điểm đánh giá hồ sơ.
* Quản lý kết quả xếp hạng học bổng.
* Đảm bảo dữ liệu giữa các module có quan hệ và ràng buộc rõ ràng.
* Cung cấp giao diện quản trị trực quan cho người sử dụng.

---

## 3. Chức năng chính

### 3.1. Quản lý học bổng

Quản lý các chương trình học bổng trong hệ thống.

Các chức năng:

* Xem danh sách học bổng.
* Thêm chương trình học bổng.
* Xem chi tiết.
* Chỉnh sửa.
* Xóa.
* Quản lý trạng thái chương trình.
* Phân trang danh sách.

Thông tin chính của chương trình gồm:

* Tên học bổng.
* Mô tả.
* Mức học bổng.
* Năm học.
* Học kỳ.
* Ngày bắt đầu.
* Ngày kết thúc.
* Trạng thái.

---

### 3.2. Quản lý điều kiện xét học bổng

Cho phép cấu hình các điều kiện để sinh viên được xét học bổng.

Các chức năng:

* Xem danh sách điều kiện.
* Thêm điều kiện.
* Chỉnh sửa điều kiện.
* Xóa điều kiện.
* Liên kết điều kiện với chương trình học bổng.

Các điều kiện gồm:

* GPA tối thiểu.
* Số tín chỉ tối thiểu.
* Tình trạng nợ môn.
* Ghi chú.

---

### 3.3. Quản lý sinh viên

Quản lý thông tin sinh viên tham gia hệ thống.

Các chức năng:

* Xem danh sách sinh viên.
* Thêm sinh viên.
* Chỉnh sửa thông tin.
* Xem thông tin sinh viên.
* Xóa sinh viên.

---

### 3.4. Quản lý hồ sơ đăng ký học bổng

Quản lý hồ sơ sinh viên đăng ký các chương trình học bổng.

Các thông tin chính:

* Mã hồ sơ.
* Sinh viên.
* Chương trình học bổng.
* Ngày nộp.
* Trạng thái.
* Ghi chú.

Các trạng thái hồ sơ gồm:

* Pending.
* Approved.
* Rejected.

Các chức năng:

* Xem danh sách hồ sơ.
* Thêm hồ sơ.
* Chỉnh sửa.
* Xem chi tiết.
* Xóa hồ sơ.
* Hiển thị thông tin sinh viên và chương trình học bổng thông qua Eloquent Relationship.

---

### 3.5. Quản lý minh chứng

Quản lý các tài liệu/minh chứng được đính kèm trong hồ sơ học bổng.

Minh chứng được liên kết với hồ sơ đăng ký tương ứng.

Các chức năng:

* Xem danh sách minh chứng.
* Thêm minh chứng.
* Cập nhật.
* Xóa.
* Liên kết minh chứng với hồ sơ.

---

### 3.6. Quản lý tiêu chí chấm điểm

Quản lý các tiêu chí được sử dụng để đánh giá hồ sơ.

Các chức năng:

* Xem danh sách tiêu chí.
* Thêm tiêu chí.
* Chỉnh sửa.
* Xóa.
* Liên kết tiêu chí với chương trình học bổng.

---

### 3.7. Quản lý hội đồng xét duyệt

Quản lý các hội đồng tham gia xét duyệt học bổng.

Thông tin hội đồng gồm:

* Chương trình học bổng.
* Tên hội đồng.
* Chủ tịch hội đồng.
* Ngày quyết định.
* Trạng thái.

Các chức năng:

* Xem danh sách hội đồng.
* Thêm hội đồng.
* Chỉnh sửa.
* Xem chi tiết.
* Xóa.
* Liên kết hội đồng với chương trình học bổng.

---

### 3.8. Quản lý điểm đánh giá

Quản lý điểm do hội đồng đánh giá hồ sơ.

Mỗi điểm đánh giá liên kết với:

* Hồ sơ học bổng.
* Tiêu chí đánh giá.
* Hội đồng xét duyệt.

Các chức năng:

* Xem danh sách điểm.
* Thêm điểm.
* Chỉnh sửa.
* Xem chi tiết.
* Xóa.
* Kiểm tra điểm trong khoảng 0–100.
* Kiểm tra khóa ngoại trước khi lưu.
* Không cho phép tạo bản ghi đánh giá trùng theo ràng buộc CSDL.

---

### 3.9. Quản lý kết quả xếp hạng

Quản lý kết quả xếp hạng các hồ sơ sau quá trình đánh giá.

Kết quả xếp hạng được sử dụng để xác định thứ tự và kết quả xét học bổng của sinh viên.

---

## 4. Các module của hệ thống

Hệ thống được chia thành các nhóm chức năng:

```text
🎓 Quản lý học bổng
│
├── Chương trình học bổng
├── Điều kiện xét
│
👨‍🎓 Quản lý hồ sơ
│
├── Sinh viên
├── Hồ sơ đăng ký
└── Minh chứng
│
⭐ Đánh giá
│
├── Tiêu chí chấm điểm
├── Hội đồng xét duyệt
├── Điểm đánh giá
└── Kết quả xếp hạng
```

Các module không hoạt động độc lập mà được liên kết thông qua khóa ngoại và Eloquent Relationship.

---

## 5. Cơ sở dữ liệu

Hệ thống sử dụng MySQL.

Các bảng nghiệp vụ chính:

```text
scholarship_programs
eligibility_rules
students
applications
application_documents
scoring_criteria
evaluation_committees
evaluation_scores
ranking_results
```

### Quan hệ dữ liệu chính

```text
Scholarship Program
        │
        ├── Eligibility Rules
        │
        ├── Applications
        │       │
        │       └── Application Documents
        │
        ├── Scoring Criteria
        │
        └── Evaluation Committees
                │
                └── Evaluation Scores
                        │
                        ├── Application
                        └── Scoring Criterion

Applications
      │
      └── Ranking Results
```

### ERD

ERD của hệ thống được lưu trong repository:

```text
docs/ERD.png
```

> Nếu tên file ERD của bạn khác, hãy sửa lại đường dẫn trên cho đúng với file thực tế.

---

## 6. Công nghệ sử dụng

### Backend

* PHP 8.2+
* Laravel 12
* Laravel Eloquent ORM

### Database

* MySQL
* Laravel Migration
* Laravel Seeder

### Frontend

* Blade Template
* HTML5
* CSS3
* Bootstrap 5.3

### Công cụ

* XAMPP
* Composer
* Git
* GitHub
* Visual Studio Code

---

## 7. Kiến trúc hệ thống

Project sử dụng kiến trúc MVC của Laravel:

```text
User
 │
 ▼
Route
 │
 ▼
Controller
 │
 ▼
Model / Eloquent
 │
 ▼
MySQL Database
 │
 ▼
Controller
 │
 ▼
Blade View
 │
 ▼
User
```

### Route

Route xác định URL và Controller/action tương ứng.

Ví dụ:

```php
Route::resource(
    'evaluation-scores',
    EvaluationScoreController::class
);
```

### Controller

Controller tiếp nhận Request, validation và gọi Model để xử lý dữ liệu.

Ví dụ:

```text
EvaluationScoreController
```

### Model

Model sử dụng Eloquent để thao tác với database và định nghĩa relationship.

Ví dụ:

```text
EvaluationScore
EvaluationCommittee
ScoringCriterion
Application
```

### View

Giao diện được xây dựng bằng Blade.

Ví dụ:

```text
resources/views/
├── scholarships/
├── eligibility_rules/
├── students/
├── applications/
├── application_documents/
├── scoring_criteria/
├── evaluation_committees/
├── evaluation_scores/
└── ranking_results/
```

---

## 8. Validation và toàn vẹn dữ liệu

Hệ thống thực hiện validation ở backend bằng Laravel Validation.

Ví dụ đối với điểm đánh giá:

```php
'score' => [
    'required',
    'numeric',
    'min:0',
    'max:100'
],
```

Các khóa ngoại sử dụng quy tắc `exists` để đảm bảo dữ liệu liên kết tồn tại.

Ví dụ:

```php
'application_id' => [
    'required',
    'exists:applications,id'
],
```

Ngoài validation ở Controller, database cũng sử dụng:

* Primary Key.
* Foreign Key.
* Unique Constraint.
* Nullable hợp lý.
* Enum/kiểu dữ liệu phù hợp.
* Cascade Delete đối với các quan hệ phù hợp.

---

## 9. Migration và Seeder

Database được xây dựng bằng Laravel Migration.

Các migration đảm bảo database có thể được dựng lại trên một máy mới.

Dữ liệu demo được tạo bằng Seeder.

### Tạo database

Tạo database MySQL:

```sql
CREATE DATABASE scholarship_management;
```

Sau đó cấu hình file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scholarship_management
DB_USERNAME=root
DB_PASSWORD=
```

> Không commit file `.env` lên GitHub.

---

## 10. Cài đặt project

### Bước 1: Clone repository

```bash
git clone <LINK_GITHUB_CUA_BAN>
```

Di chuyển vào thư mục project:

```bash
cd scholarship-management
```

### Bước 2: Cài đặt Composer

```bash
composer install
```

### Bước 3: Tạo file `.env`

Windows:

```bash
copy .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

### Bước 4: Tạo Application Key

```bash
php artisan key:generate
```

### Bước 5: Cấu hình database

Mở file:

```text
.env
```

Thiết lập:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scholarship_management
DB_USERNAME=root
DB_PASSWORD=
```

### Bước 6: Chạy Migration và Seeder

```bash
php artisan migrate:fresh --seed
```

Lệnh trên sẽ:

1. Xóa các bảng cũ.
2. Tạo lại database structure.
3. Chạy các migration.
4. Chạy Seeder.
5. Tạo dữ liệu demo.

### Bước 7: Chạy Laravel

```bash
php artisan serve
```

Truy cập:

```text
http://127.0.0.1:8000
```

---

## 11. Các URL chính

| Chức năng          | URL                      |
| ------------------ | ------------------------ |
| Tổng quan          | `/`                      |
| Học bổng           | `/scholarships`          |
| Điều kiện xét      | `/eligibility-rules`     |
| Sinh viên          | `/students`              |
| Hồ sơ đăng ký      | `/applications`          |
| Minh chứng         | `/application-documents` |
| Tiêu chí chấm điểm | `/scoring-criteria`      |
| Hội đồng xét duyệt | `/evaluation-committees` |
| Điểm đánh giá      | `/evaluation-scores`     |
| Kết quả xếp hạng   | `/ranking-results`       |

---

## 12. Các yêu cầu an toàn

Project thực hiện các nguyên tắc:

* Sử dụng CSRF Token cho form.
* Không xóa dữ liệu bằng GET.
* Sử dụng POST/DELETE cho thao tác xóa.
* Validation dữ liệu ở backend.
* Sử dụng Eloquent thay vì nối chuỗi SQL trực tiếp.
* Kiểm tra `exists` đối với khóa ngoại.
* Sử dụng `$fillable` trong Model.
* Escape dữ liệu khi hiển thị trong Blade.
* Không commit `.env`.
* Không commit password/token thật.
* Database sử dụng Foreign Key và Unique Constraint để đảm bảo toàn vẹn dữ liệu.

---

## 13. Kiểm thử

Các chức năng chính được kiểm tra theo các trường hợp:

### Create

* Nhập dữ liệu hợp lệ.
* Bỏ trống trường bắt buộc.
* Nhập sai kiểu dữ liệu.
* Nhập khóa ngoại không tồn tại.
* Nhập dữ liệu bị trùng.

### Update

* Cập nhật dữ liệu hợp lệ.
* Kiểm tra validation.
* Kiểm tra relationship.
* Kiểm tra unique constraint.

### Delete

* Xóa bản ghi không có dữ liệu phụ thuộc.
* Kiểm tra trường hợp bản ghi đang được sử dụng bởi bảng khác.
* Sử dụng phương thức HTTP phù hợp.

### Relationship

Kiểm tra dữ liệu liên kết được hiển thị bằng tên thay vì chỉ hiển thị ID.

Ví dụ:

```text
Hồ sơ → Sinh viên
Hồ sơ → Chương trình học bổng
Điểm → Tiêu chí
Điểm → Hội đồng
Điểm → Hồ sơ
```

---

## 14. Dữ liệu demo

Project có dữ liệu demo cho các module để phục vụ việc:

* Kiểm thử CRUD.
* Kiểm tra relationship.
* Kiểm tra validation.
* Demo hệ thống.
* Kiểm tra xếp hạng và đánh giá.

Sau khi chạy:

```bash
php artisan migrate:fresh --seed
```

database sẽ được tạo lại cùng dữ liệu demo.

---

## 15. Cấu trúc thư mục chính

```text
scholarship-management/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   └── views/
│
├── routes/
│   └── web.php
│
├── public/
│
├── docs/
│   └── ERD.png
│
├── .env.example
├── composer.json
└── README.md
```

---

## 16. Phân công thành viên

### Thành viên 1 — Nguyễn Văn Hoàng

Phụ trách:

* Quản lý chương trình học bổng.
* Quản lý điều kiện xét học bổng.
* Quản lý tiêu chí chấm điểm.
* Quản lý hội đồng xét duyệt.
* Quản lý điểm đánh giá.
* Tích hợp các module đánh giá.
* Migration, Model, Controller, Blade và Seeder của các module được phân công.

### Thành viên 2 — Nguyễn Thị Thúy Hường

Phụ trách:

* Quản lý sinh viên.
* Quản lý hồ sơ đăng ký.
* Quản lý minh chứng.
* Quản lý kết quả xếp hạng.
* Tích hợp module hồ sơ với module học bổng.
* Migration, Model, Controller, Blade và Seeder của các module được phân công.

> Cập nhật lại bảng phân công nếu project thực tế có sự thay đổi.

---

## 17. Git và quản lý mã nguồn

Project được quản lý bằng Git và GitHub.

Quy trình làm việc:

```text
Tạo branch
    ↓
Phát triển chức năng
    ↓
Test
    ↓
Commit
    ↓
Push
    ↓
Review / Merge
```

Commit nên mô tả rõ nội dung thay đổi.

Ví dụ:

```text
feat: add scholarship program CRUD
feat: add evaluation committee module
feat: add evaluation score validation
fix: fix evaluation committee display
fix: handle duplicate evaluation score
```

Không commit:

```text
.env
/vendor
node_modules
file tạm
credential thật
password/token
```

---

## 18. Hướng phát triển

Các chức năng có thể mở rộng trong tương lai:

* Authentication.
* Phân quyền Admin / Sinh viên / Hội đồng.
* Middleware và Policy.
* Upload và quản lý file nâng cao.
* Tự động tính tổng điểm theo trọng số.
* Tự động xếp hạng theo tổng điểm.
* Kiểm tra ngân sách học bổng.
* Quản lý chi trả học bổng.
* Xuất báo cáo.
* Dashboard thống kê nâng cao.
* Gửi thông báo cho sinh viên.

Các chức năng mở rộng không thay thế các chức năng CRUD và validation cốt lõi.

---

## 19. Kết luận

Hệ thống **Quản lý học bổng** được xây dựng trên Laravel theo kiến trúc MVC, sử dụng Migration, Seeder, Eloquent Relationship, Controller và Blade.

Hệ thống tập trung vào quy trình:

```text
Chương trình học bổng
        ↓
Điều kiện xét
        ↓
Sinh viên
        ↓
Hồ sơ đăng ký
        ↓
Minh chứng
        ↓
Tiêu chí + Hội đồng
        ↓
Điểm đánh giá
        ↓
Kết quả xếp hạng
```

Project đáp ứng các yêu cầu về:

* Thiết kế cơ sở dữ liệu.
* PK/FK và constraint.
* Migration và Seeder.
* Eloquent Model và Relationship.
* CRUD.
* Backend Validation.
* CSRF.
* Giao diện Blade + Bootstrap.
* Git/GitHub.
* Dữ liệu demo.
* ERD.
* Tài liệu hướng dẫn cài đặt và sử dụng.

---

## 20. Tác giả

**Nguyễn Văn Hoàng**
Sinh viên Khoa Công nghệ thông tin
Trường Đại học Thủy Lợi

**Nguyễn Thị Thúy Hường**
Sinh viên Khoa Công nghệ thông tin
Trường Đại học Thủy Lợi

---

## 📌 Ghi chú

Đây là project phục vụ mục đích học tập trong môn **CSE485 – Phát triển ứng dụng Web**.

Không sử dụng dữ liệu cá nhân, mật khẩu hoặc credential thật trong repository.
