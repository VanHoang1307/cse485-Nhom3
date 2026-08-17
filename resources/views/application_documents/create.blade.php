<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Thêm minh chứng</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Thêm minh chứng</h2>

        <a
            href="{{ route('application_documents.index') }}"
            class="btn btn-secondary"
        >
            Quay lại
        </a>

    </div>

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

    <div class="card">

        <div class="card-body">

            <form
                action="{{ route('application_documents.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                {{-- Đơn đăng ký --}}
                <div class="mb-3">

                    <label class="form-label">
                        Đơn đăng ký
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="application_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Chọn đơn đăng ký --
                        </option>

                        @foreach($applications as $application)

                            <option
                                value="{{ $application->id }}"
                                {{ old('application_id') == $application->id ? 'selected' : '' }}
                            >
                                {{ $application->application_code }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Loại minh chứng --}}
                <div class="mb-3">

                    <label class="form-label">
                        Loại minh chứng
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="document_type"
                        class="form-control"
                        value="{{ old('document_type') }}"
                        placeholder="Ví dụ: Bảng điểm"
                        required
                    >

                </div>


                {{-- Upload file --}}
                <div class="mb-3">

                    <label class="form-label">
                        File minh chứng
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="file"
                        name="file"
                        class="form-control"
                        accept=".pdf,.jpg,.jpeg,.png"
                        required
                    >

                    <div class="form-text">

                        Chấp nhận:
                        PDF, JPG, JPEG, PNG.
                        Dung lượng tối đa 5MB.

                    </div>

                </div>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Upload và lưu
                </button>

                <a
                    href="{{ route('application_documents.index') }}"
                    class="btn btn-secondary"
                >
                    Hủy
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>