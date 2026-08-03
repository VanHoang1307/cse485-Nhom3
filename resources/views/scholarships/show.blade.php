<!DOCTYPE html>
<html>

<head>
    <title>Chi tiết học bổng</title>
</head>


<body>


<h1>
    Chi tiết chương trình học bổng
</h1>



<a href="{{ route('scholarships.index') }}">
    ← Quay lại danh sách
</a>

|

<a href="{{ route('scholarships.edit',$scholarship->id) }}">
    Sửa
</a>


<br><br>



<h2>
    Thông tin học bổng
</h2>



<table border="1" cellpadding="10" cellspacing="0">


<tr>
    <th>Tên chương trình</th>
    <td>{{ $scholarship->name }}</td>
</tr>



<tr>
    <th>Mô tả</th>
    <td>{{ $scholarship->description }}</td>
</tr>



<tr>
    <th>Số tiền</th>
    <td>
        {{ number_format($scholarship->amount) }} VNĐ
    </td>
</tr>



<tr>
    <th>Năm học</th>
    <td>
        {{ $scholarship->academic_year }}
    </td>
</tr>



<tr>
    <th>Học kỳ</th>
    <td>

        @if($scholarship->semester == 1)

            Học kỳ 1

        @elseif($scholarship->semester == 2)

            Học kỳ 2

        @else

            {{ $scholarship->semester }}

        @endif

    </td>
</tr>



<tr>
    <th>Ngày bắt đầu</th>
    <td>
        {{ $scholarship->start_date }}
    </td>
</tr>



<tr>
    <th>Ngày kết thúc</th>
    <td>
        {{ $scholarship->end_date }}
    </td>
</tr>



<tr>
    <th>Trạng thái</th>

    <td>

        @if($scholarship->status == 'active')

            Đang hoạt động

        @else

            Đã đóng

        @endif

    </td>

</tr>



</table>



<br>



<h2>
    Điều kiện xét duyệt
</h2>



@if($scholarship->eligibilityRules->count() > 0)



<table border="1" cellpadding="10" cellspacing="0">


<tr>

    <th>
        GPA tối thiểu
    </th>


    <th>
        Tín chỉ tối thiểu
    </th>


    <th>
        Cho phép nợ môn
    </th>


    <th>
        Ghi chú
    </th>


</tr>



@foreach($scholarship->eligibilityRules as $rule)



<tr>


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


</tr>



@endforeach



</table>



@else


<p>
    Chưa có điều kiện xét duyệt.
</p>


@endif




</body>

</html>