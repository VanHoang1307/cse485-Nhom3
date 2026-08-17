@extends('layouts.app')

@section('title', 'Sửa minh chứng')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning d-flex justify-content-between align-items-center">

        <div>
            <h3 class="mb-1">
                Sửa minh chứng
            </h3>

            <small>
                Cập nhật thông tin và file minh chứng
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

        {{-- Thông báo lỗi --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <strong>Có lỗi xảy ra!</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            action="{{ route('application-documents.update', $applicationDocument) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="row">

                {{-- Hồ sơ học bổng --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Hồ sơ học bổng
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="application_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Chọn hồ sơ học bổng --
                        </option>

                        @foreach($applications as $application)

                            <option
                                value="{{ $application->id }}"
                                {{ old('application_id', $applicationDocument->application_id) == $application->id ? 'selected' : '' }}
                            >

                                {{ $application->application_code }}

                                @if($application->student)
                                    - {{ $application->student->full_name }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Loại minh chứng --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Loại minh chứng
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="document_type"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Chọn loại minh chứng --
                        </option>

                        <option
                            value="Bảng điểm"
                            {{ old('document_type', $applicationDocument->document_type) == 'Bảng điểm' ? 'selected' : '' }}
                        >
                            Bảng điểm
                        </option>

                        <option
                            value="Giấy xác nhận hoàn cảnh"
                            {{ old('document_type', $applicationDocument->document_type) == 'Giấy xác nhận hoàn cảnh' ? 'selected' : '' }}
                        >
                            Giấy xác nhận hoàn cảnh
                        </option>

                        <option
                            value="Giấy chứng nhận thành tích"
                            {{ old('document_type', $applicationDocument->document_type) == 'Giấy chứng nhận thành tích' ? 'selected' : '' }}
                        >
                            Giấy chứng nhận thành tích
                        </option>

                        <option
                            value="Chứng chỉ"
                            {{ old('document_type', $applicationDocument->document_type) == 'Chứng chỉ' ? 'selected' : '' }}
                        >
                            Chứng chỉ
                        </option>

                        <option
                            value="Khác"
                            {{ old('document_type', $applicationDocument->document_type) == 'Khác' ? 'selected' : '' }}
                        >
                            Khác
                        </option>

                    </select>

                </div>

            </div>

            {{-- File hiện tại --}}
            <div class="mb-3">

                <label class="form-label">
                    File hiện tại
                </label>

                <div class="border rounded p-3 bg-light">

                    @if($applicationDocument->file_path)

                        <div class="mb-2">

                            <strong>
                                📄 {{ $applicationDocument->document_name }}
                            </strong>

                        </div>

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
                    id="file"
                    class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png"
                >

                <div class="form-text">

                    Để trống nếu không muốn thay file.

                    Định dạng:
                    <strong>PDF, JPG, JPEG, PNG</strong>.

                    Tối đa:
                    <strong>5MB</strong>.

                </div>

                <div
                    id="fileName"
                    class="mt-2 text-muted"
                ></div>

            </div>

            <hr>

            <button
                type="submit"
                class="btn btn-warning"
            >
                Cập nhật
            </button>

            <a
                href="{{ route('application-documents.index') }}"
                class="btn btn-secondary"
            >
                Hủy
            </a>

        </form>

    </div>

</div>

@endsection

@push('scripts')

<script>

    const fileInput = document.getElementById('file');
    const fileName = document.getElementById('fileName');

    fileInput.addEventListener('change', function () {

        if (this.files.length > 0) {

            fileName.innerHTML =
                '📄 File mới: <strong>' +
                this.files[0].name +
                '</strong>';

        } else {

            fileName.innerHTML = '';

        }

    });

</script>

@endpush

