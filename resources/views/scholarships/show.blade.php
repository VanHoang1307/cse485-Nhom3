@extends('layouts.app')

@section('title', 'Chi tiết học bổng')

@section('content')

{{-- ==================== THÔNG TIN HỌC BỔNG ==================== --}}

<div class="card shadow mb-4">

    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">

        <h3 class="mb-0">
            Chi tiết chương trình học bổng
        </h3>

        <div>
            <a href="{{ route('scholarships.index') }}"
               class="btn btn-light btn-sm">
                Quay lại
            </a>

            <a href="{{ route('scholarships.edit', $scholarship->id) }}"
               class="btn btn-warning btn-sm">
                Sửa học bổng
            </a>
        </div>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="30%">Tên chương trình</th>
                <td>{{ $scholarship->name }}</td>
            </tr>

            <tr>
                <th>Mô tả</th>
                <td>{{ $scholarship->description }}</td>
            </tr>

            <tr>
                <th>Số tiền</th>
                <td>{{ number_format($scholarship->amount) }} VNĐ</td>
            </tr>

            <tr>
                <th>Năm học</th>
                <td>{{ $scholarship->academic_year }}</td>
            </tr>

            <tr>
                <th>Học kỳ</th>
                <td>
                    Học kỳ {{ $scholarship->semester }}
                </td>
            </tr>

            <tr>
                <th>Ngày bắt đầu</th>
                <td>{{ $scholarship->start_date }}</td>
            </tr>

            <tr>
                <th>Ngày kết thúc</th>
                <td>{{ $scholarship->end_date }}</td>
            </tr>

            <tr>
                <th>Trạng thái</th>
                <td>
                    @if($scholarship->status == 'active')
                        <span class="badge bg-success">
                            Đang hoạt động
                        </span>
                    @elseif($scholarship->status == 'draft')
                        <span class="badge bg-warning text-dark">
                            Nháp
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            Đã đóng
                        </span>
                    @endif
                </td>
            </tr>

        </table>

    </div>

</div>


{{-- ==================== ĐIỀU KIỆN XÉT DUYỆT ==================== --}}

<div class="card shadow mb-4">

    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Điều kiện xét duyệt
        </h4>

        <a href="{{ route('eligibility-rules.create') }}"
           class="btn btn-light btn-sm">
            + Thêm điều kiện
        </a>

    </div>

    <div class="card-body">

        @if($scholarship->eligibilityRules->count() > 0)

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>GPA tối thiểu</th>
                        <th>Tín chỉ tối thiểu</th>
                        <th>Cho phép nợ môn</th>
                        <th>Ghi chú</th>
                        <th width="220">Thao tác</th>
                    </tr>

                </thead>

                <tbody>

                @foreach($scholarship->eligibilityRules as $rule)

                    <tr>

                        <td>
                            {{ $rule->min_gpa }}
                        </td>

                        <td>
                            {{ $rule->min_credits }}
                        </td>

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

                        <td>
                            {{ $rule->note }}
                        </td>

                        <td>

                            <a href="{{ route('eligibility-rules.show', $rule->id) }}"
                               class="btn btn-info btn-sm">
                                Xem
                            </a>

                            <a href="{{ route('eligibility-rules.edit', $rule->id) }}"
                               class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <form action="{{ route('eligibility-rules.destroy', $rule->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn xóa điều kiện này?')">
                                    Xóa
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        @else

            <div class="alert alert-warning mb-0">
                Chưa có điều kiện xét duyệt.
            </div>

        @endif

    </div>

</div>


{{-- ==================== TIÊU CHÍ CHẤM ĐIỂM ==================== --}}

<div class="card shadow mb-4">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Tiêu chí chấm điểm
        </h4>

        <a href="{{ route('scoring-criteria.create') }}"
           class="btn btn-light btn-sm">
            + Thêm tiêu chí
        </a>

    </div>

    <div class="card-body">

        @if($scholarship->scoringCriteria->count() > 0)

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>Tên tiêu chí</th>
                        <th>Điểm tối đa</th>
                        <th>Trọng số (%)</th>
                        <th>Mô tả</th>
                        <th width="220">Thao tác</th>
                    </tr>

                </thead>

                <tbody>

                @foreach($scholarship->scoringCriteria as $criterion)

                    <tr>

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

                            <a href="{{ route('scoring-criteria.show', $criterion->id) }}"
                               class="btn btn-info btn-sm">
                                Xem
                            </a>

                            <a href="{{ route('scoring-criteria.edit', $criterion->id) }}"
                               class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <form action="{{ route('scoring-criteria.destroy', $criterion->id) }}"
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

                @endforeach

                </tbody>

            </table>

        @else

            <div class="alert alert-warning mb-0">
                Chưa có tiêu chí chấm điểm.
            </div>

        @endif

    </div>

</div>


{{-- ==================== HỘI ĐỒNG XÉT DUYỆT ==================== --}}

<div class="card shadow mb-4">

    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Hội đồng xét duyệt
        </h4>

        <a href="{{ route('evaluation-committees.create') }}"
           class="btn btn-light btn-sm">
            + Thêm hội đồng
        </a>

    </div>

    <div class="card-body">

        @if($scholarship->evaluationCommittees->count() > 0)

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>Tên hội đồng</th>
                        <th>Chủ tịch</th>
                        <th>Ngày quyết định</th>
                        <th>Trạng thái</th>
                        <th width="220">Thao tác</th>
                    </tr>

                </thead>

                <tbody>

                @foreach($scholarship->evaluationCommittees as $committee)

                    <tr>

                        <td>
                            {{ $committee->committee_name }}
                        </td>

                        <td>
                            {{ $committee->chairman }}
                        </td>

                        <td>
                            {{ $committee->decision_date }}
                        </td>

                        <td>

                            @if($committee->status == 'active')

                                <span class="badge bg-success">
                                    Đang hoạt động
                                </span>

                            @elseif($committee->status == 'closed')

                                <span class="badge bg-secondary">
                                    Đã đóng
                                </span>

                            @else

                                <span class="badge bg-warning text-dark">
                                    {{ $committee->status }}
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('evaluation-committees.show', $committee->id) }}"
                               class="btn btn-info btn-sm">
                                Xem
                            </a>

                            <a href="{{ route('evaluation-committees.edit', $committee->id) }}"
                               class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <form action="{{ route('evaluation-committees.destroy', $committee->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn xóa hội đồng này?')">
                                    Xóa
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        @else

            <div class="alert alert-warning mb-0">
                Chưa có hội đồng xét duyệt.
            </div>

        @endif

    </div>

</div>

@endsection