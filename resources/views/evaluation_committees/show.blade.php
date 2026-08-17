@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chi tiết hội đồng xét duyệt</h2>

    <div class="card">
        <div class="card-body">
            <p>
                <strong>ID:</strong>
                {{ $evaluationCommittee->id }}
            </p>

            <p>
                <strong>Chương trình học bổng:</strong>
                {{ $evaluationCommittee->scholarshipProgram->name }}
            </p>

            <p>
                <strong>Tên hội đồng:</strong>
                {{ $evaluationCommittee->committee_name }}
            </p>

            <p>
                <strong>Chủ tịch:</strong>
                {{ $evaluationCommittee->chairman }}
            </p>

            <p>
                <strong>Ngày quyết định:</strong>
                {{ $evaluationCommittee->decision_date }}
            </p>

            <p>
                <strong>Trạng thái:</strong>
                {{ $evaluationCommittee->status }}
            </p>

            <p>
                <strong>Ngày tạo:</strong>
                {{ $evaluationCommittee->created_at }}
            </p>

            <p>
                <strong>Cập nhật:</strong>
                {{ $evaluationCommittee->updated_at }}
            </p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('evaluation-committees.edit', $evaluationCommittee) }}"
           class="btn btn-warning">
            Sửa
        </a>

        <a href="{{ route('evaluation-committees.index') }}"
           class="btn btn-secondary">
            Quay lại
        </a>
    </div>
</div>
@endsection