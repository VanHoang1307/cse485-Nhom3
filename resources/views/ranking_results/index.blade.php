@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                Kết quả xếp hạng
            </h2>

            <p class="text-muted mb-0">
                Kết quả tổng hợp và xếp hạng hồ sơ học bổng
            </p>
        </div>

        <a
            href="{{ route('ranking-results.create') }}"
            class="btn btn-primary"
        >
            + Tạo kết quả xếp hạng
        </a>

    </div>

    {{-- Thông báo thành công --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    {{-- Thông báo lỗi --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    {{-- Giải thích --}}
    <div class="alert alert-info">

        <strong>Cách tính:</strong>

        Tổng điểm được hệ thống tự động tính từ các điểm đánh giá
        của hồ sơ theo <strong>trọng số của từng tiêu chí</strong>.

        Tổng điểm tối đa là <strong>100 điểm</strong>.

    </div>

    <div class="card shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle mb-0">

                    <thead class="table-primary">

                        <tr>

                            <th style="width: 60px;">
                                STT
                            </th>

                            <th>
                                Hồ sơ
                            </th>

                            <th>
                                Sinh viên
                            </th>

                            <th>
                                Chương trình học bổng
                            </th>

                            <th style="width: 120px;">
                                Tổng điểm
                            </th>

                            <th style="width: 110px;">
                                Thứ hạng
                            </th>

                            <th style="width: 120px;">
                                Kết quả
                            </th>

                            <th style="width: 210px;" class="text-center">
                                Thao tác
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($results as $result)

                        <tr>

                            {{-- STT --}}
                            <td>
                                {{ $results->firstItem() + $loop->index }}
                            </td>

                            {{-- Hồ sơ --}}
                            <td>

                                @if($result->application)

                                    <strong>
                                        {{ $result->application->application_code }}
                                    </strong>

                                @else

                                    <span class="text-muted">
                                        Không xác định
                                    </span>

                                @endif

                            </td>

                            {{-- Sinh viên --}}
                            <td>

                                @if(
                                    $result->application &&
                                    $result->application->student
                                )

                                    {{ $result->application->student->full_name }}

                                @else

                                    <span class="text-muted">
                                        Không xác định
                                    </span>

                                @endif

                            </td>

                            {{-- Chương trình --}}
                            <td>

                                @if(
                                    $result->application &&
                                    $result->application->scholarshipProgram
                                )

                                    {{ $result->application->scholarshipProgram->name }}

                                @else

                                    <span class="text-muted">
                                        Không xác định
                                    </span>

                                @endif

                            </td>

                            {{-- Tổng điểm --}}
                            <td>

                                <span class="badge bg-success fs-6">

                                    {{ number_format((float) $result->total_score, 2) }}

                                </span>

                                <small class="text-muted">
                                    / 100
                                </small>

                            </td>

                            {{-- Thứ hạng --}}
                            <td>

                                @if($result->ranking > 0)

                                    @if($result->ranking == 1)

                                        <span class="badge bg-warning text-dark">
                                            🥇 Hạng 1
                                        </span>

                                    @elseif($result->ranking == 2)

                                        <span class="badge bg-secondary">
                                            🥈 Hạng 2
                                        </span>

                                    @elseif($result->ranking == 3)

                                        <span class="badge bg-danger">
                                            🥉 Hạng 3
                                        </span>

                                    @else

                                        <span class="badge bg-primary">
                                            Hạng {{ $result->ranking }}
                                        </span>

                                    @endif

                                @else

                                    <span class="text-muted">
                                        Chưa xếp hạng
                                    </span>

                                @endif

                            </td>

                            {{-- Kết quả --}}
                            <td>

                                @if($result->result === 'Qualified')

                                    <span class="badge bg-success">
                                        Đạt
                                    </span>

                                @elseif($result->result === 'Not Qualified')

                                    <span class="badge bg-danger">
                                        Không đạt
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ $result->result }}
                                    </span>

                                @endif

                            </td>

                            {{-- Thao tác --}}
                            <td>

                                <div class="d-flex justify-content-center gap-1">

                                    <a
                                        href="{{ route('ranking-results.show', $result) }}"
                                        class="btn btn-sm btn-info text-white"
                                    >
                                        Xem
                                    </a>

                                    <a
                                        href="{{ route('ranking-results.edit', $result) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Sửa
                                    </a>

                                    <form
                                        action="{{ route('ranking-results.destroy', $result) }}"
                                        method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa kết quả này không?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                        >
                                            Xóa
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5"
                            >

                                <h5 class="text-muted">
                                    Chưa có kết quả xếp hạng
                                </h5>

                                <p class="text-muted mb-3">
                                    Hãy chấm điểm hồ sơ trước,
                                    sau đó tạo kết quả xếp hạng.
                                </p>

                                <a
                                    href="{{ route('ranking-results.create') }}"
                                    class="btn btn-primary"
                                >
                                    + Tạo kết quả xếp hạng
                                </a>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Phân trang --}}
    @if($results->hasPages())

        <div class="d-flex justify-content-center mt-4">

            {{ $results->links() }}

        </div>

    @endif

</div>

@endsection