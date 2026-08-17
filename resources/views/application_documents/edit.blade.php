<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sửa minh chứng</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Sửa minh chứng</h2>

        <a
            href="{{ route('application_documents.index') }}"
            class="btn btn-secondary"
        >
            Quay lại
        </a>

    </div>

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card">

        <div class="card-body">

            <form
                action="{{ route('application_documents.update', $applicationDocument) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                {{-- Application --}}
                <div class="mb-3">

                    <label class="form-label">
                        Đơn đăng ký
                    </label>

                    <select
                        name="application_id"
                        class="form-select"
                        required
                    >

                        @foreach($applications as $application)

                            <option
                                value="{{ $application->id }}"
                                {{ old('application_id', $applicationDocument->application_id) == $application->id ? 'selected' : '' }}
                            >

                                {{ $application->application_code }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Document type --}}
                <div class="mb-3">

                    <label class="form-label">
                        Loại minh chứng
                    </label>

                    <input
                        type="text"
                        name="document_type"
                        class="form-control"
                        value="{{ old('document_type', $applicationDocument->document_type) }}"
                        required
                    >

                </div>


                {{-- File hiện tại --}}
                <div class="mb-3">

                    <label class="form-label">
                        File hiện tại
                    </label>

                    <div>

                        @if($applicationDocument->file_path)

                            <a
                                href="{{ asset('storage/' . $applicationDocument->file_path) }}"
                                target="_blank"
                                class="btn btn-outline-primary btn-sm"
                            >
                                Xem file hiện tại
                            </a>

                        @else

                            <span class="text-muted">
                                Chưa có file
                            </span>

                        @endif

                    </div>

                </div>


                {{-- File mới --}}
                <div class="mb-3">

                    <label class="form-label">
                        Chọn file mới
                    </label>

                    <input
                        type="file"
                        name="file"
                        class="form-control"
                        accept=".pdf,.jpg,.jpeg,.png"
                    >

                    <div class="form-text">

                        Để trống nếu không muốn thay file.
                        Tối đa 5MB.

                    </div>

                </div>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Cập nhật
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