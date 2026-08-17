@extends('layouts.dashboard')

@section('title', 'Chi tiết xếp hạng')

@section('page_heading', 'Chi tiết xếp hạng')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">
                Chi tiết kết quả xếp hạng
            </h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">ID</th>
                    <td>{{ $rankingResult->id }}</td>
                </tr>

                <tr>
                    <th>Mã hồ sơ</th>
                    <td>
                        @if($rankingResult->application)
                            {{ $rankingResult->application->application_code }}
                        @else
                            <span class="text-muted">
                                Không xác định
                            </span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Sinh viên</th>
                    <td>
                        @if(
                            $rankingResult->application &&
                            $rankingResult->application->student
                        )
                            {{ $rankingResult->application->student->full_name }}
                        @else
                            <span class="text-muted">
                                Không xác định
                            </span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Tổng điểm</th>
                    <td>
                        <strong>
                            {{ number_format($rankingResult->total_score, 2) }}
                        </strong>
                    </td>
                </tr>

                <tr>
                    <th>Thứ hạng</th>
                    <td>
                        <strong>
                            Hạng {{ $rankingResult->ranking }}
                        </strong>
                    </td>
                </tr>

                <tr>
                    <th>Kết quả</th>
                    <td>
                        @if($rankingResult->result === 'Qualified')
                            <span class="badge bg-success">
                                Đủ điều kiện
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Không đạt
                            </span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Ngày tạo</th>
                    <td>
                        {{ $rankingResult->created_at?->format('d/m/Y H:i') }}
                    </td>
                </tr>

                <tr>
                    <th>Cập nhật lần cuối</th>
                    <td>
                        {{ $rankingResult->updated_at?->format('d/m/Y H:i') }}
                    </td>
                </tr>

            </table>

            <div class="mt-3">

                <a
                    href="{{ route('ranking-results.edit', $rankingResult) }}"
                    class="btn btn-warning"
                >
                    Sửa
                </a>

                <a
                    href="{{ route('ranking-results.index') }}"
                    class="btn btn-secondary"
                >
                    Quay lại
                </a>

            </div>

        </div>

    </div>

</div>

@endsection