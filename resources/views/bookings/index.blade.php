@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Danh sách Tour đã đặt</h1>
    @if($bookings->isEmpty())
        <p>Bạn chưa đặt tour nào.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tour</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Khu vực</th>
                    <th>Khách sạn</th>
                    <th>Phương tiện</th>
                    <th>Hướng dẫn viên</th>
                    <th>Số người lớn</th>
                    <th>Số trẻ em</th>
                    <th>Tổng giá</th>
                    <th>Mã đơn</th>
                    <th>Thời gian đặt tour</th>
                    <th>Trạng thái thanh toán</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        {{-- <td>{{ $booking->tour->name }}</td> --}}
                        <td>{{ optional($booking->tour)->name }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->end_date }}</td>
                        <td>{{ $booking->tour->area->name ?? 'N/A' }}</td>
                        <td>{{ $booking->tour->hotel->name ?? 'N/A' }}</td>
                        <td>{{ $booking->tour->vehicle->type ?? 'N/A' }}</td>
                        <td>{{ $booking->tour->guide->name ?? 'N/A' }}</td>
                        <td>{{ $booking->number_of_adults }}</td>
                        <td>{{ $booking->number_of_children }}</td>
                        <td>{{ number_format($booking->total_price) }},000VND</td>
                        <td>{{ $booking->order_code }}</td>
                        <td>{{ $booking->created_at }}</td>
                        <td class="text-center">
                            @if ($booking->payment_status == 'unpaid')
                                <span class="badge bg-secondary p-2">Chưa thanh toán</span>
                            @elseif ($booking->payment_status == 'deposit')
                                <span class="badge bg-warning text-dark p-2">Đã đặt cọc</span>
                            @elseif ($booking->payment_status == 'paid')
                                <span class="badge bg-success p-2">Đã thanh toán</span>
                            @else
                                <span class="badge bg-dark p-2">Không xác định</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy tour này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hủy</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
<script>
     $(document).ready(function() {
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif

        @if(session('success'))
            toastr.success('{{ session('success') }}');
        @endif
    });
</script>
@endsection