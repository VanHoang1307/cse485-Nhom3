@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chi tiết tiêu chí chấm điểm</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $scoringCriterion->id }}</p>

            <p>
                <strong>Chương trình học bổng:</strong>
                {{ $scoringCriterion->scholarshipProgram->name }}
            </p>

            <p>
                <strong>Tên tiêu chí:</strong>
                {{ $scoringCriterion->criteria_name }}
            </p>

            <p>
                <strong>Điểm tối đa:</strong>
                {{ $scoringCriterion->max_score }}
            </p>

            <p>
                <strong>Trọng số:</strong>
                {{ $scoringCriterion->weight }}%
            </p>

            <p>
                <strong>Mô tả:</strong>
                {{ $scoringCriterion->description ?? 'Không có' }}
            </p>

            <p>
                <strong>Ngày tạo:</strong>
                {{ $scoringCriterion->created_at }}
            </p>

            <p>
                <strong>Cập nhật:</strong>
                {{ $scoringCriterion->updated_at }}
            </p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('scoring-criteria.edit', $scoringCriterion) }}"
           class="btn btn-warning">
            Sửa
        </a>

        <a href="{{ route('scoring-criteria.index') }}"
           class="btn btn-secondary">
            Quay lại
        </a>
    </div>
</div>
@endsection