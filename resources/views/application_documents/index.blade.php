@extends('layouts.app')

@section('title', 'Quản lý minh chứng')

@section('content')

<div class="card shadow">

    {{-- Header --}}
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <div>
            <h3 class="mb-1">
                Quản lý minh chứng
            </h3>

            <small>
                Danh sách các minh chứng của hồ sơ học bổng
            </small>
        </div>

        <div>

            <a
                href="{{ route('applications.index') }}"
                class="btn btn-light me-2"
            >
                📋 Hồ sơ học bổng
            </a>

            <a
                href="{{ route('application-documents.create') }}"
                class="btn btn-success"
            >
                + Thêm minh chứng
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
                    data-bs-dismiss="alert"
                ></button>

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
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif

        {{-- Thống kê --}}
        <div class="row mb-4">

            <div class="col-md-3 mb-3">

                <div class="card border-primary h-100">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Tổng minh chứng
                        </h6>

                        <h3 class="text-primary mb-0">
                            {{ $documents->total() }}
                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="card border-warning h-100">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Chờ xác minh
                        </h6>

                        <h3 class="text-warning mb-0">

                            {{ $documents->where('verification_status', 'Pending')->count() }}

                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="card border-success h-100">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Đã xác minh
                        </h6>

                        <h3 class="text-success mb-0">

                            {{ $documents->where('verification_status', 'Approved')->count() }}

                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="card border-danger h-100">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Từ chối
                        </h6>

                        <h3 class="text-danger mb-0">

                            {{ $documents->where('verification_status', 'Rejected')->count() }}

                        </h3>

                    </div>

                </div>

            </div>

        </div>

        {{-- Bảng dữ liệu --}}
        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th style="width: 70px;">
                            STT
                        </th>

                        <th>
                            Mã hồ sơ
                        </th>

                        <th>
                            Tên minh chứng
                        </th>

                        <th>
                            Loại minh chứng
                        </th>

                        <th>
                            File
                        </th>

                        <th>
                            Trạng thái xác minh
                        </th>

                        <th>
                            Ngày tạo
                        </th>

                        <th
                            style="width: 250px;"
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

                            {{-- Mã hồ sơ --}}
                            <td>

                                @if($document->application)

                                    <strong>
                                        {{ $document->application->application_code }}
                                    </strong>

                                @else

                                    <span class="text-danger">
                                        Không xác định
                                    </span>

                                @endif

                            </td>

                            {{-- Tên minh chứng --}}
                            <td>

                                {{ $document->document_name }}

                            </td>

                            {{-- Loại minh chứng --}}
                            <td>

                                {{ $document->document_type }}

                            </td>

                            {{-- File --}}
                            <td>

                                @if($document->file_path)

                                    <a
                                        href="{{ asset('storage/' . $document->file_path) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-primary"
                                    >
                                        📄 Xem file
                                    </a>

                                @else

                                    <span class="badge bg-secondary">
                                        Chưa có file
                                    </span>

                                @endif

                            </td>

                            {{-- Trạng thái --}}
                            <td>

                                @if($document->verification_status === 'Pending')

                                    <span class="badge bg-warning text-dark">
                                        Chờ xác minh
                                    </span>

                                @elseif($document->verification_status === 'Approved')

                                    <span class="badge bg-success">
                                        Đã xác minh
                                    </span>

                                @elseif($document->verification_status === 'Rejected')

                                    <span class="badge bg-danger">
                                        Từ chối
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ $document->verification_status }}
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

                                    <a
                                        href="{{ route('application-documents.show', $document) }}"
                                        class="btn btn-sm btn-info text-white"
                                    >
                                        Xem
                                    </a>

                                    <a
                                        href="{{ route('application-documents.edit', $document) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Sửa
                                    </a>

                                    <form
                                        action="{{ route('application-documents.destroy', $document) }}"
                                        method="POST"
                                        class="d-inline"
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
                                colspan="8"
                                class="text-center py-5"
                            >

                                <div class="text-muted">

                                    <div class="fs-1 mb-3">
                                        📄
                                    </div>

                                    <h5>
                                        Chưa có minh chứng
                                    </h5>

                                    <p class="mb-3">
                                        Hãy thêm minh chứng đầu tiên cho hồ sơ.
                                    </p>

                                    <a
                                        href="{{ route('application-documents.create') }}"
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

        {{-- Phân trang --}}
        @if($documents->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $documents->links() }}

            </div>

        @endif

    </div>

</div>

@endsection

