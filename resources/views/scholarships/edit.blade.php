@extends('layouts.app')

@section('title','Cập nhật học bổng')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow">

            <div class="card-header bg-warning">

                <h3 class="mb-0">
                    Cập nhật chương trình học bổng
                </h3>

            </div>

            <div class="card-body">

                @if($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('scholarships.update',$scholarship->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">
                            Tên chương trình
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            value="{{ old('name',$scholarship->name) }}"
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Mô tả
                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="description"
                        >{{ old('description',$scholarship->description) }}</textarea>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Số tiền
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                name="amount"
                                value="{{ old('amount',$scholarship->amount) }}"
                            >

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Năm học
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="academic_year"
                                value="{{ old('academic_year',$scholarship->academic_year) }}"
                            >

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Học kỳ
                            </label>

                            <select class="form-select" name="semester">

                                <option value="1"
                                    {{ old('semester',$scholarship->semester)==1 ? 'selected' : '' }}>
                                    Học kỳ 1
                                </option>

                                <option value="2"
                                    {{ old('semester',$scholarship->semester)==2 ? 'selected' : '' }}>
                                    Học kỳ 2
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Trạng thái
                            </label>

                            <select class="form-select" name="status">

                                <option value="active"
                                    {{ old('status',$scholarship->status)=='active' ? 'selected' : '' }}>
                                    Đang hoạt động
                                </option>

                                <option value="closed"
                                    {{ old('status',$scholarship->status)=='closed' ? 'selected' : '' }}>
                                    Đã đóng
                                </option>

                                <option value="draft"
                                    {{ old('status',$scholarship->status)=='draft' ? 'selected' : '' }}>
                                    Nháp
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Ngày bắt đầu
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                name="start_date"
                                value="{{ old('start_date',$scholarship->start_date) }}"
                            >

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Ngày kết thúc
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                name="end_date"
                                value="{{ old('end_date',$scholarship->end_date) }}"
                            >

                        </div>

                    </div>

                    <div class="mt-4 d-flex gap-2">

                        <button class="btn btn-warning">
                            Cập nhật
                        </button>

                        <a href="{{ route('scholarships.show',$scholarship->id) }}"
                           class="btn btn-info text-white">
                            Xem chi tiết
                        </a>

                        <a href="{{ route('scholarships.index') }}"
                           class="btn btn-secondary">
                            Quay lại
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection