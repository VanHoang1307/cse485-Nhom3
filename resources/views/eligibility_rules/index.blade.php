<!DOCTYPE html>
<html>

<head>
    <title>Danh sách điều kiện học bổng</title>
</head>


<body>


<h1>
    Danh sách điều kiện xét học bổng
</h1>



@if(session('success'))

<p style="color:green">
    {{ session('success') }}
</p>

@endif



<a href="{{ route('eligibility-rules.create') }}">
    + Thêm điều kiện
</a>


<br><br>



<a href="{{ route('scholarships.index') }}">
    ← Quay lại danh sách học bổng
</a>


<br><br>



<table border="1" cellpadding="10" cellspacing="0">


<tr>

    <th>ID</th>

    <th>Chương trình học bổng</th>

    <th>GPA tối thiểu</th>

    <th>Tín chỉ tối thiểu</th>

    <th>Nợ môn</th>

    <th>Ghi chú</th>

    <th>Thao tác</th>

</tr>



@foreach($rules as $rule)


<tr>


    <td>
        {{ $rule->id }}
    </td>



    <td>
        {{ $rule->scholarshipProgram->name }}
    </td>



    <td>
        {{ $rule->min_gpa }}
    </td>



    <td>
        {{ $rule->min_credits }}
    </td>



    <td>

        @if($rule->allow_debt_subject)

            Có

        @else

            Không

        @endif


    </td>



    <td>
        {{ $rule->note }}
    </td>



    <td>


        <a href="{{ route('eligibility-rules.edit',$rule->id) }}">
            Sửa
        </a>



        |



        <form 
            action="{{ route('eligibility-rules.destroy',$rule->id) }}"
            method="POST"
            style="display:inline;"
        >

            @csrf

            @method('DELETE')


            <button
                type="submit"
                onclick="return confirm('Bạn có chắc muốn xóa?')"
            >
                Xóa
            </button>


        </form>



    </td>


</tr>


@endforeach



</table>



</body>

</html>