@extends('layouts.app')

@section('title', 'Chi tiết minh chứng')

@section('content')

<div class="card shadow">

    {{-- Header --}}
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">

        <div>
            <h3 class="mb-1">
                Chi tiết minh chứng
            </h3>

            <small>
                Thông tin chi tiết của minh chứng hồ sơ học bổng
            </small>
        </div>

        <a
            href="{{ route('application-documents.index') }}"
            class="btn btn-light"
        >
            ← Quay lại
        </a>

    </div>

    <div class="card-body">

        {{-- Thông tin hồ sơ --}}
        <div class="row">

            {{-- Hồ sơ --}}
            <div class="col-md-6 mb-4">

                <div class="card border-primary h-100">

                    <div class="card-body">

                        <h5 class="card-title text-primary">
                            Hồ sơ học bổng
                        </h5>

                        <hr>

                        <p class="mb-2">

                            <strong>Mã hồ sơ:</strong>

                            @if($applicationDocument->application)

                                {{ $applicationDocument->application->application_code }}

                            @else

                                <span class="text-danger">
                                    Không xác định
                                </span>

                            @endif

                        </p>

                        @if($applicationDocument->application?->student)

                            <p class="mb-2">

                                <strong>Sinh viên:</strong>

                                {{ $applicationDocument->application->student->full_name }}

                            </p>

                            <p class="mb-0">

                                <strong>MSSV:</strong>

                                {{ $applicationDocument->application->student->student_code }}

                            </p>

                        @endif

                    </div>

                </div>

            </div>

            {{-- Thông tin minh chứng --}}
            <div class="col-md-6 mb-4">

                <div class="card border-success h-100">

                    <div class="card-body">

                        <h5 class="card-title text-success">
                            Thông tin minh chứng
                        </h5>

                        <hr>

                        <p class="mb-2">

                            <strong>Tên file:</strong>

                            {{ $applicationDocument->document_name }}

                        </p>

                        <p class="mb-2">

                            <strong>Loại minh chứng:</strong>

                            {{ $applicationDocument->document_type }}

                        </p>

                        <p class="mb-0">

                            <strong>Trạng thái:</strong>

                            @if($applicationDocument->verification_status === 'Pending')

                                <span class="badge bg-warning text-dark">
                                    Chờ xác minh
                                </span>

                            @elseif($applicationDocument->verification_status === 'Approved')

                                <span class="badge bg-success">
                                    Đã xác minh
                                </span>

                            @elseif($applicationDocument->verification_status === 'Rejected')

                                <span class="badge bg-danger">
                                    Từ chối
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ $applicationDocument->verification_status }}
                                </span>

                            @endif

                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- File minh chứng --}}
        <div class="card border-secondary mb-4">

            <div class="card-body">

                <h5 class="card-title">
                    📄 File minh chứng
                </h5>

                <hr>

                @if($applicationDocument->file_path)

                    <p class="text-muted mb-3">

                        {{ basename($applicationDocument->file_path) }}

                    </p>

                    <a
                        href="{{ asset('storage/' . $applicationDocument->file_path) }}"
                        target="_blank"
                        class="btn btn-primary"
                    >
                        📄 Mở file minh chứng
                    </a>

                @else

                    <div class="alert alert-secondary mb-0">
                        Chưa có file minh chứng.
                    </div>

                @endif

            </div>

        </div>

        {{-- Thời gian --}}
        <div class="row">

            <div class="col-md-6 mb-3">

                <div class="card bg-light">

                    <div class="card-body">

                        <strong>Ngày tạo:</strong>

                        <span class="ms-2">

                            {{ $applicationDocument->created_at?->format('d/m/Y H:i') ?? '-' }}

                        </span>

                    </div>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <div class="card bg-light">

                    <div class="card-body">

                        <strong>Cập nhật lần cuối:</strong>

                        <span class="ms-2">

                            {{ $applicationDocument->updated_at?->format('d/m/Y H:i') ?? '-' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

        <hr>

        {{-- Nút thao tác --}}
        <div class="d-flex gap-2">

            <a
                href="{{ route('application-documents.edit', $applicationDocument) }}"
                class="btn btn-warning"
            >
                Sửa
            </a>

            @if($applicationDocument->file_path)

                <a
                    href="{{ asset('storage/' . $applicationDocument->file_path) }}"
                    target="_blank"
                    class="btn btn-primary"
                >
                    📄 Mở file
                </a>

            @endif

            <form
                action="{{ route('application-documents.destroy', $applicationDocument) }}"
                method="POST"
                onsubmit="return confirm('Bạn có chắc chắn muốn xóa minh chứng này không?');"
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
                href="{{ route('application-documents.index') }}"
                class="btn btn-secondary"
            >
                Quay lại danh sách
            </a>

        </div>

    </div>

</div>

@endsection

