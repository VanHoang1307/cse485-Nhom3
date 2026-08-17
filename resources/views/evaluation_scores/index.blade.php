<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chấm điểm hồ sơ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Chấm điểm hồ sơ</h2>

            <p class="text-muted mb-0">
                Quản lý điểm đánh giá học bổng
            </p>
        </div>

        <a href="{{ route('evaluation_scores.create') }}"
           class="btn btn-primary">

            + Thêm điểm

        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    <div class="card shadow-sm">

        <div class="card-body">

            @if($scores->count())

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-primary">

                            <tr>

                                <th>STT</th>

                                <th>Hồ sơ</th>

                                <th>Tiêu chí</th>

                                <th>Hội đồng</th>

                                <th>Điểm</th>

                                <th>Nhận xét</th>

                                <th>Thao tác</th>

                            </tr>

                        </thead>


                        <tbody>

                        @foreach($scores as $score)

                            <tr>

                                <td>
                                    {{ $scores->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    @if($score->application)

                                        {{ $score->application->application_code }}

                                    @else

                                        Không xác định

                                    @endif

                                </td>

                                <td>

                                    @if($score->criterion)

                                        {{ $score->criterion->name }}

                                    @else

                                        Không xác định

                                    @endif

                                </td>

                                <td>

                                    @if($score->committee)

                                        {{ $score->committee->name }}

                                    @else

                                        Không xác định

                                    @endif

                                </td>

                                <td>

                                    <strong>
                                        {{ $score->score }}
                                    </strong>

                                </td>

                                <td>

                                    {{ $score->comment ?? 'Không có' }}

                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a href="{{ route('evaluation_scores.show', $score->id) }}"
                                           class="btn btn-sm btn-info text-white">

                                            Xem

                                        </a>


                                        <a href="{{ route('evaluation_scores.edit', $score->id) }}"
                                           class="btn btn-sm btn-warning">

                                            Sửa

                                        </a>


                                        <form action="{{ route('evaluation_scores.destroy', $score->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Bạn có chắc muốn xóa điểm này?');">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">

                                                Xóa

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>


                <div class="mt-3">

                    {{ $scores->links() }}

                </div>

            @else

                <div class="text-center py-5">

                    <h5 class="text-muted">
                        Chưa có điểm đánh giá
                    </h5>

                    <a href="{{ route('evaluation_scores.create') }}"
                       class="btn btn-primary mt-2">

                        + Thêm điểm

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

</body>

</html>