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

                            <li>
                                {{ $error }}
                            </li>

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
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="application_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Chọn hồ sơ --
                        </option>

                        @foreach($applications as $application)

                            <option
                                value="{{ $application->id }}"
                                {{ old(
                                    'application_id',
                                    $rankingResult->application_id
                                ) == $application->id ? 'selected' : '' }}
                            >

                                {{ $application->application_code }}

                                @if($application->student)

                                    - {{ $application->student->full_name }}

                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Tổng điểm --}}
                <div class="mb-3">

                    <label class="form-label">
                        Tổng điểm
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="number"
                        name="total_score"
                        class="form-control"
                        min="0"
                        max="100"
                        step="0.01"
                        value="{{ old(
                            'total_score',
                            $rankingResult->total_score
                        ) }}"
                        required
                    >

                    <div class="form-text">
                        Tổng điểm từ 0 đến 100.
                    </div>

                </div>

                {{-- Thông báo --}}
                <div class="alert alert-info">

                    <strong>Lưu ý:</strong>

                    Thứ hạng sẽ được hệ thống tự động tính lại
                    dựa trên tổng điểm.

                </div>

                {{-- Nút --}}
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