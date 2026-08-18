@extends('layouts.app')

@section('title', 'Thêm điều kiện xét duyệt')

@section('content')

<div class="container py-4">

    <div class="card shadow">

        <div class="card-header bg-secondary text-white">
            <h3 class="mb-0">
                Thêm điều kiện xét duyệt
            </h3>
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

            <form action="{{ route('eligibility-rules.store') }}" method="POST">

                @csrf

                {{-- Chương trình học bổng --}}
                <div class="mb-3">
                    <label class="form-label">
                        Chương trình học bổng <span class="text-danger">*</span>
                    </label>

                    <select
                        name="scholarship_program_id"
                        class="form-select"
                        required
                    >
                        <option value="">
                            -- Chọn chương trình học bổng --
                        </option>

                        @foreach($scholarshipPrograms as $program)
                            <option
                                value="{{ $program->id }}"
                                {{ old('scholarship_program_id') == $program->id ? 'selected' : '' }}
                            >
                                {{ $program->name }}
                                - {{ $program->academic_year }}
                                - HK{{ $program->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- GPA tối thiểu --}}
                <div class="mb-3">
                    <label class="form-label">
                        GPA tối thiểu <span class="text-danger">*</span>
                    </label>

                    <input
                        type="number"
                        name="min_gpa"
                        class="form-control"
                        min="0"
                        max="4"
                        step="0.01"
                        value="{{ old('min_gpa') }}"
                        required
                    >
                </div>

                {{-- Tín chỉ tối thiểu --}}
                <div class="mb-3">
                    <label class="form-label">
                        Số tín chỉ tối thiểu <span class="text-danger">*</span>
                    </label>

                    <input
                        type="number"
                        name="min_credits"
                        class="form-control"
                        min="1"
                        value="{{ old('min_credits') }}"
                        required
                    >
                </div>

                {{-- Không cho phép nợ môn --}}
                <div class="mb-3">
                    <label class="form-label">
                        Cho phép nợ môn
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="Không"
                        disabled
                    >

                    <small class="text-muted">
                        Hệ thống hiện không cho phép sinh viên nợ môn.
                    </small>
                </div>

                {{-- Ghi chú --}}
                <div class="mb-3">
                    <label class="form-label">
                        Ghi chú
                    </label>

                    <textarea
                        name="note"
                        class="form-control"
                        rows="4"
                        placeholder="Nhập ghi chú nếu có..."
                    >{{ old('note') }}</textarea>
                </div>

                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Lưu điều kiện
                </button>

                <a
                    href="{{ route('eligibility-rules.index') }}"
                    class="btn btn-secondary"
                >
                    Hủy
                </a>

            </form>

        </div>

    </div>

</div>

@endsection

