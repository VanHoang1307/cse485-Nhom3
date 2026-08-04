<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hồ sơ học bổng</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Danh sách hồ sơ học bổng</h2>

        <a href="{{ route('applications.create') }}" class="btn btn-primary">
            + Thêm hồ sơ
        </a>

    </div>

    {{-- Thông báo --}}
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

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            Quản lý hồ sơ xét học bổng

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover table-striped align-middle">

                <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Mã hồ sơ</th>

                    <th>Sinh viên</th>

                    <th>MSSV</th>

                    <th>ID CTHB</th>

                    <th>Ngày nộp</th>

                    <th>Trạng thái</th>

                    <th>Ghi chú</th>

                    <th width="180">Thao tác</th>

                </tr>

                </thead>

                <tbody>

                @forelse($applications as $application)

                    <tr>

                        <td>

                            {{ $application->id }}

                        </td>

                        <td>

                            {{ $application->application_code }}

                        </td>

                        <td>

                            {{ $application->student->full_name }}

                        </td>

                        <td>

                            {{ $application->student->student_code }}

                        </td>

                        <td>

                            {{ $application->scholarship_program_id }}

                        </td>

                        <td>

                            {{ $application->apply_date }}

                        </td>

                        <td>

                            @if($application->status == 'Pending')

                                <span class="badge bg-warning text-dark">

                                    Pending

                                </span>

                            @elseif($application->status == 'Approved')

                                <span class="badge bg-success">

                                    Approved

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Rejected

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $application->review_note }}

                        </td>

                        <td>

                            <a
                                href="{{ route('applications.edit',$application->id) }}"
                                class="btn btn-warning btn-sm">

                                Sửa

                            </a>

                            <form
                                action="{{ route('applications.destroy',$application->id) }}"
                                method="POST"
                                style="display:inline;">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa hồ sơ này?')">

                                    Xóa

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center text-danger">

                            Chưa có hồ sơ học bổng nào.

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