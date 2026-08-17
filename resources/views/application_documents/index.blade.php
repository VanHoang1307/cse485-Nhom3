<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý minh chứng</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-4">

    {{-- Tiêu đề --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                Quản lý minh chứng
            </h2>

            <p class="text-muted mb-0">
                Danh sách các minh chứng của hồ sơ học bổng
            </p>
        </div>

        <a
            href="{{ route('application_documents.create') }}"
            class="btn btn-primary"
        >
            + Thêm minh chứng
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


    {{-- Bảng dữ liệu --}}
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
                                Mã đơn
                            </th>

                            <th>
                                Loại minh chứng
                            </th>

                            <th>
                                File minh chứng
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

                        @forelse($documents as $document)

                            <tr>

                                {{-- STT --}}
                                <td>

                                    {{ $documents->firstItem() + $loop->index }}

                                </td>


                                {{-- Application --}}
                                <td>

                                    @if($document->application)

                                        <strong>
                                            {{ $document->application->application_code }}
                                        </strong>

                                    @else

                                        <span class="text-muted">
                                            Không xác định
                                        </span>

                                    @endif

                                </td>


                                {{-- Loại minh chứng --}}
                                <td>

                                    {{ $document->document_type }}

                                </td>


                                {{-- FILE --}}
                                <td>

                                    @if($document->file_path)

                                        <a
                                            href="{{ asset('storage/' . $document->file_path) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-primary"
                                        >
                                            📄 Xem file
                                        </a>

                                        <div class="small text-muted mt-1">

                                            {{ basename($document->file_path) }}

                                        </div>

                                    @else

                                        <span class="badge bg-secondary">

                                            Chưa có file

                                        </span>

                                    @endif

                                </td>


                                {{-- Ngày tạo --}}
                                <td>

                                    @if($document->created_at)

                                        {{ $document->created_at->format('d/m/Y H:i') }}

                                    @else

                                        -

                                    @endif

                                </td>


                                {{-- Thao tác --}}
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">


                                        {{-- Xem --}}
                                        <a
                                            href="{{ route('application_documents.show', $document) }}"
                                            class="btn btn-sm btn-info text-white"
                                        >
                                            Xem
                                        </a>


                                        {{-- Sửa --}}
                                        <a
                                            href="{{ route('application_documents.edit', $document) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Sửa
                                        </a>


                                        {{-- Xóa --}}
                                        <form
                                            action="{{ route('application_documents.destroy', $document) }}"
                                            method="POST"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa minh chứng này không?');"
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
                                    colspan="6"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <h5>
                                            Chưa có minh chứng
                                        </h5>

                                        <p class="mb-3">
                                            Hãy thêm minh chứng đầu tiên cho hồ sơ.
                                        </p>

                                        <a
                                            href="{{ route('application_documents.create') }}"
                                            class="btn btn-primary"
                                        >
                                            + Thêm minh chứng
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Phân trang --}}
    @if($documents->hasPages())

        <div class="d-flex justify-content-center mt-4">

            {{ $documents->links() }}

        </div>

    @endif


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>