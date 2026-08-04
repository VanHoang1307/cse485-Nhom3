@extends('layouts.app')

@section('title', 'Danh sách điều kiện xét học bổng')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h3 class="mb-0">
            Danh sách điều kiện xét học bổng
        </h3>

        <div>

            <a href="{{ route('scholarships.index') }}"
               class="btn btn-light me-2">

                ← Danh sách học bổng

            </a>

            <a href="{{ route('eligibility-rules.create') }}"
               class="btn btn-success">

                + Thêm điều kiện

            </a>

        </div>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Chương trình học bổng</th>

                    <th>GPA tối thiểu</th>

                    <th>Tín chỉ tối thiểu</th>

                    <th>Nợ môn</th>

                    <th>Ghi chú</th>

                    <th width="180">
                        Thao tác
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($rules as $rule)

                <tr>

                    <td>{{ $rule->id }}</td>

                    <td>{{ $rule->scholarshipProgram->name }}</td>

                    <td>{{ $rule->min_gpa }}</td>

                    <td>{{ $rule->min_credits }}</td>

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

                    <td>{{ $rule->note }}</td>

                    <td>

                        <a href="{{ route('eligibility-rules.show',$rule->id) }}"
                           class="btn btn-info btn-sm text-white">

                            Xem

                        </a>

                        <a href="{{ route('eligibility-rules.edit',$rule->id) }}"
                           class="btn btn-warning btn-sm">

                            Sửa

                        </a>

                        <form action="{{ route('eligibility-rules.destroy',$rule->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc muốn xóa điều kiện này?')">

                                Xóa

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center text-muted">

                        Chưa có điều kiện xét học bổng.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection