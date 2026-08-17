@extends('layouts.admin')

@section('title', 'Thêm kết quả xếp hạng')

@section('page_heading', 'Thêm kết quả xếp hạng')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">

            <h4>
                Thêm kết quả xếp hạng
            </h4>

        </div>

        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form
                action="{{ route('ranking_results.store') }}"
                method="POST"
            >

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Hồ sơ ứng tuyển
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

                                @if($application->student)

                                    -
                                    {{ $application->student->full_name }}

                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Tổng điểm
                    </label>

                    <input
                        type="number"
                        name="total_score"
                        class="form-control"
                        min="0"
                        max="100"
                        step="0.01"
                        value="{{ old('total_score') }}"
                        required
                    >

                    <small class="text-muted">
                        Nhập tổng điểm từ 0 đến 100.
                    </small>

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Lưu
                    </button>

                    <a
                        href="{{ route('ranking_results.index') }}"
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