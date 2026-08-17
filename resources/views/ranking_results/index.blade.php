<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kết quả xếp hạng</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                Kết quả xếp hạng
            </h2>

            <p class="text-muted mb-0">
                Quản lý kết quả xếp hạng hồ sơ học bổng
            </p>
        </div>

        <a
            href="{{ route('ranking-results.create') }}"
            class="btn btn-primary"
        >
            + Thêm kết quả
        </a>

    </div>

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

    <div class="card shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th style="width: 70px;">
                                STT
                            </th>

                            <th>
                                Hồ sơ
                            </th>

                            <th>
                                Tổng điểm
                            </th>

                            <th>
                                Thứ hạng
                            </th>

                            <th>
                                Kết quả
                            </th>

                            <th>
                                Ngày tạo
                            </th>

                            <th
                                style="width: 240px;"
                                class="text-center"
                            >
                                Thao tác
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($results as $result)

                        <tr>

                            <td>
                                {{ $results->firstItem() + $loop->index }}
                            </td>

                            <td>

                                @if($result->application)

                                    <strong>
                                        {{ $result->application->application_code }}
                                    </strong>

                                @else

                                    <span class="text-muted">
                                        Không xác định
                                    </span>

                                @endif

                            </td>

                            <td>

                                <strong>
                                    {{ number_format($result->total_score, 2) }}
                                </strong>

                            </td>

                            <td>

                                <span class="badge bg-primary">

                                    Hạng {{ $result->ranking }}

                                </span>

                            </td>

                            <td>

                                @if($result->result === 'Qualified')

                                    <span class="badge bg-success">
                                        Đạt
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Không đạt
                                    </span>

                                @endif

                            </td>

                            <td>

                                @if($result->created_at)

                                    {{ $result->created_at->format('d/m/Y H:i') }}

                                @else

                                    -

                                @endif

                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-1">

                                    <a
                                        href="{{ route('ranking-results.show', $result) }}"
                                        class="btn btn-sm btn-info text-white"
                                    >
                                        Xem
                                    </a>

                                    <a
                                        href="{{ route('ranking-results.edit', $result) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Sửa
                                    </a>

                                    <form
                                        action="{{ route('ranking-results.destroy', $result) }}"
                                        method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa kết quả này không?');"
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

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5"
                            >

                                <h5 class="text-muted">
                                    Chưa có kết quả xếp hạng
                                </h5>

                                <p class="text-muted mb-3">
                                    Hãy thêm kết quả xếp hạng đầu tiên.
                                </p>

                                <a
                                    href="{{ route('ranking-results.create') }}"
                                    class="btn btn-primary"
                                >
                                    + Thêm kết quả
                                </a>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    @if($results->hasPages())

        <div class="d-flex justify-content-center mt-4">

            {{ $results->links() }}

        </div>

    @endif

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>