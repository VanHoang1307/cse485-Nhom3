@extends('layouts.app')

@section('title', 'Thêm điểm đánh giá')

@section('content')

<div class="container py-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                Thêm điểm đánh giá
            </h3>
        </div>

        <div class="card-body">

            <p class="text-muted">
                Nhập kết quả chấm điểm hồ sơ
            </p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('evaluation-scores.store') }}"
                method="POST"
            >

                @csrf

                {{-- Hồ sơ --}}
                <div class="mb-3">

                    <label class="form-label">
                        Hồ sơ học bổng <span class="text-danger">*</span>
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
                                {{ old('application_id') == $application->id ? 'selected' : '' }}
                            >

                                {{ $application->application_code }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Tiêu chí --}}
                <div class="mb-3">

                    <label class="form-label">
                        Tiêu chí đánh giá <span class="text-danger">*</span>
                    </label>

                    <select
                        name="criterion_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Chọn tiêu chí --
                        </option>

                        @foreach($criteria as $criterion)

                            <option
                                value="{{ $criterion->id }}"
                                {{ old('criterion_id') == $criterion->id ? 'selected' : '' }}
                            >

                                {{ $criterion->name }}
                                - Tối đa {{ number_format($criterion->max_score, 2) }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Hội đồng --}}
                <div class="mb-3">

                    <label class="form-label">
                        Hội đồng đánh giá <span class="text-danger">*</span>
                    </label>

                    <select
                        name="committee_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Chọn hội đồng --
                        </option>

                        @foreach($committees as $committee)

                            <option
                                value="{{ $committee->id }}"
                                {{ old('committee_id') == $committee->id ? 'selected' : '' }}
                            >

                                {{ $committee->name }}

                            </option>

                        @endforeach

                    </select>

                    @if($committees->isEmpty())

                        <div class="alert alert-warning mt-2">
                            Chưa có hội đồng đánh giá.
                            Vui lòng thêm hội đồng trước.
                        </div>

                    @endif

                </div>


                {{-- Điểm --}}
                <div class="mb-3">

                    <label class="form-label">
                        Điểm <span class="text-danger">*</span>
                    </label>

                    <input
                        type="number"
                        name="score"
                        class="form-control"
                        min="0"
                        max="100"
                        step="0.01"
                        value="{{ old('score') }}"
                        required
                    >

                    <small class="text-muted">
                        Điểm từ 0 đến 100.
                    </small>

                </div>


                {{-- Nhận xét --}}
                <div class="mb-3">

                    <label class="form-label">
                        Nhận xét
                    </label>

                    <textarea
                        name="comment"
                        class="form-control"
                        rows="4"
                        placeholder="Nhập nhận xét nếu có..."
                    >{{ old('comment') }}</textarea>

                </div>


                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Lưu điểm
                </button>

                <a
                    href="{{ route('evaluation-scores.index') }}"
                    class="btn btn-secondary"
                >
                    Hủy
                </a>

            </form>

        </div>

    </div>

</div>

@endsection