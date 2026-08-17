<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# ĐỀ TÀI 15 - QUẢN LÝ HỌC BỔNG, HỖ TRỢ VÀ THÀNH TÍCH SINH VIÊN

## Thông tin sinh viên

- Họ tên: Nguyễn Thị Thúy Hường
- MSSV: 2251162032
- Module phụ trách: Module 2 - Quản lý hồ sơ xét học bổng (Application & Evaluation Management)

---

# Công nghệ sử dụng

- Laravel 12
- PHP 8.2
- MySQL
- Bootstrap 5
- Visual Studio Code
- Git & GitHub
- MySQL Workbench / dbdiagram.io (thiết kế ERD)

---

# Cấu trúc Module

Module phụ trách gồm 5 bảng:

- students
- applications
- application_documents
- evaluation_scores
- ranking_results

Trong giai đoạn 1 đã hoàn thành CRUD cho:

- students
- applications

---

# Quy trình thực hiện

## Bước 1. Cài đặt Laravel

Tạo project

```bash
composer create-project laravel/laravel scholarship_management
```

Di chuyển vào project

```bash
cd scholarship_management
```

Khởi động

```bash
php artisan serve
```

---

# Bước 2. Cấu hình Database

Tạo database

```sql
CREATE DATABASE scholarship_management;
```

Chỉnh file

```
.env
```

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scholarship_management
DB_USERNAME=root
DB_PASSWORD=
```

---

# Bước 3. Thiết kế CSDL

Phân tích yêu cầu Module 2.

Thiết kế 5 bảng

- students
- applications
- application_documents
- evaluation_scores
- ranking_results

Xác định

- Primary Key
- Foreign Key
- Quan hệ 1-N
- Quan hệ 1-1

Sau đó vẽ ERD bằng

- dbdiagram.io
hoặc
- MySQL Workbench

---

# Bước 4. Tạo Migration

Sinh Migration

```bash
php artisan make:migration create_students_table

php artisan make:migration create_applications_table

php artisan make:migration create_application_documents_table

php artisan make:migration create_evaluation_scores_table

php artisan make:migration create_ranking_results_table
```

Viết cấu trúc bảng.

Khai báo

- Primary Key
- Foreign Key
- Unique
- Cascade Delete

---

# Bước 5. Chạy Migration

```bash
php artisan migrate
```

Nếu cần chạy lại

```bash
php artisan migrate:fresh
```

---

# Bước 6. Tạo Model

Sinh Model

```bash
php artisan make:model Student

php artisan make:model Application

php artisan make:model ApplicationDocument

php artisan make:model EvaluationScore

php artisan make:model RankingResult
```

Khai báo

```php
protected $fillable=[]
```

Viết Relationship.

Ví dụ

Student

```php
public function applications()
{
    return $this->hasMany(Application::class);
}
```

Application

```php
public function student()
{
    return $this->belongsTo(Student::class);
}
```

---

# Bước 7. Kiểm tra Relationship

Mở

```bash
php artisan tinker
```

Kiểm tra

```php
App\Models\Student::first();

App\Models\Application::first();
```

---

# Bước 8. Tạo Seeder

Sinh Seeder

```bash
php artisan make:seeder StudentSeeder

php artisan make:seeder ApplicationSeeder
```

Thêm dữ liệu mẫu.

Chạy

```bash
php artisan db:seed
```

---

# Bước 9. Tạo Controller

Sinh Controller

```bash
php artisan make:controller StudentController

php artisan make:controller ApplicationController
```

---

# Bước 10. Khai báo Route

```php
Route::resource('students', StudentController::class);

Route::resource('applications', ApplicationController::class);
```

Kiểm tra

```bash
php artisan route:list
```

---

# Bước 11. Xây dựng CRUD Students

Đã hoàn thành

✔ Danh sách sinh viên

✔ Thêm sinh viên

✔ Sửa sinh viên

✔ Xóa sinh viên

Các View

```
students/index.blade.php

students/create.blade.php

students/edit.blade.php
```

---

# Bước 12. Xây dựng CRUD Applications

Đã hoàn thành

✔ Danh sách hồ sơ

✔ Thêm hồ sơ

✔ Sửa hồ sơ

✔ Xóa hồ sơ

Các View

```
applications/index.blade.php

applications/create.blade.php

applications/edit.blade.php
```

---

# Bước 13. Validation

Sử dụng

```php
$request->validate([
...
]);
```

Kiểm tra

- Required
- Email
- Unique
- Numeric
- Date

---

# Bước 14. Giao diện

Sử dụng

Bootstrap 5

Bao gồm

- Card
- Table
- Alert
- Button
- Form
- Confirm Delete

---

# Bước 15. Dữ liệu MySQL

Sau khi chạy

```bash
php artisan migrate
```

Laravel tự động tạo các bảng trong MySQL.

Không cần tự viết SQL CREATE TABLE bằng tay.

Có thể xem dữ liệu trong

phpMyAdmin

hoặc

MySQL Workbench.

---

# Cấu trúc thư mục

```
app
 ├── Models
 │      Student.php
 │      Application.php
 │      ApplicationDocument.php
 │      EvaluationScore.php
 │      RankingResult.php

app
 └── Http
        Controllers
            StudentController.php
            ApplicationController.php

database
 ├── migrations
 └── seeders

resources
 └── views
        students
        applications

routes
     web.php
```

---

# Chức năng đã hoàn thành

## Students

- CRUD
- Validation
- Relationship
- Migration
- Seeder

## Applications

- CRUD
- Validation
- Relationship
- Migration
- Seeder

---

# Chức năng sẽ tiếp tục phát triển

- CRUD Application Documents
- Upload minh chứng
- CRUD Evaluation Scores
- Chấm điểm học bổng
- CRUD Ranking Results
- Xếp hạng sinh viên
- Tích hợp Module 1
- Dashboard
- Authentication
- Phân quyền