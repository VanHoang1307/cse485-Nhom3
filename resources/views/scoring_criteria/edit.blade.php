@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sửa tiêu chí chấm điểm</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('scoring-criteria.update', $scoringCriterion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Chương trình học bổng</label>
            <select name="scholarship_program_id" class="form-control" required>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}"
                        {{ old('scholarship_program_id', $scoringCriterion->scholarship_program_id) == $program->id ? 'selected' : '' }}>
                        {{ $program->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên tiêu chí</label>
            <input type="text"
                   name="criteria_name"
                   class="form-control"
                   value="{{ old('criteria_name', $scoringCriterion->criteria_name) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Điểm tối đa</label>
            <input type="number"
                   name="max_score"
                   class="form-control"
                   step="0.01"
                   min="0"
                   max="100"
                   value="{{ old('max_score', $scoringCriterion->max_score) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Trọng số (%)</label>
            <input type="number"
                   name="weight"
                   class="form-control"
                   step="0.01"
                   min="0"
                   max="100"
                   value="{{ old('weight', $scoringCriterion->weight) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $scoringCriterion->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Cập nhật
        </button>

        <a href="{{ route('scoring-criteria.index') }}"
           class="btn btn-secondary">
            Quay lại
        </a>
    </form>
</div>
@endsection