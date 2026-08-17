@extends('layouts.app')

@section('title', 'Chi tiết hồ sơ học bổng')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h3 class="mb-0">
            Chi tiết hồ sơ học bổng
        </h3>

        <a href="{{ route('applications.index') }}"
           class="btn btn-light">

            ← Quay lại danh sách

        </a>

    </div>

    <div class="card-body">

        {{-- Thông tin hồ sơ --}}
        <h5 class="text-primary mb-3">
            Thông tin hồ sơ
        </h5>

        <table class="table table-bordered">

            <tr>
                <th width="250">Mã hồ sơ</th>
                <td>{{ $application->application_code }}</td>
            </tr>

            <tr>
                <th>Ngày nộp</th>
                <td>{{ $application->apply_date }}</td>
            </tr>

            <tr>
                <th>Trạng thái</th>
                <td>
                    @if(strtolower($application->status) === 'pending')
                        <span class="badge bg-warning text-dark">
                            Chờ xét duyệt
                        </span>
                    @elseif(strtolower($application->status) === 'approved')
                        <span class="badge bg-success">
                            Đã duyệt
                        </span>
                    @elseif(strtolower($application->status) === 'rejected')
                        <span class="badge bg-danger">
                            Từ chối
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            {{ $application->status }}
                        </span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Ghi chú xét duyệt</th>
                <td>
                    {{ $application->review_note ?: 'Không có' }}
                </td>
            </tr>

        </table>

        {{-- Thông tin sinh viên --}}
        <h5 class="text-primary mt-4 mb-3">
            Thông tin sinh viên
        </h5>

        <table class="table table-bordered">

            <tr>
                <th width="250">MSSV</th>
                <td>
                    {{ $application->student->student_code ?? 'Không có' }}
                </td>
            </tr>

            <tr>
                <th>Họ và tên</th>
                <td>
                    {{ $application->student->full_name ?? 'Không có' }}
                </td>
            </tr>

            <tr>
                <th>Email</th>
                <td>
                    {{ $application->student->email ?? 'Không có' }}
                </td>
            </tr>

        </table>

        {{-- Thông tin học bổng --}}
        <h5 class="text-primary mt-4 mb-3">
            Chương trình học bổng
        </h5>

        <table class="table table-bordered">

            <tr>
                <th width="250">Tên chương trình</th>
                <td>
                    {{ $application->scholarshipProgram->name ?? 'Không có' }}
                </td>
            </tr>

            <tr>
                <th>Số tiền học bổng</th>
                <td>
                    @if($application->scholarshipProgram)
                        {{ number_format($application->scholarshipProgram->amount) }} VNĐ
                    @else
                        Không có
                    @endif
                </td>
            </tr>

            <tr>
                <th>Năm học</th>
                <td>
                    {{ $application->scholarshipProgram->academic_year ?? 'Không có' }}
                </td>
            </tr>

            <tr>
                <th>Học kỳ</th>
                <td>
                    @if($application->scholarshipProgram)
                        Học kỳ {{ $application->scholarshipProgram->semester }}
                    @else
                        Không có
                    @endif
                </td>
            </tr>

        </table>

        {{-- Minh chứng --}}
        <h5 class="text-primary mt-4 mb-3">
            Minh chứng hồ sơ
        </h5>

        @if($application->documents->count() > 0)

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Tên tài liệu</th>
                        <th>Loại tài liệu</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($application->documents as $document)

                        <tr>

                            <td>
                                {{ $document->id }}
                            </td>

                            <td>
                                {{ $document->document_name ?? $document->file_name ?? 'Không có tên' }}
                            </td>

                            <td>
                                {{ $document->document_type ?? 'Không có' }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="alert alert-secondary">
                Hồ sơ chưa có minh chứng.
            </div>

        @endif

        {{-- Điểm đánh giá --}}
        <h5 class="text-primary mt-4 mb-3">
            Điểm đánh giá
        </h5>

        @if($application->evaluationScores->count() > 0)

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Tiêu chí</th>
                        <th>Điểm</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($application->evaluationScores as $score)

                        <tr>

                            <td>
                                {{ $score->id }}
                            </td>

                            <td>
                                {{ $score->scoringCriterion->name ?? 'Không có' }}
                            </td>

                            <td>
                                {{ $score->score ?? 0 }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="alert alert-secondary">
                Hồ sơ chưa có điểm đánh giá.
            </div>

        @endif

        {{-- Kết quả xếp hạng --}}
        <h5 class="text-primary mt-4 mb-3">
            Kết quả xếp hạng
        </h5>

        @if($application->rankingResult)

            <table class="table table-bordered">

                <tr>
                    <th width="250">Xếp hạng</th>
                    <td>
                        {{ $application->rankingResult->rank ?? 'Chưa có' }}
                    </td>
                </tr>

                <tr>
                    <th>Tổng điểm</th>
                    <td>
                        {{ $application->rankingResult->total_score ?? 'Chưa có' }}
                    </td>
                </tr>

            </table>

        @else

            <div class="alert alert-secondary">
                Hồ sơ chưa có kết quả xếp hạng.
            </div>

        @endif

        <div class="mt-4">

            <a href="{{ route('applications.edit', $application->id) }}"
               class="btn btn-warning">

                Sửa hồ sơ

            </a>

            <a href="{{ route('applications.index') }}"
               class="btn btn-secondary">

                Quay lại

            </a>

        </div>

    </div>

</div>

@endsection

