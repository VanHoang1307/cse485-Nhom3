<!DOCTYPE html>
<html>

<head>
    <title>Danh sách học bổng</title>
</head>


<body>


<h1>Danh sách chương trình học bổng</h1>


@if(session('success'))

<p style="color: green;">
    {{ session('success') }}
</p>

@endif



<a href="{{ route('scholarships.create') }}">
    + Thêm chương trình học bổng
</a>


<br><br>


<table border="1" cellpadding="10" cellspacing="0">


<tr>

    <th>ID</th>

    <th>Tên chương trình</th>

    <th>Mô tả</th>

    <th>Số tiền</th>

    <th>Năm học</th>

    <th>Học kỳ</th>

    <th>Trạng thái</th>

    <th>Thao tác</th>

</tr>



@foreach($scholarships as $item)


<tr>


    <td>
        {{ $item->id }}
    </td>


    <td>
        {{ $item->name }}
    </td>


    <td>
        {{ $item->description }}
    </td>


    <td>
        {{ number_format($item->amount) }} VNĐ
    </td>


    <td>
        {{ $item->academic_year }}
    </td>


    <td>

        @if($item->semester == 1)

            Học kỳ 1

        @elseif($item->semester == 2)

            Học kỳ 2

        @else

            {{ $item->semester }}

        @endif

    </td>


    <td>

        @if($item->status == 'active')

            Đang mở

        @else

            Đã đóng

        @endif

    </td>



    <td>


        <a href="{{ route('scholarships.show',$item->id) }}">
            Xem
        </a>


        |


        <a href="{{ route('scholarships.edit',$item->id) }}">
            Sửa
        </a>


        |



        <form 
            action="{{ route('scholarships.destroy',$item->id) }}"
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