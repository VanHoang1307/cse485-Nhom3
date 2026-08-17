<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sinh viên</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h3>Cập nhật thông tin sinh viên</h3>
        </div>

        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('students.update',$student->id) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="row">

                    <!-- Mã sinh viên -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Mã sinh viên</label>

                        <input
                            type="text"
                            name="student_code"
                            class="form-control"
                            value="{{ old('student_code',$student->student_code) }}"
                            required>

                    </div>

                    <!-- Họ tên -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Họ và tên</label>

                        <input
                            type="text"
                            name="full_name"
                            class="form-control"
                            value="{{ old('full_name',$student->full_name) }}"
                            required>

                    </div>

                    <!-- Giới tính -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Giới tính</label>

                        <select
                            name="gender"
                            class="form-select"
                            required>

                            <option value="Male"
                                {{ old('gender',$student->gender)=='Male'?'selected':'' }}>
                                Nam
                            </option>

                            <option value="Female"
                                {{ old('gender',$student->gender)=='Female'?'selected':'' }}>
                                Nữ
                            </option>

                            <option value="Other"
                                {{ old('gender',$student->gender)=='Other'?'selected':'' }}>
                                Khác
                            </option>

                        </select>

                    </div>

                    <!-- Ngày sinh -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Ngày sinh</label>

                        <input
                            type="date"
                            name="date_of_birth"
                            class="form-control"
                            value="{{ old('date_of_birth',$student->date_of_birth) }}">

                    </div>

                    <!-- Khoa -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Khoa</label>

                        <input
                            type="text"
                            name="faculty"
                            class="form-control"
                            value="{{ old('faculty',$student->faculty) }}"
                            required>

                    </div>

                    <!-- Ngành -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Ngành</label>

                        <input
                            type="text"
                            name="major"
                            class="form-control"
                            value="{{ old('major',$student->major) }}"
                            required>

                    </div>

                    <!-- Lớp -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Lớp</label>

                        <input
                            type="text"
                            name="class"
                            class="form-control"
                            value="{{ old('class',$student->class) }}"
                            required>

                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email',$student->email) }}"
                            required>

                    </div>

                    <!-- Điện thoại -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Điện thoại</label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone',$student->phone) }}">

                    </div>

                    <!-- GPA -->
                    <div class="col-md-3 mb-3">

                        <label class="form-label">GPA</label>

                        <input
                            type="number"
                            name="gpa"
                            class="form-control"
                            step="0.01"
                            min="0"
                            max="4"
                            value="{{ old('gpa',$student->gpa) }}"
                            required>

                    </div>

                    <!-- Điểm rèn luyện -->
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Điểm rèn luyện</label>

                        <input
                            type="number"
                            name="training_score"
                            class="form-control"
                            step="0.01"
                            min="0"
                            max="100"
                            value="{{ old('training_score',$student->training_score) }}"
                            required>

                    </div>

                    <!-- Trạng thái -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Trạng thái</label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="Active"
                                {{ old('status',$student->status)=='Active'?'selected':'' }}>
                                Active
                            </option>

                            <option value="Inactive"
                                {{ old('status',$student->status)=='Inactive'?'selected':'' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                <hr>

                <button
                    type="submit"
                    class="btn btn-warning">

                    Cập nhật

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