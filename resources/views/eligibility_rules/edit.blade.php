@extends('layouts.app')

@section('title', 'Sửa điều kiện xét học bổng')

@section('content')

<div class="card shadow">

    <div class="card-header bg-secondary text-white">
        <h3 class="mb-0">
            Sửa điều kiện xét học bổng
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


        <div class="alert alert-info">

            <strong>Chương trình học bổng:</strong>

            {{ $rule->scholarshipProgram->name }}

        </div>


        <form action="{{ route('eligibility-rules.update', $rule->id) }}"
              method="POST">

            @csrf

            @method('PUT')


            {{-- Chương trình học bổng --}}

            <div class="mb-3">

                <label class="form-label">
                    Chương trình học bổng
                </label>

                <input type="text"
                       class="form-control"
                       value="{{ $rule->scholarshipProgram->name }}"
                       disabled>

                <input type="hidden"
                       name="scholarship_program_id"
                       value="{{ $rule->scholarship_program_id }}">

            </div>


            {{-- GPA tối thiểu --}}

            <div class="mb-3">

                <label class="form-label">
                    GPA tối thiểu
                </label>

                <input type="number"
                       name="min_gpa"
                       class="form-control"
                       step="0.01"
                       min="0"
                       max="4"
                       value="{{ old('min_gpa', $rule->min_gpa) }}"
                       required>

                <small class="text-muted">
                    GPA nằm trong khoảng từ 0 đến 4.
                </small>

            </div>


            {{-- Tín chỉ tối thiểu --}}

            <div class="mb-3">

                <label class="form-label">
                    Tín chỉ tối thiểu
                </label>

                <input type="number"
                       name="min_credits"
                       class="form-control"
                       min="1"
                       value="{{ old('min_credits', $rule->min_credits) }}"
                       required>

            </div>


            {{-- Không cho phép nợ môn --}}

            <div class="mb-3">

                <label class="form-label">
                    Tình trạng nợ môn
                </label>

                <input type="text"
                       class="form-control"
                       value="Không được nợ môn"
                       disabled>

                <div class="form-text text-danger">
                    Sinh viên bắt buộc không được nợ môn để đủ điều kiện xét học bổng.
                </div>

            </div>


            {{-- Ghi chú --}}

            <div class="mb-3">

                <label class="form-label">
                    Ghi chú
                </label>

                <textarea name="note"
                          class="form-control"
                          rows="4">{{ old('note', $rule->note) }}</textarea>

            </div>


            <div class="mt-4">

                <button type="submit"
                        class="btn btn-primary">
                    Cập nhật
                </button>

                <a href="{{ route('scholarships.show', $rule->scholarship_program_id) }}"
                   class="btn btn-secondary">
                    Quay lại học bổng
                </a>

            </div>

        </form>

    </div>

</div>

@endsection