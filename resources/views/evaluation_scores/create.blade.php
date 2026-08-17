<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Thêm điểm</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Thêm điểm đánh giá</h2>

            <p class="text-muted mb-0">
                Nhập kết quả chấm điểm hồ sơ
            </p>
        </div>

        <a
            href="{{ route('evaluation-scores.index') }}"
            class="btn btn-secondary"
        >
            ← Quay lại
        </a>
    </div>

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

    <div class="card shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('evaluation-scores.store') }}"
                method="POST"
            >

                @csrf

                {{-- Hồ sơ học bổng --}}
                <div class="mb-3">

                    <label class="form-label">
                        Hồ sơ học bổng
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
                                {{ old('application_id') == $application->id ? 'selected' : '' }}
                            >
                                {{ $application->application_code }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Tiêu chí đánh giá --}}
                <div class="mb-3">

                    <label class="form-label">
                        Tiêu chí đánh giá
                        <span class="text-danger">*</span>
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

                                @if(isset($criterion->max_score))
                                    - Tối đa {{ number_format($criterion->max_score, 2) }}
                                @endif
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Hội đồng đánh giá --}}
                <div class="mb-3">

                    <label class="form-label">
                        Hội đồng đánh giá
                        <span class="text-danger">*</span>
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

                        <div class="alert alert-warning mt-2 mb-0">

                            Chưa có hội đồng đánh giá.

                            Vui lòng kiểm tra bảng
                            <strong>evaluation_committees</strong>.

                        </div>

                    @endif

                </div>

                {{-- Điểm --}}
                <div class="mb-3">

                    <label class="form-label">
                        Điểm
                        <span class="text-danger">*</span>
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

                    <div class="form-text">
                        Điểm từ 0 đến 100.
                    </div>

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
                        placeholder="Nhập nhận xét..."
                    >{{ old('comment') }}</textarea>

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Lưu điểm
                    </button>

                    <a
                        href="{{ route('evaluation-scores.index') }}"
                        class="btn btn-secondary"
                    >
                        Hủy
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>