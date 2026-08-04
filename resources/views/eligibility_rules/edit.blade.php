@extends('layouts.app')

@section('title', 'Cập nhật điều kiện xét học bổng')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h3 class="mb-0 text-dark">

            Cập nhật điều kiện xét học bổng

        </h3>

    </div>

    <div class="card-body">

        <a href="{{ route('eligibility-rules.index') }}"
           class="btn btn-secondary mb-3">

            ← Quay lại

        </a>

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('eligibility-rules.update',$rule->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">

                    Chương trình học bổng

                </label>

                <select
                    name="scholarship_program_id"
                    class="form-select">

                    @foreach($scholarships as $scholarship)

                        <option
                            value="{{ $scholarship->id }}"
                            {{ old('scholarship_program_id',$rule->scholarship_program_id)==$scholarship->id ? 'selected' : '' }}>

                            {{ $scholarship->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    GPA tối thiểu

                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    max="4"
                    name="min_gpa"
                    class="form-control"
                    value="{{ old('min_gpa',$rule->min_gpa) }}">

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Tín chỉ tối thiểu

                </label>

                <input
                    type="number"
                    name="min_credits"
                    class="form-control"
                    value="{{ old('min_credits',$rule->min_credits) }}">

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Cho phép nợ môn

                </label>

                <select
                    name="allow_debt_subject"
                    class="form-select">

                    <option value="1"
                        {{ old('allow_debt_subject',$rule->allow_debt_subject)==1 ? 'selected' : '' }}>

                        Có

                    </option>

                    <option value="0"
                        {{ old('allow_debt_subject',$rule->allow_debt_subject)==0 ? 'selected' : '' }}>

                        Không

                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Ghi chú

                </label>

                <textarea
                    name="note"
                    rows="4"
                    class="form-control">{{ old('note',$rule->note) }}</textarea>

            </div>

            <button
                type="submit"
                class="btn btn-warning">

                Cập nhật

            </button>

            <a href="{{ route('eligibility-rules.index') }}"
               class="btn btn-secondary">

                Hủy

            </a>

        </form>

    </div>

</div>

@endsection