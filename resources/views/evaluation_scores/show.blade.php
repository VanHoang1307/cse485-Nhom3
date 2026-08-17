<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chi tiết điểm đánh giá</title>

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
                Chi tiết điểm đánh giá
            </h2>

            <p class="text-muted mb-0">
                Thông tin chi tiết điểm đánh giá hồ sơ học bổng
            </p>
        </div>

        <a
            href="{{ route('evaluation-scores.index') }}"
            class="btn btn-secondary"
        >
            ← Quay lại
        </a>

    </div>


    {{-- Thông tin điểm --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-4 fw-bold">
                    Hồ sơ
                </div>

                <div class="col-md-8">

                    @if($evaluationScore->application)

                        {{ $evaluationScore->application->application_code }}

                    @else

                        <span class="text-muted">
                            Không xác định
                        </span>

                    @endif

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4 fw-bold">
                    Tiêu chí
                </div>

                <div class="col-md-8">

                    @if($evaluationScore->criterion)

                        {{ $evaluationScore->criterion->name }}

                    @else

                        <span class="text-muted">
                            Không xác định
                        </span>

                    @endif

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4 fw-bold">
                    Hội đồng đánh giá
                </div>

                <div class="col-md-8">

                    @if($evaluationScore->committee)

                        {{ $evaluationScore->committee->name }}

                    @else

                        <span class="text-muted">
                            Không xác định
                        </span>

                    @endif

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4 fw-bold">
                    Điểm
                </div>

                <div class="col-md-8">

                    <span class="badge bg-primary fs-6">
                        {{ $evaluationScore->score }}
                    </span>

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4 fw-bold">
                    Nhận xét
                </div>

                <div class="col-md-8">

                    {{ $evaluationScore->comment ?? 'Không có nhận xét' }}

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-4 fw-bold">
                    Ngày tạo
                </div>

                <div class="col-md-8">

                    {{ $evaluationScore->created_at
                        ? $evaluationScore->created_at->format('d/m/Y H:i')
                        : '-' }}

                </div>

            </div>


            <div class="row">

                <div class="col-md-4 fw-bold">
                    Cập nhật lần cuối
                </div>

                <div class="col-md-8">

                    {{ $evaluationScore->updated_at
                        ? $evaluationScore->updated_at->format('d/m/Y H:i')
                        : '-' }}

                </div>

            </div>

        </div>

    </div>


    {{-- Nút thao tác --}}
    <div class="mt-4">

        <a
            href="{{ route('evaluation-scores.edit', $evaluationScore) }}"
            class="btn btn-warning"
        >
            Sửa điểm
        </a>

        <form
            action="{{ route('evaluation-scores.destroy', $evaluationScore) }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirm('Bạn có chắc muốn xóa điểm này?');"
        >

            @csrf

            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger"
            >
                Xóa
            </button>

        </form>

        <a
            href="{{ route('evaluation-scores.index') }}"
            class="btn btn-secondary"
        >
            Quay lại danh sách
        </a>

    </div>

</div>

</body>
</html>