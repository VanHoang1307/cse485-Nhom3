@extends('layouts.app')

@section('title', 'Chi tiết học bổng')

@section('content')

<div class="row">

    <div class="col-lg-8">

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

                    <a href="{{ route('scholarships.edit',$scholarship->id) }}"
                       class="btn btn-warning btn-sm">

                        Sửa

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

                            @if($scholarship->semester == 1)

                                Học kỳ 1

                            @elseif($scholarship->semester == 2)

                                Học kỳ 2

                            @else

                                {{ $scholarship->semester }}

                            @endif

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

    </div>

</div>



<div class="card shadow">

    <div class="card-header bg-secondary text-white">

        <h4 class="mb-0">

            Điều kiện xét duyệt

        </h4>

    </div>

    <div class="card-body">

        @if($scholarship->eligibilityRules->count() > 0)

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>GPA tối thiểu</th>

                        <th>Tín chỉ tối thiểu</th>

                        <th>Cho phép nợ môn</th>

                        <th>Ghi chú</th>

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

@endsection