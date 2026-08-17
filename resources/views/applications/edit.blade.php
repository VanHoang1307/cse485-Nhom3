@extends('layouts.app')

@section('title', 'Cập nhật hồ sơ học bổng')

@section('content')

<div class="card shadow">

```
<div class="card-header bg-warning d-flex justify-content-between align-items-center">

    <h3 class="mb-0">
        Cập nhật hồ sơ xét học bổng
    </h3>

    <a href="{{ route('applications.index') }}"
       class="btn btn-light">

        ← Quay lại

    </a>

</div>

<div class="card-body">

    {{-- Hiển thị lỗi --}}
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

    <form action="{{ route('applications.update', $application->id) }}"
          method="POST">

        @csrf
        @method('PUT')

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
                            {{ old('student_id', $application->student_id) == $student->id ? 'selected' : '' }}>

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
                            {{ old('scholarship_program_id', $application->scholarship_program_id) == $scholarship->id ? 'selected' : '' }}>

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
                    value="{{ old('application_code', $application->application_code) }}"
                    placeholder="VD: APP001"
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
                    value="{{ old('apply_date', $application->apply_date) }}"
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

                    <option
                        value="Pending"
                        {{ old('status', $application->status) == 'Pending' ? 'selected' : '' }}>

                        Chờ xét duyệt

                    </option>

                    <option
                        value="Approved"
                        {{ old('status', $application->status) == 'Approved' ? 'selected' : '' }}>

                        Đã duyệt

                    </option>

                    <option
                        value="Rejected"
                        {{ old('status', $application->status) == 'Rejected' ? 'selected' : '' }}>

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
                    rows="3"
                    maxlength="1000"
                    class="form-control"
                    placeholder="Nhập ghi chú nếu có...">{{ old('review_note', $application->review_note) }}</textarea>

            </div>

        </div>

        <hr>

        <button
            type="submit"
            class="btn btn-warning">

            Cập nhật

        </button>

        <a
            href="{{ route('applications.index') }}"
            class="btn btn-secondary">

            Quay lại

        </a>

    </form>

</div>
```

</div>

@endsection
@extends('layouts.app')

@section('title', 'Cập nhật hồ sơ học bổng')

@section('content')

<div class="card shadow">

```
<div class="card-header bg-warning d-flex justify-content-between align-items-center">

    <h3 class="mb-0">
        Cập nhật hồ sơ xét học bổng
    </h3>

    <a href="{{ route('applications.index') }}"
       class="btn btn-light">

        ← Quay lại

    </a>

</div>

<div class="card-body">

    {{-- Hiển thị lỗi --}}
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

    <form action="{{ route('applications.update', $application->id) }}"
          method="POST">

        @csrf
        @method('PUT')

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
                            {{ old('student_id', $application->student_id) == $student->id ? 'selected' : '' }}>

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
                            {{ old('scholarship_program_id', $application->scholarship_program_id) == $scholarship->id ? 'selected' : '' }}>

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
                    value="{{ old('application_code', $application->application_code) }}"
                    placeholder="VD: APP001"
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
                    value="{{ old('apply_date', $application->apply_date) }}"
                    required>

            </div>

            {{-- Trạng thái --}}
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Trạng thái <span class="text-danger">*</span>
                </label>

                @php
                    $currentStatus = strtolower(
                        old('status', $application->status)
                    );
                @endphp

                <select
                    name="status"
                    class="form-select"
                    required>

                    <option
                        value="pending"
                        {{ $currentStatus === 'pending' ? 'selected' : '' }}>

                        Chờ xét duyệt

                    </option>

                    <option
                        value="approved"
                        {{ $currentStatus === 'approved' ? 'selected' : '' }}>

                        Đã duyệt

                    </option>

                    <option
                        value="rejected"
                        {{ $currentStatus === 'rejected' ? 'selected' : '' }}>

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
                    rows="3"
                    maxlength="1000"
                    class="form-control"
                    placeholder="Nhập ghi chú nếu có...">{{ old('review_note', $application->review_note) }}</textarea>

            </div>

        </div>

        <hr>

        <button
            type="submit"
            class="btn btn-warning">

            Cập nhật

        </button>

        <a
            href="{{ route('applications.index') }}"
            class="btn btn-secondary">

            Quay lại

        </a>

    </form>

</div>
```

</div>

@endsection
