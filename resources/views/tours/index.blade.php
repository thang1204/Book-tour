@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quản lý Tour</h1>
    <a href="{{ route('tour.create') }}" class="my-4 create-tour-btn">Tạo Tour</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Tour</th>
                <th>Khu vực</th>
                <th>Khách sạn</th>
                <th>Phương tiện</th>
                <th>Hướng dẫn viên</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Giá (VND)</th>
                <th>Số lượng người tham gia</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tours as $tour)
                <tr>
                    <td>{{ $tour->id }}</td>
                    <td>{{ $tour->name }}</td>
                    <td>{{ $tour->area->name }}</td>
                    <td>{{ $tour->hotel->name ?? 'N/A' }}</td>
                    <td>{{ $tour->vehicle->model ?? 'N/A' }}</td>
                    <td>{{ $tour->guide->name ?? 'N/A' }}</td>
                    <td>
                        @if ($tour->tourDates->isNotEmpty())
                            @foreach ($tour->tourDates as $index => $tourDate)
                                {{ \Carbon\Carbon::parse($tourDate->start_date)->format('d/m/Y') }}<br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($tour->tourDates->isNotEmpty())
                            @foreach ($tour->tourDates as $index => $tourDate)
                                {{ \Carbon\Carbon::parse($tourDate->end_date)->format('d/m/Y') }}<br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ number_format($tour->price, 0, ',', '.') }}.000₫</td>
                    <td>{{ $tour->number_of_participants }}</td>
                    <td>
                        <a href="{{ route('tour.edit', ['tour' => $tour->id]) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                        <form action="{{ route('tour.destroy', ['tour' => $tour->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tours->links() }}
</div>
@endsection