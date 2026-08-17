@extends('layouts.app')

@section('title', 'Danh sách tiêu chí chấm điểm')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h3 class="mb-0">
            Danh sách tiêu chí chấm điểm
        </h3>

        <a href="{{ route('scoring-criteria.create') }}"
           class="btn btn-light">
            + Thêm tiêu chí
        </a>

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
                    <th>Tên tiêu chí</th>
                    <th>Điểm tối đa</th>
                    <th>Trọng số (%)</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                </tr>

            </thead>

            <tbody>

            @forelse($criteria as $criterion)

                <tr>

                    <td>
                        {{ $criterion->id }}
                    </td>

                    <td>
                        {{ $criterion->scholarshipProgram->name }}
                    </td>

                    <td>
                        {{ $criterion->criteria_name }}
                    </td>

                    <td>
                        {{ $criterion->max_score }}
                    </td>

                    <td>
                        {{ $criterion->weight }}%
                    </td>

                    <td>
                        {{ $criterion->description }}
                    </td>

                    <td>

                        <a href="{{ route('scoring-criteria.show', $criterion) }}"
                           class="btn btn-info btn-sm text-white">
                            Xem
                        </a>

                        <a href="{{ route('scoring-criteria.edit', $criterion) }}"
                           class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <form action="{{ route('scoring-criteria.destroy', $criterion) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa tiêu chí này?')">
                                Xóa
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7"
                        class="text-center text-muted">

                        Chưa có tiêu chí chấm điểm.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection