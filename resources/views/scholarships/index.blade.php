@extends('layouts.app')

@section('title', 'Danh sách học bổng')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h3 class="mb-0">
            Danh sách chương trình học bổng
        </h3>

        <a href="{{ route('scholarships.create') }}"
           class="btn btn-light">

            + Thêm chương trình học bổng

        </a>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- Form tìm kiếm --}}
        <form method="GET"
              action="{{ route('scholarships.index') }}"
              class="row g-3 mb-4">

            <div class="col-md-8">

                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Nhập tên chương trình học bổng..."
                    value="{{ request('keyword') }}">

            </div>

            <div class="col-md-4">

                <button class="btn btn-primary">

                    Tìm kiếm

                </button>

                <a href="{{ route('scholarships.index') }}"
                   class="btn btn-secondary">

                    Làm mới

                </a>

            </div>

        </form>

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Tên chương trình</th>

                    <th>Mô tả</th>

                    <th>Số tiền</th>

                    <th>Năm học</th>

                    <th>Học kỳ</th>

                    <th>Trạng thái</th>

                    <th width="220">
                        Thao tác
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($scholarships as $item)

                <tr>

                    <td>{{ $item->id }}</td>

                    <td>{{ $item->name }}</td>

                    <td>{{ $item->description }}</td>

                    <td>{{ number_format($item->amount) }} VNĐ</td>

                    <td>{{ $item->academic_year }}</td>

                    <td>

                        Học kỳ {{ $item->semester }}

                    </td>

                    <td>

                        @if($item->status == 'active')

                            <span class="badge bg-success">

                                Đang hoạt động

                            </span>

                        @elseif($item->status == 'draft')

                            <span class="badge bg-warning text-dark">

                                Nháp

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                Đã đóng

                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('scholarships.show',$item->id) }}"
                           class="btn btn-info btn-sm text-white">

                            Xem

                        </a>

                        <a href="{{ route('scholarships.edit',$item->id) }}"
                           class="btn btn-warning btn-sm">

                            Sửa

                        </a>

                        <form action="{{ route('scholarships.destroy',$item->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc muốn xóa?')">

                                Xóa

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center text-muted">

                        Chưa có chương trình học bổng nào.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="d-flex justify-content-center">

            {{ $scholarships->links() }}

        </div>

    </div>

</div>

@endsection