@extends('layouts.app')

@section('title','Thêm chương trình học bổng')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h3 class="mb-0">
                    Thêm chương trình học bổng
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

                <form action="{{ route('scholarships.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Tên chương trình
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            value="{{ old('name') }}"
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
                        >{{ old('description') }}</textarea>

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
                                value="{{ old('amount') }}"
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
                                placeholder="2026-2027"
                                value="{{ old('academic_year') }}"
                            >

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Học kỳ
                            </label>

                            <select
                                class="form-select"
                                name="semester">

                                <option value="1"
                                    {{ old('semester') == 1 ? 'selected' : '' }}>
                                    Học kỳ 1
                                </option>

                                <option value="2"
                                    {{ old('semester') == 2 ? 'selected' : '' }}>
                                    Học kỳ 2
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Trạng thái
                            </label>

                            <select
                                class="form-select"
                                name="status">

                                <option value="active">
                                    Đang mở
                                </option>

                                <option value="closed">
                                    Đã đóng
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
                                value="{{ old('start_date') }}"
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
                                value="{{ old('end_date') }}"
                            >

                        </div>

                    </div>

                    <div class="d-flex gap-2">

                        <button
                            class="btn btn-success">

                            Lưu học bổng

                        </button>

                        <a
                            href="{{ route('scholarships.index') }}"
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