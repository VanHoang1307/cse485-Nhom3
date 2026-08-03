<!DOCTYPE html>
<html>

<head>
    <title>Thêm học bổng</title>
</head>


<body>


<h1>Thêm chương trình học bổng</h1>


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




<form action="{{ route('scholarships.store') }}" method="POST">

@csrf



<div>

<label>
    Tên chương trình:
</label>

<br>

<input 
    type="text" 
    name="name"
    value="{{ old('name') }}"
>

</div>



<br>



<div>

<label>
    Mô tả:
</label>

<br>

<textarea name="description">{{ old('description') }}</textarea>

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
    value="{{ old('amount') }}"
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
    value="{{ old('academic_year') }}"
    placeholder="Ví dụ: 2026"
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
@if(old('semester') == 1)
selected
@endif
>
Học kỳ 1
</option>



<option value="2"
@if(old('semester') == 2)
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
    value="{{ old('start_date') }}"
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
    value="{{ old('end_date') }}"
>

</div>



<br>



<div>

<label>
    Trạng thái:
</label>

<br>


<select name="status">


<option value="active">
    Đang hoạt động
</option>


<option value="inactive">
    Đã đóng
</option>


</select>


</div>



<br>



<button type="submit">
    Lưu học bổng
</button>



</form>



</body>

</html>