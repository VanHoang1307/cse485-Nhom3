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

            {{-- Thông tin hồ sơ --}}
            <h5 class="mb-3">
                Thông tin hồ sơ
            </h5>

            <table class="table table-bordered">

                <tr>
                    <th width="250">ID kết quả</th>
                    <td>{{ $rankingResult->id }}</td>
                </tr>

                <tr>
                    <th>Mã hồ sơ</th>
                    <td>
                        @if($rankingResult->application)
                            <strong>
                                {{ $rankingResult->application->application_code }}
                            </strong>
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
                        @if($rankingResult->application?->student)
                            {{ $rankingResult->application->student->full_name }}
                        @else
                            <span class="text-muted">
                                Không xác định
                            </span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Chương trình học bổng</th>
                    <td>
                        @if($rankingResult->application?->scholarshipProgram)
                            {{ $rankingResult->application->scholarshipProgram->name }}
                        @else
                            <span class="text-muted">
                                Không xác định
                            </span>
                        @endif
                    </td>
                </tr>

            </table>

            {{-- Kết quả --}}
            <h5 class="mb-3 mt-4">
                Kết quả xếp hạng
            </h5>

            <table class="table table-bordered">

                <tr>
                    <th width="250">Tổng điểm</th>
                    <td>
                        <strong class="fs-5">
                            {{ number_format($rankingResult->total_score, 2) }}
                        </strong>
                        / 100
                    </td>
                </tr>

                <tr>
                    <th>Thứ hạng</th>
                    <td>
                        <span class="badge bg-primary fs-6">
                            Hạng {{ $rankingResult->ranking }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Kết quả</th>
                    <td>
                        @if($rankingResult->result === 'Qualified')

                            <span class="badge bg-success fs-6">
                                Đạt
                            </span>

                        @else

                            <span class="badge bg-danger fs-6">
                                Không đạt
                            </span>

                        @endif
                    </td>
                </tr>

            </table>

            {{-- Điểm thành phần --}}
            <h5 class="mb-3 mt-4">
                Chi tiết điểm đánh giá
            </h5>

            @if($rankingResult->application?->evaluationScores?->count())

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">

                            <tr>
                                <th>STT</th>
                                <th>Tiêu chí</th>
                                <th>Điểm</th>
                                <th>Điểm tối đa</th>
                                <th>Trọng số</th>
                                <th>Điểm quy đổi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach(
                                $rankingResult->application->evaluationScores
                                as $score
                            )

                                @php
                                    $criterion = $score->criterion;

                                    $scoreValue = (float) $score->score;

                                    $maxScore = $criterion
                                        ? (float) $criterion->max_score
                                        : 0;

                                    $weight = $criterion
                                        ? (float) $criterion->weight
                                        : 0;

                                    $convertedScore = $maxScore > 0
                                        ? ($scoreValue / $maxScore) * $weight
                                        : 0;
                                @endphp

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        @if($criterion)
                                            {{ $criterion->criteria_name }}
                                        @else
                                            <span class="text-muted">
                                                Không xác định
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ number_format($scoreValue, 2) }}
                                    </td>

                                    <td>
                                        {{ number_format($maxScore, 2) }}
                                    </td>

                                    <td>
                                        {{ number_format($weight, 2) }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ number_format($convertedScore, 2) }}
                                        </strong>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-warning">
                    Hồ sơ này chưa có điểm đánh giá.
                </div>

            @endif

            {{-- Thời gian --}}
            <h5 class="mb-3 mt-4">
                Thông tin hệ thống
            </h5>

            <table class="table table-bordered">

                <tr>
                    <th width="250">Ngày tạo</th>
                    <td>
                        {{ $rankingResult->created_at?->format('d/m/Y H:i') ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Cập nhật lần cuối</th>
                    <td>
                        {{ $rankingResult->updated_at?->format('d/m/Y H:i') ?? '-' }}
                    </td>
                </tr>

            </table>

            {{-- Nút --}}
            <div class="mt-4">

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