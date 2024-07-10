@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách Tour đã đặt</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @if($bookings->isEmpty())
        <p>Bạn chưa đặt tour nào.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Tour</th>
                    <th>Ngày bắt đầu</th>
                    <th>Khu vực</th>
                    <th>Khách sạn</th>
                    <th>Phương tiện</th>
                    <th>Hướng dẫn viên</th>
                    <th>Số người lớn</th>
                    <th>Số trẻ em</th>
                    <th>Tổng giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->tour->name }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->tour->area->name ?? 'N/A' }}</td>
                        <td>{{ $booking->tour->hotel->name ?? 'N/A' }}</td>
                        <td>{{ $booking->tour->vehicle->type ?? 'N/A' }}</td>
                        <td>{{ $booking->tour->guide->name ?? 'N/A' }}</td>
                        <td>{{ $booking->number_of_adults }}</td>
                        <td>{{ $booking->number_of_children }}</td>
                        <td>{{ number_format($booking->total_price) }} VND</td>
                        <td>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy tour này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hủy Tour</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection