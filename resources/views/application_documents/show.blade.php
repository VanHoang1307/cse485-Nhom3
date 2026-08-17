<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chi tiết minh chứng</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-4">

        <h2>Chi tiết minh chứng</h2>

        <a
            href="{{ route('application_documents.index') }}"
            class="btn btn-secondary"
        >
            Quay lại
        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <p>
                <strong>Đơn đăng ký:</strong>

                {{ $applicationDocument->application?->application_code ?? 'Không xác định' }}
            </p>

            <p>
                <strong>Loại minh chứng:</strong>

                {{ $applicationDocument->document_type }}
            </p>

            <p>
                <strong>Đường dẫn:</strong>

                {{ $applicationDocument->file_path }}
            </p>

            @if($applicationDocument->file_path)

                <a
                    href="{{ asset('storage/' . $applicationDocument->file_path) }}"
                    target="_blank"
                    class="btn btn-primary"
                >
                    Mở file minh chứng
                </a>

            @endif

        </div>

    </div>

</div>

</body>
</html>