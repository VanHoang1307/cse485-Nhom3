<!DOCTYPE html>
<html>

<head>
    <title>Sửa học bổng</title>
</head>


<body>


<h1>Cập nhật chương trình học bổng</h1>


<a href="{{ route('scholarships.index') }}">
    ← Quay lại danh sách
</a>


<br><br>



@if($errors->any())

<div style="color:red">

    <ul>

        @foreach($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

        @endforeach

    </ul>

</div>

@endif




<form 
    action="{{ route('scholarships.update',$scholarship->id) }}" 
    method="POST"
>


@csrf

@method('PUT')



<div>

<label>
    Tên chương trình:
</label>

<br>

<input 
    type="text"
    name="name"
    value="{{ old('name',$scholarship->name) }}"
>

</div>



<br>



<div>

<label>
    Mô tả:
</label>

<br>

<textarea name="description">{{ old('description',$scholarship->description) }}</textarea>

</div>



<br>



<div>

<label>
    Số tiền:
</label>

<br>

<input 
    type="number"
    name="amount"
    value="{{ old('amount',$scholarship->amount) }}"
>

</div>



<br>



<div>

<label>
    Năm học:
</label>

<br>

<input 
    type="number"
    name="academic_year"
    value="{{ old('academic_year',$scholarship->academic_year) }}"
>

</div>



<br>



<div>

<label>
    Học kỳ:
</label>

<br>


<select name="semester">


<option value="1"

@if($scholarship->semester == 1)

selected

@endif

>
Học kỳ 1
</option>



<option value="2"

@if($scholarship->semester == 2)

selected

@endif

>
Học kỳ 2
</option>


</select>


</div>



<br>



<div>

<label>
    Ngày bắt đầu:
</label>

<br>

<input 
    type="date"
    name="start_date"
    value="{{ $scholarship->start_date }}"
>

</div>



<br>



<div>

<label>
    Ngày kết thúc:
</label>

<br>

<input 
    type="date"
    name="end_date"
    value="{{ $scholarship->end_date }}"
>

</div>



<br>



<div>

<label>
    Trạng thái:
</label>

<br>


<select name="status">


<option value="active"

@if($scholarship->status == 'active')

selected

@endif

>
Đang hoạt động
</option>



<option value="inactive"

@if($scholarship->status == 'inactive')

selected

@endif

>
Đã đóng
</option>


</select>


</div>



<br>



<button type="submit">
    Cập nhật
</button>



</form>



</body>

</html>