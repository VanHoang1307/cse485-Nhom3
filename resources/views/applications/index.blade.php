@extends('layouts.app')

@section('title', 'Danh sách hồ sơ học bổng')

@section('content')

<div class="card shadow">

```
<div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

    <div>
        <h3 class="mb-1">
            Danh sách hồ sơ học bổng
        </h3>

        <small>
            Quản lý hồ sơ xét học bổng
        </small>
    </div>

    <div>
        <a href="{{ route('scholarships.index') }}"
           class="btn btn-light me-2">
            🎓 Học bổng
        </a>

        <a href="{{ route('applications.create') }}"
           class="btn btn-success">
            + Thêm hồ sơ
        </a>
    </div>

</div>

<div class="card-body">

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">

            <strong>Thành công!</strong>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>
    @endif

    {{-- Thông báo lỗi --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">

            <strong>Không thể thực hiện!</strong>
            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>
    @endif

    {{-- Lỗi validation --}}
    @if($errors->any())
        <div class="alert alert-danger">

            <strong>Vui lòng kiểm tra lại dữ liệu:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif

    {{-- Thống kê nhanh --}}
    <div class="row mb-4">

        {{-- Tổng hồ sơ --}}
        <div class="col-md-3 mb-3">

            <div class="card border-primary h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Tổng hồ sơ
                    </h6>

                    <h3 class="text-primary mb-0">
                        {{ $applications->count() }}
                    </h3>

                </div>

            </div>

        </div>

        {{-- Chờ xét duyệt --}}
        <div class="col-md-3 mb-3">

            <div class="card border-warning h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Chờ xét duyệt
                    </h6>

                    <h3 class="text-warning mb-0">

                        {{
                            $applications->filter(function ($application) {
                                return strtolower($application->status) === 'pending';
                            })->count()
                        }}

                    </h3>

                </div>

            </div>

        </div>

        {{-- Đã duyệt --}}
        <div class="col-md-3 mb-3">

            <div class="card border-success h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Đã duyệt
                    </h6>

                    <h3 class="text-success mb-0">

                        {{
                            $applications->filter(function ($application) {
                                return strtolower($application->status) === 'approved';
                            })->count()
                        }}

                    </h3>

                </div>

            </div>

        </div>

        {{-- Từ chối --}}
        <div class="col-md-3 mb-3">

            <div class="card border-danger h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Từ chối
                    </h6>

                    <h3 class="text-danger mb-0">

                        {{
                            $applications->filter(function ($application) {
                                return strtolower($application->status) === 'rejected';
                            })->count()
                        }}

                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- Bảng danh sách --}}
    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Mã hồ sơ</th>
                <th>Sinh viên</th>
                <th>MSSV</th>
                <th>Chương trình học bổng</th>
                <th>Ngày nộp</th>
                <th>Trạng thái</th>
                <th>Ghi chú</th>
                <th width="230">Thao tác</th>

            </tr>

            </thead>

            <tbody>

            @forelse($applications as $application)

                <tr>

                    <td>
                        {{ $application->id }}
                    </td>

                    <td>
                        <strong>
                            {{ $application->application_code }}
                        </strong>
                    </td>

                    <td>

                        @if($application->student)

                            {{ $application->student->full_name }}

                        @else

                            <span class="text-danger">
                                Không xác định
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($application->student)

                            {{ $application->student->student_code }}

                        @else

                            -

                        @endif

                    </td>

                    <td>

                        @if($application->scholarshipProgram)

                            {{ $application->scholarshipProgram->name }}

                        @else

                            <span class="text-danger">
                                Không xác định
                            </span>

                        @endif

                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($application->apply_date)->format('d/m/Y') }}

                    </td>

                    <td>

                        {{-- Chuyển status về chữ thường để kiểm tra --}}
                        @php
                            $status = strtolower($application->status);
                        @endphp

                        @if($status === 'pending')

                            <span class="badge bg-warning text-dark">
                                Chờ xét duyệt
                            </span>

                        @elseif($status === 'approved')

                            <span class="badge bg-success">
                                Đã duyệt
                            </span>

                        @elseif($status === 'rejected')

                            <span class="badge bg-danger">
                                Từ chối
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                {{ $application->status }}
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($application->review_note)

                            {{ $application->review_note }}

                        @else

                            <span class="text-muted">
                                Chưa có ghi chú
                            </span>

                        @endif

                    </td>

                    <td>

                        <a
                            href="{{ route('applications.show', $application->id) }}"
                            class="btn btn-info btn-sm text-white">
                            Xem
                        </a>

                        <a
                            href="{{ route('applications.edit', $application->id) }}"
                            class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <form
                            action="{{ route('applications.destroy', $application->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc muốn xóa hồ sơ {{ $application->application_code }}? Nếu hồ sơ đã có minh chứng, điểm đánh giá hoặc kết quả xếp hạng thì hệ thống sẽ không cho phép xóa.')">

                                Xóa

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center py-5">

                        <div class="text-muted">

                            <div class="fs-1 mb-3">
                                📄
                            </div>

                            <h5>
                                Chưa có hồ sơ học bổng
                            </h5>

                            <p class="mb-3">
                                Hãy thêm hồ sơ đầu tiên để bắt đầu quản lý.
                            </p>

                            <a
                                href="{{ route('applications.create') }}"
                                class="btn btn-primary">

                                + Thêm hồ sơ

                            </a>

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>
```

</div>

@endsection
