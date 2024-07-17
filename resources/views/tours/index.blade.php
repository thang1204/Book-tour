@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Quản lý Tour</h1>
    <a href="{{ route('tour.create') }}" class="btn btn-primary mb-3">Tạo Tour</a>
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
                            @foreach ($tour->tourDates as $tourDate)
                                {{ \Carbon\Carbon::parse($tourDate->start_date)->format('d/m/Y') }}<br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($tour->tourDates->isNotEmpty())
                            @foreach ($tour->tourDates as $tourDate)
                                {{ \Carbon\Carbon::parse($tourDate->end_date)->format('d/m/Y') }}<br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ number_format($tour->price, 0, ',', '.') }}.000₫</td>
                    <td>{{ $tour->number_of_participants }}</td>
                    <td style="text-align: left; white-space: nowrap;">
                        <a href="{{ route('tour.edit', ['tour' => $tour->id]) }}" class="btn btn-warning btn-sm" style="display:inline;">Chỉnh sửa</a>
                        <form action="{{ route('tour.destroy', ['tour' => $tour->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tours->links() }}
</div>
@endsection