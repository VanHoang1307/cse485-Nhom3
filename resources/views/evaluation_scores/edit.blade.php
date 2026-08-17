<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Sửa điểm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container py-4">

    <div class="d-flex justify-content-between mb-4">

        <h2>
            Sửa điểm đánh giá
        </h2>

        <a href="{{ route('evaluation_scores.index') }}"
           class="btn btn-secondary">

            ← Quay lại

        </a>

    </div>


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


    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('evaluation_scores.update', $evaluationScore->id) }}"
                  method="POST">

                @csrf

                @method('PUT')


                {{-- Application --}}
                <div class="mb-3">

                    <label class="form-label">
                        Hồ sơ học bổng
                    </label>

                    <select name="application_id"
                            class="form-select"
                            required>

                        @foreach($applications as $application)

                            <option value="{{ $application->id }}"
                                {{ old(
                                    'application_id',
                                    $evaluationScore->application_id
                                ) == $application->id ? 'selected' : '' }}>

                                {{ $application->application_code }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Criterion --}}
                <div class="mb-3">

                    <label class="form-label">
                        Tiêu chí đánh giá
                    </label>

                    <select name="criterion_id"
                            class="form-select"
                            required>

                        @foreach($criteria as $criterion)

                            <option value="{{ $criterion->id }}"
                                {{ old(
                                    'criterion_id',
                                    $evaluationScore->criterion_id
                                ) == $criterion->id ? 'selected' : '' }}>

                                {{ $criterion->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Committee --}}
                <div class="mb-3">

                    <label class="form-label">
                        Hội đồng đánh giá
                    </label>

                    <select name="committee_id"
                            class="form-select"
                            required>

                        @foreach($committees as $committee)

                            <option value="{{ $committee->id }}"
                                {{ old(
                                    'committee_id',
                                    $evaluationScore->committee_id
                                ) == $committee->id ? 'selected' : '' }}>

                                {{ $committee->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Score --}}
                <div class="mb-3">

                    <label class="form-label">
                        Điểm
                    </label>

                    <input type="number"
                           name="score"
                           class="form-control"
                           min="0"
                           max="100"
                           step="0.01"
                           value="{{ old(
                               'score',
                               $evaluationScore->score
                           ) }}"
                           required>

                </div>


                {{-- Comment --}}
                <div class="mb-3">

                    <label class="form-label">
                        Nhận xét
                    </label>

                    <textarea name="comment"
                              class="form-control"
                              rows="4">{{ old(
                                  'comment',
                                  $evaluationScore->comment
                              ) }}</textarea>

                </div>


                <button type="submit"
                        class="btn btn-primary">

                    Cập nhật

                </button>

                <a href="{{ route('evaluation_scores.index') }}"
                   class="btn btn-secondary">

                    Hủy

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>