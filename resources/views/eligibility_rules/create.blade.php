<!DOCTYPE html>
<html>

<head>
    <title>Thêm điều kiện học bổng</title>
</head>


<body>


<h1>
    Thêm điều kiện xét học bổng
</h1>


<a href="{{ route('eligibility-rules.index') }}">
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
action="{{ route('eligibility-rules.store') }}"
method="POST"
>


@csrf



<label>
    Chương trình học bổng:
</label>

<br>


<select name="scholarship_program_id">


@foreach($scholarships as $scholarship)


<option value="{{ $scholarship->id }}">

    {{ $scholarship->name }}

</option>


@endforeach


</select>



<br><br>



<label>
    GPA tối thiểu:
</label>

<br>


<input 
type="number"
step="0.01"
name="min_gpa"
value="{{ old('min_gpa') }}"
>


<br><br>



<label>
    Tín chỉ tối thiểu:
</label>

<br>


<input 
type="number"
name="min_credits"
value="{{ old('min_credits') }}"
>



<br><br>



<label>
    Cho phép nợ môn:
</label>

<br>


<select name="allow_debt_subject">


<option value="0">
    Không
</option>


<option value="1">
    Có
</option>


</select>



<br><br>



<label>
    Ghi chú:
</label>

<br>


<textarea name="note">{{ old('note') }}</textarea>



<br><br>



<button type="submit">
    Lưu điều kiện
</button>



</form>



</body>

</html>