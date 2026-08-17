@extends('layouts.app')

@section('title', 'Sửa hội đồng xét duyệt')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h3 class="mb-0">Sửa hội đồng xét duyệt</h3>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('evaluation-committees.update', $evaluationCommittee) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Chương trình học bổng --}}
                <div class="mb-3">

                    <label class="form-label">
                        Chương trình học bổng
                    </label>

                    <select name="scholarship_program_id"
                            class="form-control"
                            required>

                        @foreach($programs as $program)

                            <option value="{{ $program->id }}"
                                {{ old(
                                    'scholarship_program_id',
                                    $evaluationCommittee->scholarship_program_id
                                ) == $program->id ? 'selected' : '' }}>

                                {{ $program->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Tên hội đồng --}}
                <div class="mb-3">

                    <label class="form-label">
                        Tên hội đồng
                    </label>

                    <input type="text"
                           name="committee_name"
                           class="form-control"
                           value="{{ old(
                               'committee_name',
                               $evaluationCommittee->committee_name
                           ) }}"
                           required>

                </div>

                {{-- Chủ tịch --}}
                <div class="mb-3">

                    <label class="form-label">
                        Chủ tịch hội đồng
                    </label>

                    <input type="text"
                           name="chairman"
                           class="form-control"
                           value="{{ old(
                               'chairman',
                               $evaluationCommittee->chairman
                           ) }}"
                           required>

                </div>

                {{-- Ngày quyết định --}}
                <div class="mb-3">

                    <label class="form-label">
                        Ngày quyết định
                    </label>

                    <input type="date"
                           name="decision_date"
                           class="form-control"
                           value="{{ old(
                               'decision_date',
                               $evaluationCommittee->decision_date
                           ) }}"
                           required>

                </div>

                {{-- Trạng thái --}}
                <div class="mb-3">

                    <label class="form-label">
                        Trạng thái
                    </label>

                    <select name="status"
                            class="form-control"
                            required>

                        <option value="active"
                            {{ old(
                                'status',
                                $evaluationCommittee->status
                            ) == 'active' ? 'selected' : '' }}>
                            Đang hoạt động
                        </option>

                        <option value="closed"
                            {{ old(
                                'status',
                                $evaluationCommittee->status
                            ) == 'closed' ? 'selected' : '' }}>
                            Đã đóng
                        </option>

                    </select>

                </div>

                <button type="submit"
                        class="btn btn-primary">
                    Cập nhật
                </button>

                <a href="{{ route('evaluation-committees.index') }}"
                   class="btn btn-secondary">
                    Quay lại
                </a>

            </form>

        </div>

    </div>

</div>

@endsection