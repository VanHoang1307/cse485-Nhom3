<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Thêm sinh viên</h3>
        </div>

        <div class="card-body">

            {{-- Hiển thị lỗi validate --}}
            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>Đã xảy ra lỗi!</strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('students.store') }}" method="POST">

                @csrf

                <div class="row">

                    <!-- MSSV -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Mã sinh viên
                        </label>

                        <input
                            type="text"
                            name="student_code"
                            class="form-control"
                            value="{{ old('student_code') }}"
                            required>

                    </div>

                    <!-- Họ tên -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Họ và tên
                        </label>

                        <input
                            type="text"
                            name="full_name"
                            class="form-control"
                            value="{{ old('full_name') }}"
                            required>

                    </div>

                    <!-- Giới tính -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Giới tính
                        </label>

                        <select
                            name="gender"
                            class="form-select"
                            required>

                            <option value="">-- Chọn giới tính --</option>

                            <option value="Male"
                                {{ old('gender')=='Male'?'selected':'' }}>
                                Nam
                            </option>

                            <option value="Female"
                                {{ old('gender')=='Female'?'selected':'' }}>
                                Nữ
                            </option>

                            <option value="Other"
                                {{ old('gender')=='Other'?'selected':'' }}>
                                Khác
                            </option>

                        </select>

                    </div>

                    <!-- Ngày sinh -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Ngày sinh
                        </label>

                        <input
                            type="date"
                            name="date_of_birth"
                            class="form-control"
                            value="{{ old('date_of_birth') }}">

                    </div>

                    <!-- Khoa -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Khoa
                        </label>

                        <input
                            type="text"
                            name="faculty"
                            class="form-control"
                            value="{{ old('faculty') }}"
                            required>

                    </div>

                    <!-- Ngành -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Ngành
                        </label>

                        <input
                            type="text"
                            name="major"
                            class="form-control"
                            value="{{ old('major') }}"
                            required>

                    </div>

                    <!-- Lớp -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Lớp
                        </label>

                        <input
                            type="text"
                            name="class"
                            class="form-control"
                            value="{{ old('class') }}"
                            required>

                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required>

                    </div>

                    <!-- Điện thoại -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Điện thoại
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone') }}">

                    </div>

                    <!-- GPA -->
                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            GPA
                        </label>

                        <input
                            type="number"
                            name="gpa"
                            class="form-control"
                            min="0"
                            max="4"
                            step="0.01"
                            value="{{ old('gpa') }}"
                            required>

                    </div>

                    <!-- Điểm rèn luyện -->
                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Điểm rèn luyện
                        </label>

                        <input
                            type="number"
                            name="training_score"
                            class="form-control"
                            min="0"
                            max="100"
                            step="0.01"
                            value="{{ old('training_score') }}"
                            required>

                    </div>

                    <!-- Trạng thái -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Trạng thái
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="Active"
                                {{ old('status')=='Active'?'selected':'' }}>
                                Active
                            </option>

                            <option value="Inactive"
                                {{ old('status')=='Inactive'?'selected':'' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                <hr>

                <button
                    type="submit"
                    class="btn btn-success">

                    Lưu sinh viên

                </button>

                <a
                    href="{{ route('students.index') }}"
                    class="btn btn-secondary">

                    Quay lại

                </a>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>