<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <title>Thêm hồ sơ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h3>Thêm hồ sơ học bổng</h3>

</div>

<div class="card-body">

@if($errors->any())

<div class="alert alert-danger">

<ul>

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form action="{{ route('applications.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Sinh viên</label>

<select
    name="student_id"
    class="form-select"
    required>

<option value="">-- Chọn sinh viên --</option>

@foreach($students as $student)

<option value="{{ $student->id }}">

{{ $student->student_code }}

-

{{ $student->full_name }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>ID Chương trình học bổng</label>

<input
type="number"
name="scholarship_program_id"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Mã hồ sơ</label>

<input
type="text"
name="application_code"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Ngày nộp</label>

<input
type="date"
name="apply_date"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Trạng thái</label>

<select
name="status"
class="form-select">

<option value="Pending">

Pending

</option>

<option value="Approved">

Approved

</option>

<option value="Rejected">

Rejected

</option>

</select>

</div>

<div class="mb-3">

<label>Ghi chú</label>

<textarea
name="review_note"
class="form-control">

</textarea>

</div>

<button
type="submit"
class="btn btn-success">

Lưu hồ sơ

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

</body>

</html>