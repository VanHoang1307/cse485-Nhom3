@extends('layouts.admin')

@section('title', 'Chi tiết xếp hạng')

@section('page_heading', 'Chi tiết xếp hạng')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">

            <h4>
                Chi tiết kết quả xếp hạng
            </h4>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">
                        ID
                    </th>

                    <td>
                        {{ $rankingResult->id }}
                    </td>
                </tr>

                <tr>

                    <th>
                        Mã hồ sơ
                    </th>

                    <td>

                        @if($rankingResult->application)

                            {{ $rankingResult->application->application_code }}

                        @else

                            Không xác định

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>
                        Sinh viên
                    </th>

                    <td>

                        @if(
                            $rankingResult->application &&
                            $rankingResult->application->student
                        )

                            {{ $rankingResult->application->student->full_name }}

                        @else

                            Không xác định

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>
                        Tổng điểm
                    </th>

                    <td>

                        <strong>
                            {{ number_format($rankingResult->total_score, 2) }}
                        </strong>

                    </td>

                </tr>

                <tr>

                    <th>
                        Thứ hạng
                    </th>

                    <td>

                        <strong>
                            Hạng {{ $rankingResult->rank }}
                        </strong>

                    </td>

                </tr>

                <tr>

                    <th>
                        Ngày tạo
                    </th>

                    <td>
                        {{ $rankingResult->created_at }}
                    </td>

                </tr>

            </table>

            <div class="mt-3">

                <a
                    href="{{ route('ranking_results.edit', $rankingResult) }}"
                    class="btn btn-warning"
                >
                    Sửa
                </a>

                <a
                    href="{{ route('ranking_results.index') }}"
                    class="btn btn-secondary"
                >
                    Quay lại
                </a>

            </div>

        </div>

    </div>

</div>

@endsection