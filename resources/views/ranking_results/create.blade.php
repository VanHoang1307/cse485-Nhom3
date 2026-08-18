@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">
                Tạo kết quả xếp hạng
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
                action="{{ route('ranking-results.store') }}"
                method="POST"
            >

                @csrf

                {{-- Chọn hồ sơ --}}
                <div class="mb-3">

                    <label class="form-label">
                        Hồ sơ học bổng
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="application_id"
                        id="application_id"
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
                                    - {{ $application->student->full_name }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Chi tiết điểm --}}
                <div
                    id="scorePreview"
                    class="alert alert-secondary"
                >
                    Vui lòng chọn hồ sơ để xem điểm đánh giá.
                </div>

                {{-- Lưu ý --}}
                <div class="alert alert-info">

                    <strong>Lưu ý:</strong>

                    <ul class="mb-0 mt-2">

                        <li>
                            Tổng điểm được hệ thống tự động tính.
                        </li>

                        <li>
                            Nếu một tiêu chí có nhiều hội đồng chấm,
                            hệ thống lấy điểm trung bình.
                        </li>

                        <li>
                            Điểm sau đó được tính theo trọng số
                            của từng tiêu chí.
                        </li>

                        <li>
                            Thứ hạng được tự động cập nhật sau khi lưu.
                        </li>

                    </ul>

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Tạo kết quả
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

<script>

const applicationSelect =
    document.getElementById('application_id');

const scorePreview =
    document.getElementById('scorePreview');

const applications = @json($applications);

applicationSelect.addEventListener(
    'change',
    function () {

        const applicationId =
            parseInt(this.value);

        if (!applicationId) {

            scorePreview.className =
                'alert alert-secondary';

            scorePreview.innerHTML =
                'Vui lòng chọn hồ sơ để xem điểm đánh giá.';

            return;
        }

        const application =
            applications.find(
                item => item.id === applicationId
            );

        if (!application) {
            return;
        }

        const scores =
            application.evaluation_scores || [];

        if (scores.length === 0) {

            scorePreview.className =
                'alert alert-warning';

            scorePreview.innerHTML =
                '<strong>Hồ sơ chưa có điểm đánh giá.</strong>' +
                '<br>Vui lòng chấm điểm hồ sơ trước khi xếp hạng.';

            return;
        }

        /*
         * Gom điểm theo tiêu chí
         */
        const groupedScores = {};

        scores.forEach(
            evaluationScore => {

                const criterion =
                    evaluationScore.criterion;

                if (!criterion) {
                    return;
                }

                const criterionId =
                    criterion.id;

                if (!groupedScores[criterionId]) {

                    groupedScores[criterionId] = {
                        criterion: criterion,
                        scores: []
                    };

                }

                groupedScores[criterionId]
                    .scores
                    .push(
                        parseFloat(
                            evaluationScore.score
                        )
                    );
            }
        );

        let totalScore = 0;

        let html = `
            <strong>Chi tiết điểm:</strong>

            <div class="table-responsive mt-3">

                <table class="table table-bordered table-sm">

                    <thead class="table-light">

                        <tr>
                            <th>Tiêu chí</th>
                            <th>Điểm TB</th>
                            <th>Tối đa</th>
                            <th>Trọng số</th>
                            <th>Điểm đóng góp</th>
                        </tr>

                    </thead>

                    <tbody>
        `;

        Object.values(groupedScores).forEach(
            item => {

                const criterion =
                    item.criterion;

                const scores =
                    item.scores;

                const maxScore =
                    parseFloat(
                        criterion.max_score
                    );

                const weight =
                    parseFloat(
                        criterion.weight
                    );

                /*
                 * Điểm trung bình của các hội đồng
                 */
                const averageScore =
                    scores.reduce(
                        (sum, score) =>
                            sum + score,
                        0
                    ) / scores.length;

                /*
                 * Điểm đóng góp
                 */
                let contribution = 0;

                if (maxScore > 0) {

                    contribution =
                        (averageScore / maxScore)
                        * weight;
                }

                totalScore += contribution;

                html += `
                    <tr>

                        <td>
                            ${criterion.criteria_name}
                        </td>

                        <td>
                            ${averageScore.toFixed(2)}
                        </td>

                        <td>
                            ${maxScore.toFixed(2)}
                        </td>

                        <td>
                            ${weight.toFixed(2)}
                        </td>

                        <td>
                            ${contribution.toFixed(2)}
                        </td>

                    </tr>
                `;
            }
        );

        html += `
                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                <strong class="fs-5">
                    Tổng điểm:
                    ${totalScore.toFixed(2)} / 100
                </strong>

            </div>
        `;

        scorePreview.className =
            'alert alert-success';

        scorePreview.innerHTML =
            html;
    }
);

</script>

@endsection