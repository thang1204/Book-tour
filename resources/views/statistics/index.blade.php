@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thống Kê Đặt Tour</h1>

    <div class="mb-3">
        <form method="GET" action="{{ route('statistics.index') }}" class="d-inline">
            @if($previousYear)
                <input type="hidden" name="year" value="{{ $previousYear }}">
                <button type="submit" class="btn btn-primary">&laquo; Năm Trước</button>
            @endif
        </form>
        <span class="mx-2">Năm: {{ $selectedYear }}</span>
        <form method="GET" action="{{ route('statistics.index') }}" class="d-inline">
            @if($nextYear)
                <input type="hidden" name="year" value="{{ $nextYear }}">
                <button type="submit" class="btn btn-primary">Năm Sau &raquo;</button>
            @endif
        </form>
    </div>

    <!-- Tổng Quan -->
    <div class="card mb-4">
        <div class="card-header">
            Tổng Quan (Năm {{ $selectedYear }})
        </div>
        <div class="card-body">
            <p><strong>Tổng số tour:</strong> {{ $totalTours }}</p>
            <p><strong>Tổng số lượt đặt tour:</strong> {{ $totalBookings }}</p>
            <p><strong>Tổng số người lớn:</strong> {{ $totalAdults }}</p>
            <p><strong>Tổng số trẻ em:</strong> {{ $totalChildren }}</p>
            <p><strong>Tổng doanh thu:</strong> {{ number_format($totalRevenue) }} VND</p>
        </div>
    </div>

    <!-- Biểu Đồ Thống Kê -->
    <div class="card">
        <div class="card-header">
            Biểu Đồ Thống Kê Số Lượt Đặt Tour Theo Tháng (Năm {{ $selectedYear }})
        </div>
        <div class="card-body">
            <canvas id="bookingsChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('bookingsChart').getContext('2d');
        const bookingsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Số lượt đặt tour',
                    data: {!! json_encode($bookingsCount) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
