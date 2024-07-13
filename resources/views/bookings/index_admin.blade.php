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
                    <th>Khách hàng</th>
                    <th>Tour</th>
                    <th>Ngày bắt đầu</th>
                    <th>Khu vực</th>
                    <th>Khách sạn</th>
                    <th>Phương tiện</th>
                    <th>Hướng dẫn viên</th>
                    <th>Số người lớn</th>
                    <th>Số trẻ em</th>
                    <th>Tổng giá</th>
                    <th>Mã đơn</th>
                    <th>Trạng thái thanh toán</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->tour->name }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->tour->area->name ?? 'N/A' }}</td>
                        <td>{{ $booking->tour->hotel->name ?? 'N/A' }}</td>
                        <td>{{ $booking->tour->vehicle->type ?? 'N/A' }}</td>
                        <td>{{ $booking->tour->guide->name ?? 'N/A' }}</td>
                        <td>{{ $booking->number_of_adults }}</td>
                        <td>{{ $booking->number_of_children }}</td>
                        <td>{{ number_format($booking->total_price) }} VND</td>
                        <td>{{ $booking->order_code }}</td>
                        <td>
                            <select class="payment-status" data-booking-id="{{ $booking->id }}">
                                <option value="unpaid" {{ $booking->payment_status == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                                <option value="deposit" {{ $booking->payment_status == 'deposit' ? 'selected' : '' }}>Đã đặt cọc</option>
                                <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                            </select>
                        </td>
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

<script>
    $(document).ready(function() {
        $('.payment-status').change(function() {
            var bookingId = $(this).data('booking-id');
            var paymentStatus = $(this).val();

            $.ajax({
                url: '{{ route("bookings.updatePaymentStatus") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: bookingId,
                    payment_status: paymentStatus
                },
                success: function(response) {
                    alert('Cập nhật trạng thái thanh toán thành công');
                },
                error: function(response) {
                    alert('Cập nhật trạng thái thanh toán thất bại');
                }
            });
        });
    });
</script>
@endsection