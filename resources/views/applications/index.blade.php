<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <title>Danh sách hồ sơ học bổng</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">

        <h2>Danh sách hồ sơ học bổng</h2>

        <a href="{{ route('applications.create') }}"
           class="btn btn-primary">

            + Thêm hồ sơ

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

        <tr>

            <th>ID</th>

            <th>Mã hồ sơ</th>

            <th>Sinh viên</th>

            <th>Chương trình</th>

            <th>Ngày nộp</th>

            <th>Trạng thái</th>

            <th>Ghi chú</th>

        </tr>

        </thead>

        <tbody>

        @forelse($applications as $application)

            <tr>

                <td>{{ $application->id }}</td>

                <td>{{ $application->application_code }}</td>

                <td>{{ $application->student->full_name }}</td>

                <td>{{ $application->scholarship_program_id }}</td>

                <td>{{ $application->apply_date }}</td>

                <td>{{ $application->status }}</td>

                <td>{{ $application->review_note }}</td>

            </tr>

        @empty

            <tr>

                <td colspan="7" class="text-center">

                    Chưa có hồ sơ.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>

</html>