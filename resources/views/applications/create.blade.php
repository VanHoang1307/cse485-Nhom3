@extends('layouts.app')

@section('title', 'Thêm hồ sơ học bổng')

@section('content')

<div class="card shadow">

```
<div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

    <h3 class="mb-0">
        Thêm hồ sơ xét học bổng
    </h3>

    <a href="{{ route('applications.index') }}"
       class="btn btn-light">

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

    <form action="{{ route('applications.store') }}" method="POST">

        @csrf

        <div class="row">

            {{-- Sinh viên --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Sinh viên <span class="text-danger">*</span>
                </label>

                <select
                    name="student_id"
                    class="form-select"
                    required>

                    <option value="">
                        -- Chọn sinh viên --
                    </option>

                    @foreach($students as $student)

                        <option
                            value="{{ $student->id }}"
                            {{ old('student_id') == $student->id ? 'selected' : '' }}>

                            {{ $student->student_code }}
                            -
                            {{ $student->full_name }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Chương trình học bổng --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Chương trình học bổng <span class="text-danger">*</span>
                </label>

                <select
                    name="scholarship_program_id"
                    class="form-select"
                    required>

                    <option value="">
                        -- Chọn chương trình học bổng --
                    </option>

                    @foreach($scholarships as $scholarship)

                        <option
                            value="{{ $scholarship->id }}"
                            {{ old('scholarship_program_id') == $scholarship->id ? 'selected' : '' }}>

                            {{ $scholarship->name }}
                            -
                            {{ number_format($scholarship->amount) }} VNĐ

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Mã hồ sơ --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Mã hồ sơ <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="application_code"
                    class="form-control"
                    value="{{ old('application_code') }}"
                    placeholder="VD: APP011"
                    maxlength="50"
                    required>

                <small class="text-muted">
                    Mã hồ sơ phải là duy nhất.
                </small>

            </div>

            {{-- Ngày nộp --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Ngày nộp hồ sơ <span class="text-danger">*</span>
                </label>

                <input
                    type="date"
                    name="apply_date"
                    class="form-control"
                    value="{{ old('apply_date', date('Y-m-d')) }}"
                    required>

            </div>

            {{-- Trạng thái --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Trạng thái <span class="text-danger">*</span>
                </label>

                <select
                    name="status"
                    class="form-select"
                    required>

                    <option value="">
                        -- Chọn trạng thái --
                    </option>

                    <option
                        value="pending"
                        {{ old('status') == 'pending' ? 'selected' : '' }}>

                        Chờ xét duyệt

                    </option>

                    <option
                        value="approved"
                        {{ old('status') == 'approved' ? 'selected' : '' }}>

                        Đã duyệt

                    </option>

                    <option
                        value="rejected"
                        {{ old('status') == 'rejected' ? 'selected' : '' }}>

                        Từ chối

                    </option>

                </select>

            </div>

            {{-- Ghi chú --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Ghi chú
                </label>

                <textarea
                    name="review_note"
                    class="form-control"
                    rows="3"
                    maxlength="1000"
                    placeholder="Nhập ghi chú nếu có...">{{ old('review_note') }}</textarea>

            </div>

        </div>

        <hr>

        <button
            type="submit"
            class="btn btn-success">

            Lưu hồ sơ

        </button>

        <a
            href="{{ route('applications.index') }}"
            class="btn btn-secondary">

            Hủy

        </a>

    </form>

</div>
```

</div>

@endsection
