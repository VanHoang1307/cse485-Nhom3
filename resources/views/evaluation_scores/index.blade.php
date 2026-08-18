<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chấm điểm hồ sơ</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container py-4">

    {{-- Tiêu đề --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                Chấm điểm hồ sơ
            </h2>

            <p class="text-muted mb-0">
                Quản lý điểm đánh giá học bổng
            </p>
        </div>

        <a
            href="{{ route('evaluation-scores.create') }}"
            class="btn btn-primary"
        >
            + Thêm điểm
        </a>
    </div>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif

    {{-- Thông báo lỗi --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Có lỗi xảy ra:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Bảng điểm --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            @if($scores->count())

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle mb-0">

                        <thead class="table-primary">
                            <tr>
                                <th style="width: 60px;">
                                    STT
                                </th>

                                <th>
                                    Hồ sơ
                                </th>

                                <th>
                                    Sinh viên
                                </th>

                                <th>
                                    Tiêu chí
                                </th>

                                <th>
                                    Hội đồng
                                </th>

                                <th style="width: 100px;">
                                    Điểm
                                </th>

                                <th>
                                    Nhận xét
                                </th>

                                <th
                                    style="width: 210px;"
                                    class="text-center"
                                >
                                    Thao tác
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($scores as $score)

                                <tr>

                                    {{-- STT --}}
                                    <td>
                                        {{ $scores->firstItem() + $loop->index }}
                                    </td>

                                    {{-- Hồ sơ --}}
                                    <td>
                                        @if($score->application)
                                            <strong>
                                                {{ $score->application->application_code }}
                                            </strong>
                                        @else
                                            <span class="text-muted">
                                                Không xác định
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Sinh viên --}}
                                    <td>
                                        @if(
                                            $score->application &&
                                            $score->application->student
                                        )
                                            {{ $score->application->student->full_name }}
                                        @else
                                            <span class="text-muted">
                                                Không xác định
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Tiêu chí --}}
                                    <td>
                                        @if($score->criterion)
                                            {{ $score->criterion->criteria_name }}
                                        @else
                                            <span class="text-muted">
                                                Không xác định
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Hội đồng --}}
                                    <td>
                                        @if($score->committee)
                                            {{ $score->committee->committee_name }}
                                        @else
                                            <span class="text-muted">
                                                Không xác định
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Điểm --}}
                                    <td>
                                        <span class="badge bg-success fs-6">
                                            {{ number_format((float) $score->score, 2) }}
                                        </span>
                                    </td>

                                    {{-- Nhận xét --}}
                                    <td>
                                        @if($score->comment)
                                            {{ $score->comment }}
                                        @else
                                            <span class="text-muted">
                                                Không có
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Thao tác --}}
                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-1">

                                            {{-- Xem --}}
                                            <a
                                                href="{{ route('evaluation-scores.show', $score) }}"
                                                class="btn btn-sm btn-info text-white"
                                            >
                                                Xem
                                            </a>

                                            {{-- Sửa --}}
                                            <a
                                                href="{{ route('evaluation-scores.edit', $score) }}"
                                                class="btn btn-sm btn-warning"
                                            >
                                                Sửa
                                            </a>

                                            {{-- Xóa --}}
                                            <form
                                                action="{{ route('evaluation-scores.destroy', $score) }}"
                                                method="POST"
                                                onsubmit="return confirm('Bạn có chắc muốn xóa điểm này?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-danger"
                                                >
                                                    Xóa
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Phân trang --}}
                @if($scores->hasPages())
                    <div class="d-flex justify-content-center p-3">
                        {{ $scores->links() }}
                    </div>
                @endif

            @else

                <div class="text-center py-5">

                    <h5 class="text-muted">
                        Chưa có điểm đánh giá
                    </h5>

                    <p class="text-muted">
                        Hãy thêm điểm đánh giá đầu tiên cho hồ sơ.
                    </p>

                    <a
                        href="{{ route('evaluation-scores.create') }}"
                        class="btn btn-primary"
                    >
                        + Thêm điểm
                    </a>

                </div>

            @endif

        </div>
    </div>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>