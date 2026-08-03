<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách sinh viên</h2>

        <a href="{{ route('students.create') }}" class="btn btn-primary">
            + Thêm sinh viên
        </a>
    </div>

    {{-- Thông báo thành công --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <div class="card">

        <div class="card-header bg-primary text-white">

            Danh sách sinh viên

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover table-striped">

                <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>MSSV</th>

                    <th>Họ tên</th>

                    <th>Giới tính</th>

                    <th>Khoa</th>

                    <th>Ngành</th>

                    <th>Lớp</th>

                    <th>Email</th>

                    <th>Điện thoại</th>

                    <th>GPA</th>

                    <th>Điểm rèn luyện</th>

                    <th>Trạng thái</th>

                </tr>

                </thead>

                <tbody>

                @forelse($students as $student)

                    <tr>

                        <td>{{ $student->id }}</td>

                        <td>{{ $student->student_code }}</td>

                        <td>{{ $student->full_name }}</td>

                        <td>{{ $student->gender }}</td>

                        <td>{{ $student->faculty }}</td>

                        <td>{{ $student->major }}</td>

                        <td>{{ $student->class }}</td>

                        <td>{{ $student->email }}</td>

                        <td>{{ $student->phone }}</td>

                        <td>{{ $student->gpa }}</td>

                        <td>{{ $student->training_score }}</td>

                        <td>

                            @if($student->status == 'Active')

                                <span class="badge bg-success">

                                    Active

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    {{ $student->status }}

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="12" class="text-center text-danger">

                            Chưa có dữ liệu sinh viên.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>