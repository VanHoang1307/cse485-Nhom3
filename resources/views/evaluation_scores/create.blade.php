<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm điểm đánh giá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        <a href="{{ route('evaluation-scores.index') }}" class="btn btn-secondary">
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

            <form action="{{ route('evaluation-scores.store') }}" method="POST">
                @csrf

                {{-- Hồ sơ học bổng --}}
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
                                -
                                {{ $application->student->full_name ?? 'Không xác định' }}
                            </option>
                        @endforeach
                    </select>

                    <div id="programHelp" class="form-text">
                        Vui lòng chọn hồ sơ.
                    </div>
                </div>

                {{-- Tiêu chí đánh giá --}}
                <div class="mb-3">
                    <label class="form-label">
                        Tiêu chí đánh giá
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="criterion_id"
                        id="criterion_id"
                        class="form-select"
                        required
                        disabled
                    >
                        <option value="">
                            -- Chọn hồ sơ trước --
                        </option>
                    </select>

                    <div id="criterionHelp" class="form-text">
                        Tiêu chí sẽ được lấy theo chương trình học bổng của hồ sơ.
                    </div>
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
                        id="score"
                        class="form-control"
                        min="0"
                        step="0.01"
                        value="{{ old('score') }}"
                        required
                        disabled
                    >

                    <div id="scoreHelp" class="form-text">
                        Vui lòng chọn tiêu chí trước.
                    </div>
                </div>

                {{-- Hội đồng đánh giá --}}
                <div class="mb-3">
                    <label class="form-label">
                        Hội đồng đánh giá
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="committee_id"
                        id="committee_id"
                        class="form-select"
                        required
                        disabled
                    >
                        <option value="">
                            -- Chọn hồ sơ trước --
                        </option>
                    </select>

                    <div id="committeeHelp" class="form-text">
                        Hội đồng sẽ được lấy theo chương trình học bổng của hồ sơ.
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

<script>
const applicationSelect = document.getElementById('application_id');
const criterionSelect = document.getElementById('criterion_id');
const committeeSelect = document.getElementById('committee_id');
const scoreInput = document.getElementById('score');

const programHelp = document.getElementById('programHelp');
const criterionHelp = document.getElementById('criterionHelp');
const committeeHelp = document.getElementById('committeeHelp');
const scoreHelp = document.getElementById('scoreHelp');

const oldCriterion = "{{ old('criterion_id') }}";
const oldCommittee = "{{ old('committee_id') }}";

applicationSelect.addEventListener('change', function () {

    const applicationId = this.value;

    criterionSelect.innerHTML =
        '<option value="">-- Đang tải tiêu chí... --</option>';

    committeeSelect.innerHTML =
        '<option value="">-- Đang tải hội đồng... --</option>';

    criterionSelect.disabled = true;
    committeeSelect.disabled = true;
    scoreInput.disabled = true;

    scoreInput.value = '';
    scoreInput.removeAttribute('max');

    if (!applicationId) {
        criterionSelect.innerHTML =
            '<option value="">-- Chọn hồ sơ trước --</option>';

        committeeSelect.innerHTML =
            '<option value="">-- Chọn hồ sơ trước --</option>';

        programHelp.textContent =
            'Vui lòng chọn hồ sơ.';

        return;
    }

    fetch(
        "{{ route('evaluation-scores.application-data', ':id') }}"
            .replace(':id', applicationId)
    )
    .then(response => {

        if (!response.ok) {
            throw new Error('Không thể tải dữ liệu.');
        }

        return response.json();
    })
    .then(data => {

        /* Hiển thị chương trình */
        programHelp.textContent =
            'Chương trình học bổng: ' +
            (data.program ?? 'Không xác định');

        /* Tiêu chí */
        criterionSelect.innerHTML =
            '<option value="">-- Chọn tiêu chí --</option>';

        data.criteria.forEach(criterion => {

            const option = document.createElement('option');

            option.value = criterion.id;

            option.textContent =
                criterion.criteria_name +
                ' - Tối đa ' +
                parseFloat(criterion.max_score).toFixed(2) +
                ' điểm';

            option.dataset.maxScore = criterion.max_score;

            if (String(criterion.id) === String(oldCriterion)) {
                option.selected = true;
            }

            criterionSelect.appendChild(option);
        });

        criterionSelect.disabled =
            data.criteria.length === 0;

        if (data.criteria.length === 0) {
            criterionHelp.textContent =
                'Chương trình này chưa có tiêu chí đánh giá.';
        } else {
            criterionHelp.textContent =
                'Chỉ hiển thị tiêu chí thuộc chương trình của hồ sơ.';
        }

        /* Hội đồng */
        committeeSelect.innerHTML =
            '<option value="">-- Chọn hội đồng --</option>';

        data.committees.forEach(committee => {

            const option = document.createElement('option');

            option.value = committee.id;

            option.textContent =
                committee.committee_name;

            if (String(committee.id) === String(oldCommittee)) {
                option.selected = true;
            }

            committeeSelect.appendChild(option);
        });

        committeeSelect.disabled =
            data.committees.length === 0;

        if (data.committees.length === 0) {
            committeeHelp.textContent =
                'Chương trình này chưa có hội đồng đánh giá.';
        } else {
            committeeHelp.textContent =
                'Chỉ hiển thị hội đồng thuộc chương trình của hồ sơ.';
        }

        updateScoreLimit();

    })
    .catch(error => {

        console.error(error);

        criterionSelect.innerHTML =
            '<option value="">-- Không thể tải tiêu chí --</option>';

        committeeSelect.innerHTML =
            '<option value="">-- Không thể tải hội đồng --</option>';

        programHelp.textContent =
            'Có lỗi khi tải dữ liệu. Vui lòng thử lại.';
    });
});


criterionSelect.addEventListener(
    'change',
    updateScoreLimit
);


function updateScoreLimit() {

    const selectedOption =
        criterionSelect.options[criterionSelect.selectedIndex];

    if (!selectedOption || !selectedOption.dataset.maxScore) {

        scoreInput.disabled = true;
        scoreInput.removeAttribute('max');

        scoreHelp.textContent =
            'Vui lòng chọn tiêu chí trước.';

        return;
    }

    const maxScore =
        parseFloat(selectedOption.dataset.maxScore);

    scoreInput.disabled = false;
    scoreInput.max = maxScore;

    scoreHelp.textContent =
        'Điểm từ 0 đến ' +
        maxScore.toFixed(2) +
        ' theo tiêu chí đã chọn.';
}


/* Nếu quay lại form sau khi validation lỗi */
if (applicationSelect.value) {
    applicationSelect.dispatchEvent(
        new Event('change')
    );
}
</script>

</body>
</html>