@extends('layouts.dashboard')

@section('title', 'Sửa kết quả xếp hạng')

@section('page_heading', 'Sửa kết quả xếp hạng')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">
                Sửa kết quả xếp hạng
            </h4>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Có lỗi xảy ra:</strong>

                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('ranking-results.update', $rankingResult) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                {{-- Hồ sơ ứng tuyển --}}
                <div class="mb-3">

                    <label class="form-label">
                        Hồ sơ ứng tuyển
                    </label>

                    <div class="form-control bg-light">
                        <strong>
                            {{ $rankingResult->application->application_code ?? 'Không xác định' }}
                        </strong>

                        @if($rankingResult->application?->student)
                            -
                            {{ $rankingResult->application->student->full_name }}
                        @endif
                    </div>

                    <input
                        type="hidden"
                        name="application_id"
                        value="{{ $rankingResult->application_id }}"
                    >

                    <div class="form-text">
                        Kết quả xếp hạng sẽ được tính lại dựa trên các điểm đánh giá hiện tại.
                    </div>

                </div>

                {{-- Tổng điểm hiện tại --}}
                <div class="mb-3">

                    <label class="form-label">
                        Tổng điểm hiện tại
                    </label>

                    <div class="form-control bg-light">

                        <strong>
                            {{ number_format($rankingResult->total_score, 2) }}
                            / 100
                        </strong>

                    </div>

                    <div class="form-text">
                        Tổng điểm được hệ thống tự động tính theo điểm đánh giá
                        và trọng số của từng tiêu chí.
                    </div>

                </div>

                {{-- Thứ hạng hiện tại --}}
                <div class="mb-3">

                    <label class="form-label">
                        Thứ hạng hiện tại
                    </label>

                    <div>
                        <span class="badge bg-primary fs-6">
                            Hạng {{ $rankingResult->ranking }}
                        </span>
                    </div>

                </div>

                {{-- Kết quả --}}
                <div class="mb-3">

                    <label class="form-label">
                        Kết quả hiện tại
                    </label>

                    <div>

                        @if($rankingResult->result === 'Qualified')

                            <span class="badge bg-success fs-6">
                                Đạt
                            </span>

                        @else

                            <span class="badge bg-danger fs-6">
                                Không đạt
                            </span>

                        @endif

                    </div>

                </div>

                <div class="alert alert-info">

                    <strong>Lưu ý:</strong>

                    <ul class="mb-0 mt-2">

                        <li>
                            Tổng điểm không nhập thủ công.
                        </li>

                        <li>
                            Hệ thống tự động tính tổng điểm từ các điểm đánh giá.
                        </li>

                        <li>
                            Sau khi cập nhật, thứ hạng sẽ được tính lại.
                        </li>

                        <li>
                            Kết quả đạt/không đạt cũng được cập nhật tự động.
                        </li>

                    </ul>

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Cập nhật
                    </button>

                    <a
                        href="{{ route('ranking-results.index') }}"
                        class="btn btn-secondary"
                    >
                        Quay lại
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection