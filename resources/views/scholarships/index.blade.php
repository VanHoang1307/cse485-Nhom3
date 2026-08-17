@extends('layouts.app')

@section('title', 'Danh sách học bổng')

@section('content')

<div class="card shadow-sm border-0">

    {{-- Header --}}
    <div class="card-header bg-primary text-white p-3">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>
                <h3 class="mb-1">
                    🎓 Danh sách chương trình học bổng
                </h3>

                <small>
                    Quản lý các chương trình học bổng của hệ thống
                </small>
            </div>

            <a href="{{ route('scholarships.create') }}"
               class="btn btn-light fw-semibold">

                + Thêm chương trình

            </a>

        </div>

    </div>

    <div class="card-body p-4">

        {{-- Thông báo thành công --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">

                <strong>✓ Thành công!</strong>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif

        {{-- Thông báo lỗi --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show"
                 role="alert">

                <strong>⚠ Không thể thực hiện!</strong>
                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        @endif

        {{-- Form tìm kiếm --}}
        <form method="GET"
              action="{{ route('scholarships.index') }}"
              class="row g-2 mb-4">

            <div class="col-12 col-md-8">

                <label class="form-label fw-semibold">
                    Tìm kiếm
                </label>

                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Nhập tên chương trình học bổng..."
                    value="{{ request('keyword') }}">

            </div>

            <div class="col-12 col-md-4 d-flex align-items-end gap-2">

                <button type="submit"
                        class="btn btn-primary">

                    🔍 Tìm kiếm

                </button>

                <a href="{{ route('scholarships.index') }}"
                   class="btn btn-outline-secondary">

                    Làm mới

                </a>

            </div>

        </form>

        {{-- Thông tin kết quả --}}
        @if($scholarships->total() > 0)

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div class="text-muted">

                    Hiển thị
                    <strong>{{ $scholarships->firstItem() }}</strong>
                    -
                    <strong>{{ $scholarships->lastItem() }}</strong>
                    trong tổng số
                    <strong>{{ $scholarships->total() }}</strong>
                    chương trình

                </div>

                @if(request('keyword'))

                    <span class="badge bg-info text-dark">

                        Kết quả tìm kiếm:
                        "{{ request('keyword') }}"

                    </span>

                @endif

            </div>

        @endif

        {{-- Bảng dữ liệu --}}
        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle mb-0">

                <thead class="table-dark">

                    <tr>

                        <th class="text-center">
                            ID
                        </th>

                        <th>
                            Tên chương trình
                        </th>

                        <th>
                            Mô tả
                        </th>

                        <th class="text-end">
                            Số tiền
                        </th>

                        <th>
                            Năm học
                        </th>

                        <th class="text-center">
                            Học kỳ
                        </th>

                        <th class="text-center">
                            Trạng thái
                        </th>

                        <th class="text-center">
                            Thao tác
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($scholarships as $item)

                    <tr>

                        <td class="text-center fw-semibold">
                            {{ $item->id }}
                        </td>

                        <td>

                            <div class="fw-semibold">
                                {{ $item->name }}
                            </div>

                            <small class="text-muted">
                                Chương trình #{{ $item->id }}
                            </small>

                        </td>

                        <td>

                            @if($item->description)

                                <span title="{{ $item->description }}">

                                    {{ \Illuminate\Support\Str::limit($item->description, 50) }}

                                </span>

                            @else

                                <span class="text-muted fst-italic">
                                    Chưa có mô tả
                                </span>

                            @endif

                        </td>

                        <td class="text-end fw-semibold">

                            {{ number_format($item->amount, 0, ',', '.') }}
                            VNĐ

                        </td>

                        <td>
                            {{ $item->academic_year }}
                        </td>

                        <td class="text-center">

                            <span class="badge bg-light text-dark border">

                                HK{{ $item->semester }}

                            </span>

                        </td>

                        <td class="text-center">

                            @if($item->status === 'active')

                                <span class="badge bg-success">
                                    ● Đang hoạt động
                                </span>

                            @elseif($item->status === 'draft')

                                <span class="badge bg-warning text-dark">
                                    ● Nháp
                                </span>

                            @elseif($item->status === 'closed')

                                <span class="badge bg-secondary">
                                    ● Đã đóng
                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            <div class="d-flex flex-wrap justify-content-center gap-1">

                                {{-- Xem --}}
                                <a href="{{ route('scholarships.show', $item->id) }}"
                                   class="btn btn-info btn-sm text-white"
                                   title="Xem chi tiết">

                                    👁 Xem

                                </a>

                                {{-- Sửa --}}
                                @if($item->status !== 'closed')

                                    <a href="{{ route('scholarships.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm"
                                       title="Chỉnh sửa">

                                        ✏ Sửa

                                    </a>

                                @endif

                                {{-- Đóng chương trình --}}
                                @if($item->status !== 'closed')

                                    <form action="{{ route('scholarships.close', $item->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                                class="btn btn-secondary btn-sm"
                                                title="Đóng chương trình"
                                                onclick="return confirm('Bạn có chắc muốn đóng chương trình học bổng này? Dữ liệu lịch sử sẽ được giữ lại.')">

                                            🔒 Đóng

                                        </button>

                                    </form>

                                @endif

                                {{-- Xóa --}}
                                @if($item->status !== 'closed')

                                    <form action="{{ route('scholarships.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Xóa chương trình"
                                                onclick="return confirm('Bạn có chắc muốn xóa chương trình này? Chỉ nên xóa chương trình chưa có dữ liệu liên quan.')">

                                            🗑 Xóa

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="text-center py-5">

                            <div class="fs-1 mb-2">
                                📭
                            </div>

                            @if(request('keyword'))

                                <h5>
                                    Không tìm thấy chương trình
                                </h5>

                                <p class="text-muted mb-3">

                                    Không có học bổng nào phù hợp với từ khóa
                                    "<strong>{{ request('keyword') }}</strong>".

                                </p>

                                <a href="{{ route('scholarships.index') }}"
                                   class="btn btn-outline-primary">

                                    Xem tất cả chương trình

                                </a>

                            @else

                                <h5>
                                    Chưa có chương trình học bổng
                                </h5>

                                <p class="text-muted mb-3">

                                    Hãy thêm chương trình học bổng đầu tiên.

                                </p>

                                <a href="{{ route('scholarships.create') }}"
                                   class="btn btn-primary">

                                    + Thêm chương trình

                                </a>

                            @endif

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- Phân trang --}}
        @if($scholarships->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $scholarships->links() }}

            </div>

        @endif

    </div>

</div>

@endsection

