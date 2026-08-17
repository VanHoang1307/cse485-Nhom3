<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật hồ sơ học bổng</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning">

            <h3>Cập nhật hồ sơ xét học bổng</h3>

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

            <form action="{{ route('applications.update',$application->id) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="row">

                    <!-- Sinh viên -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Sinh viên
                        </label>

                        <select
                            name="student_id"
                            class="form-select"
                            required>

                            @foreach($students as $student)

                                <option
                                    value="{{ $student->id }}"
                                    {{ old('student_id',$application->student_id)==$student->id ? 'selected' : '' }}>

                                    {{ $student->student_code }}
                                    -
                                    {{ $student->full_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Chương trình học bổng -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            ID Chương trình học bổng

                        </label>

                        <input
                            type="number"
                            name="scholarship_program_id"
                            class="form-control"
                            value="{{ old('scholarship_program_id',$application->scholarship_program_id) }}"
                            required>

                    </div>

                    <!-- Mã hồ sơ -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Mã hồ sơ

                        </label>

                        <input
                            type="text"
                            name="application_code"
                            class="form-control"
                            value="{{ old('application_code',$application->application_code) }}"
                            required>

                    </div>

                    <!-- Ngày nộp -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Ngày nộp hồ sơ

                        </label>

                        <input
                            type="date"
                            name="apply_date"
                            class="form-control"
                            value="{{ old('apply_date',$application->apply_date) }}"
                            required>

                    </div>

                    <!-- Trạng thái -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Trạng thái

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option
                                value="Pending"
                                {{ old('status',$application->status)=='Pending' ? 'selected' : '' }}>

                                Pending

                            </option>

                            <option
                                value="Approved"
                                {{ old('status',$application->status)=='Approved' ? 'selected' : '' }}>

                                Approved

                            </option>

                            <option
                                value="Rejected"
                                {{ old('status',$application->status)=='Rejected' ? 'selected' : '' }}>

                                Rejected

                            </option>

                        </select>

                    </div>

                    <!-- Ghi chú -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Ghi chú

                        </label>

                        <textarea
                            name="review_note"
                            rows="3"
                            class="form-control">{{ old('review_note',$application->review_note) }}</textarea>

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

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>