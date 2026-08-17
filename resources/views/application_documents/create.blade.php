@extends('layouts.app')

@section('title', 'Thêm minh chứng')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <div>
            <h3 class="mb-1">
                Thêm minh chứng
            </h3>

            <small>
                Upload minh chứng cho hồ sơ học bổng
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
            action="{{ route('application-documents.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

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
                                {{ old('application_id') == $application->id ? 'selected' : '' }}
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
                            {{ old('document_type') == 'Bảng điểm' ? 'selected' : '' }}
                        >
                            Bảng điểm
                        </option>

                        <option
                            value="Giấy xác nhận hoàn cảnh"
                            {{ old('document_type') == 'Giấy xác nhận hoàn cảnh' ? 'selected' : '' }}
                        >
                            Giấy xác nhận hoàn cảnh
                        </option>

                        <option
                            value="Giấy chứng nhận thành tích"
                            {{ old('document_type') == 'Giấy chứng nhận thành tích' ? 'selected' : '' }}
                        >
                            Giấy chứng nhận thành tích
                        </option>

                        <option
                            value="Chứng chỉ"
                            {{ old('document_type') == 'Chứng chỉ' ? 'selected' : '' }}
                        >
                            Chứng chỉ
                        </option>

                        <option
                            value="Khác"
                            {{ old('document_type') == 'Khác' ? 'selected' : '' }}
                        >
                            Khác
                        </option>

                    </select>

                </div>

                {{-- Trạng thái xác minh --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Trạng thái xác minh
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="verification_status"
                        class="form-select"
                        required
                    >

                        <option
                            value="Pending"
                            {{ old('verification_status', 'Pending') === 'Pending' ? 'selected' : '' }}
                        >
                            Chờ xác minh
                        </option>

                        <option
                            value="Approved"
                            {{ old('verification_status') === 'Approved' ? 'selected' : '' }}
                        >
                            Đã xác minh
                        </option>

                        <option
                            value="Rejected"
                            {{ old('verification_status') === 'Rejected' ? 'selected' : '' }}
                        >
                            Từ chối
                        </option>

                    </select>

                    <div class="form-text">
                        Minh chứng mới mặc định ở trạng thái "Chờ xác minh".
                    </div>

                </div>

                {{-- File minh chứng --}}
                <div class="col-md-6 mb-3">

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
                        Chấp nhận PDF, JPG, JPEG, PNG. Dung lượng tối đa 5MB.
                    </div>

                </div>

            </div>

            <hr>

            <button
                type="submit"
                class="btn btn-success"
            >
                Upload và lưu
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

