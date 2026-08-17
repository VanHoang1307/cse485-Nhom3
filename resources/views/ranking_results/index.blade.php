@extends('layouts.admin')

@section('title', 'Kết quả xếp hạng')

@section('page_heading', 'Kết quả xếp hạng')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            Kết quả xếp hạng
        </h2>

        <a
            href="{{ route('ranking_results.create') }}"
            class="btn btn-primary"
        >
            + Thêm kết quả
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if($results->count() > 0)

        <div class="card">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>
                                <th>STT</th>
                                <th>Hồ sơ</th>
                                <th>Sinh viên</th>
                                <th>Tổng điểm</th>
                                <th>Thứ hạng</th>
                                <th width="250">Thao tác</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($results as $result)

                                <tr>

                                    <td>
                                        {{ $results->firstItem() + $loop->index }}
                                    </td>

                                    <td>

                                        @if($result->application)

                                            {{ $result->application->application_code }}

                                        @else

                                            Không xác định

                                        @endif

                                    </td>

                                    <td>

                                        @if(
                                            $result->application &&
                                            $result->application->student
                                        )

                                            {{ $result->application->student->full_name }}

                                        @else

                                            Không xác định

                                        @endif

                                    </td>

                                    <td>
                                        <strong>
                                            {{ number_format($result->total_score, 2) }}
                                        </strong>
                                    </td>

                                    <td>

                                        @if($result->rank == 1)

                                            <span class="badge bg-warning text-dark">
                                                Hạng 1
                                            </span>

                                        @elseif($result->rank == 2)

                                            <span class="badge bg-secondary">
                                                Hạng 2
                                            </span>

                                        @elseif($result->rank == 3)

                                            <span class="badge bg-danger">
                                                Hạng 3
                                            </span>

                                        @else

                                            <span class="badge bg-info">
                                                Hạng {{ $result->rank }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <a
                                            href="{{ route('ranking_results.show', $result) }}"
                                            class="btn btn-info btn-sm"
                                        >
                                            Xem
                                        </a>

                                        <a
                                            href="{{ route('ranking_results.edit', $result) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Sửa
                                        </a>

                                        <form
                                            action="{{ route('ranking_results.destroy', $result) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa kết quả này?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                            >
                                                Xóa
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">

                    {{ $results->links() }}

                </div>

            </div>

        </div>

    @else

        <div class="alert alert-info">

            Chưa có kết quả xếp hạng.

        </div>

    @endif

</div>

@endsection