@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách hội đồng xét duyệt</h2>

        <a href="{{ route('evaluation-committees.create') }}"
           class="btn btn-primary">
            Thêm hội đồng
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Chương trình học bổng</th>
                <th>Tên hội đồng</th>
                <th>Chủ tịch</th>
                <th>Ngày quyết định</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>
            @forelse($committees as $committee)
                <tr>
                    <td>{{ $committee->id }}</td>

                    <td>
                        {{ $committee->scholarshipProgram->name }}
                    </td>

                    <td>
                        {{ $committee->committee_name }}
                    </td>

                    <td>
                        {{ $committee->chairman }}
                    </td>

                    <td>
                        {{ $committee->decision_date }}
                    </td>

                    <td>
                        {{ $committee->status }}
                    </td>

                    <td>
                        <a href="{{ route('evaluation-committees.show', $committee) }}"
                           class="btn btn-info btn-sm">
                            Xem
                        </a>

                        <a href="{{ route('evaluation-committees.edit', $committee) }}"
                           class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <form action="{{ route('evaluation-committees.destroy', $committee) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa hội đồng này?')">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Chưa có hội đồng xét duyệt.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection