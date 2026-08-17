@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm hội đồng xét duyệt</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evaluation-committees.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Chương trình học bổng</label>
            <select name="scholarship_program_id" class="form-control" required>
                <option value="">-- Chọn chương trình --</option>

                @foreach($programs as $program)
                    <option value="{{ $program->id }}"
                        {{ old('scholarship_program_id') == $program->id ? 'selected' : '' }}>
                        {{ $program->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên hội đồng</label>
            <input type="text"
                   name="committee_name"
                   class="form-control"
                   value="{{ old('committee_name') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Chủ tịch hội đồng</label>
            <input type="text"
                   name="chairman"
                   class="form-control"
                   value="{{ old('chairman') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày quyết định</label>
            <input type="date"
                   name="decision_date"
                   class="form-control"
                   value="{{ old('decision_date') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control" required>
                <option value="">-- Chọn trạng thái --</option>

                <option value="active"
                    {{ old('status') == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="closed"
                    {{ old('status') == 'closed' ? 'selected' : '' }}>
                    Closed
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Lưu
        </button>

        <a href="{{ route('evaluation-committees.index') }}"
           class="btn btn-secondary">
            Quay lại
        </a>
    </form>
</div>
@endsection