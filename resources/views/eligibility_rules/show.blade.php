@extends('layouts.app')

@section('title', 'Chi tiết điều kiện xét học bổng')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h3 class="mb-0">
            Chi tiết điều kiện xét học bổng
        </h3>

        <div>

            <a href="{{ route('eligibility-rules.index') }}"
               class="btn btn-light">

                ← Quay lại

            </a>

            <a href="{{ route('eligibility-rules.edit', $rule->id) }}"
               class="btn btn-warning">

                Sửa

            </a>

        </div>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="250">ID</th>
                <td>{{ $rule->id }}</td>
            </tr>

            <tr>
                <th>Chương trình học bổng</th>
                <td>{{ $rule->scholarshipProgram->name }}</td>
            </tr>

            <tr>
                <th>GPA tối thiểu</th>
                <td>{{ $rule->min_gpa }}</td>
            </tr>

            <tr>
                <th>Tín chỉ tối thiểu</th>
                <td>{{ $rule->min_credits }}</td>
            </tr>

            <tr>
                <th>Cho phép nợ môn</th>

                <td>

                    @if($rule->allow_debt_subject)

                        <span class="badge bg-success">

                            Có

                        </span>

                    @else

                        <span class="badge bg-danger">

                            Không

                        </span>

                    @endif

                </td>

            </tr>

            <tr>

                <th>Ghi chú</th>

                <td>

                    {{ $rule->note ?: 'Không có ghi chú' }}

                </td>

            </tr>

        </table>

    </div>

</div>

@endsection