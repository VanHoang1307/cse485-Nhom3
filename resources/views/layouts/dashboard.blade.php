@extends('layouts.app')

@section('title', 'Tổng quan')

@section('content')

<div class="container-fluid py-4">

```
{{-- HEADER --}}
<div class="card border-0 shadow-sm mb-4 overflow-hidden">
    <div class="row align-items-center">

        <div class="col-md-7 p-4 p-md-5">
            <span class="badge bg-primary mb-3">
                🎓 HỆ THỐNG QUẢN LÝ HỌC BỔNG
            </span>

            <h1 class="fw-bold mb-3">
                Chào mừng đến với hệ thống
            </h1>

            <p class="text-muted fs-5 mb-4">
                Quản lý chương trình học bổng, sinh viên,
                hồ sơ đăng ký, đánh giá và kết quả xếp hạng
                trên một nền tảng thống nhất.
            </p>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('scholarships.index') }}"
                   class="btn btn-primary">
                    🎓 Quản lý học bổng
                </a>

                <a href="{{ route('applications.index') }}"
                   class="btn btn-outline-primary">
                    📄 Xem hồ sơ
                </a>
            </div>
        </div>

        <div class="col-md-5 text-center p-4">
            <img src="{{ asset('images/anhsv.jpg') }}"
                 alt="Sinh viên"
                 class="img-fluid rounded-4 shadow"
                 style="max-height: 280px; object-fit: cover;">
        </div>

    </div>
</div>


{{-- THỐNG KÊ --}}
<div class="row g-4 mb-4">

    {{-- Học bổng --}}
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">
                            Chương trình học bổng
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ \App\Models\ScholarshipProgram::count() }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        🎓
                    </div>
                </div>

                <a href="{{ route('scholarships.index') }}"
                   class="small text-decoration-none">
                    Xem danh sách →
                </a>

            </div>
        </div>
    </div>


    {{-- Sinh viên --}}
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">
                            Sinh viên
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ \App\Models\Student::count() }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        👨‍🎓
                    </div>
                </div>

                <a href="{{ route('students.index') }}"
                   class="small text-decoration-none">
                    Xem sinh viên →
                </a>

            </div>
        </div>
    </div>


    {{-- Hồ sơ --}}
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">
                            Hồ sơ đăng ký
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ \App\Models\Application::count() }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        📄
                    </div>
                </div>

                <a href="{{ route('applications.index') }}"
                   class="small text-decoration-none">
                    Xem hồ sơ →
                </a>

            </div>
        </div>
    </div>


    {{-- Kết quả --}}
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">
                            Kết quả xếp hạng
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ \App\Models\RankingResult::count() }}
                        </h2>
                    </div>

                    <div class="fs-1">
                        🏆
                    </div>
                </div>

                <a href="{{ route('ranking-results.index') }}"
                   class="small text-decoration-none">
                    Xem kết quả →
                </a>

            </div>
        </div>
    </div>

</div>


{{-- QUẢN LÝ NHANH --}}
<div class="row g-4 mb-4">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 pt-4 px-4">
                <h4 class="fw-bold mb-1">
                    📌 Quản lý nhanh
                </h4>

                <p class="text-muted mb-0">
                    Các chức năng chính của hệ thống
                </p>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">
                        <a href="{{ route('scholarships.index') }}"
                           class="text-decoration-none">
                            <div class="border rounded-3 p-3 h-100">
                                <h5>🎓 Học bổng</h5>
                                <p class="text-muted mb-0">
                                    Quản lý các chương trình học bổng
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('eligibility-rules.index') }}"
                           class="text-decoration-none">
                            <div class="border rounded-3 p-3 h-100">
                                <h5>📋 Điều kiện xét</h5>
                                <p class="text-muted mb-0">
                                    Thiết lập điều kiện xét học bổng
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('students.index') }}"
                           class="text-decoration-none">
                            <div class="border rounded-3 p-3 h-100">
                                <h5>👨‍🎓 Sinh viên</h5>
                                <p class="text-muted mb-0">
                                    Quản lý thông tin sinh viên
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('applications.index') }}"
                           class="text-decoration-none">
                            <div class="border rounded-3 p-3 h-100">
                                <h5>📄 Hồ sơ đăng ký</h5>
                                <p class="text-muted mb-0">
                                    Theo dõi và xử lý hồ sơ
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('evaluation-scores.index') }}"
                           class="text-decoration-none">
                            <div class="border rounded-3 p-3 h-100">
                                <h5>📝 Điểm đánh giá</h5>
                                <p class="text-muted mb-0">
                                    Quản lý điểm chấm hồ sơ
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('ranking-results.index') }}"
                           class="text-decoration-none">
                            <div class="border rounded-3 p-3 h-100">
                                <h5>🏆 Xếp hạng</h5>
                                <p class="text-muted mb-0">
                                    Xem kết quả xếp hạng hồ sơ
                                </p>
                            </div>
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- THÔNG TIN HỆ THỐNG --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 pt-4 px-4">
                <h4 class="fw-bold">
                    📊 Tổng quan hệ thống
                </h4>
            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between border-bottom py-3">
                    <span>Tiêu chí chấm điểm</span>
                    <strong>
                        {{ \App\Models\ScoringCriterion::count() }}
                    </strong>
                </div>

                <div class="d-flex justify-content-between border-bottom py-3">
                    <span>Hội đồng xét duyệt</span>
                    <strong>
                        {{ \App\Models\EvaluationCommittee::count() }}
                    </strong>
                </div>

                <div class="d-flex justify-content-between border-bottom py-3">
                    <span>Minh chứng</span>
                    <strong>
                        {{ \App\Models\ApplicationDocument::count() }}
                    </strong>
                </div>

                <div class="d-flex justify-content-between py-3">
                    <span>Điểm đánh giá</span>
                    <strong>
                        {{ \App\Models\EvaluationScore::count() }}
                    </strong>
                </div>

            </div>

        </div>

    </div>

</div>


{{-- FOOTER --}}
<div class="text-center text-muted py-3">
    <small>
        🎓 Hệ thống quản lý học bổng
        © {{ date('Y') }}
    </small>
</div>
```

</div>

@endsection
