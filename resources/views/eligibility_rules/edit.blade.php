<!DOCTYPE html>
<html>

<head>
    <title>Sửa điều kiện học bổng</title>
</head>


<body>


<h1>
    Cập nhật điều kiện xét học bổng
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
    action="{{ route('eligibility-rules.update',$rule->id) }}"
    method="POST"
>


@csrf

@method('PUT')



<div>

<label>
    Chương trình học bổng:
</label>

<br>


<select name="scholarship_program_id">


@foreach($scholarships as $scholarship)


<option 
    value="{{ $scholarship->id }}"

    @if($rule->scholarship_program_id == $scholarship->id)

        selected

    @endif

>

{{ $scholarship->name }}

</option>


@endforeach


</select>


</div>



<br>



<div>

<label>
    GPA tối thiểu:
</label>

<br>


<input 
    type="number"
    step="0.01"
    name="min_gpa"
    value="{{ $rule->min_gpa }}"
>


</div>



<br>



<div>

<label>
    Tín chỉ tối thiểu:
</label>

<br>


<input 
    type="number"
    name="min_credits"
    value="{{ $rule->min_credits }}"
>


</div>



<br>



<div>

<label>
    Cho phép nợ môn:
</label>

<br>


<select name="allow_debt_subject">


<option 
value="1"

@if($rule->allow_debt_subject == 1)

selected

@endif

>
Có
</option>



<option 
value="0"

@if($rule->allow_debt_subject == 0)

selected

@endif

>
Không
</option>



</select>


</div>



<br>



<div>

<label>
    Ghi chú:
</label>

<br>


<textarea name="note">{{ $rule->note }}</textarea>


</div>



<br>



<button type="submit">
    Cập nhật
</button>



</form>



</body>

</html>