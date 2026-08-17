<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Chi tiết điểm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container py-4">

    <div class="d-flex justify-content-between mb-4">

        <h2>
            Chi tiết điểm đánh giá
        </h2>

        <a href="{{ route('evaluation_scores.index') }}"
           class="btn btn-secondary">

            ← Quay lại

        </a>

    </div>


    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="250">
                        Hồ sơ
                    </th>

                    <td>

                        {{ $evaluationScore->application->application_code ?? 'Không xác định' }}

                    </td>

                </tr>


                <tr>

                    <th>
                        Tiêu chí
                    </th>

                    <td>

                        {{ $evaluationScore->criterion->name ?? 'Không xác định' }}

                    </td>

                </tr>


                <tr>

                    <th>
                        Hội đồng
                    </th>

                    <td>

                        {{ $evaluationScore->committee->name ?? 'Không xác định' }}

                    </td>

                </tr>


                <tr>

                    <th>
                        Điểm
                    </th>

                    <td>

                        <strong class="fs-4">

                            {{ $evaluationScore->score }}

                        </strong>

                    </td>

                </tr>


                <tr>

                    <th>
                        Nhận xét
                    </th>

                    <td>

                        {{ $evaluationScore->comment ?? 'Không có nhận xét' }}

                    </td>

                </tr>

            </table>


            <a href="{{ route('evaluation_scores.edit', $evaluationScore->id) }}"
               class="btn btn-warning">

                Sửa điểm

            </a>

        </div>

    </div>

</div>

</body>

</html>