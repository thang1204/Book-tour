@extends('layouts.app')

@section('content')
<div class="container top mb-5">
    @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
    @endif
    <img src="{{ asset($area->thumbnail) }}" alt="" class="image-top">
    <div class="form-search">
        <h1 class="text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 1)">Thế giới trong tay bạn</h1>
        <p class="text-white fs-30px" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 1); font-size:24px;">Phục vụ tận tâm, giá siêu ưu đãi</p>
        <div class="input-search">
            <input type="text" placeholder="Bạn muốn đi đâu ?" class="col-11">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>
</div>
<div class="container pb-5">
    <h1 class="text-align-center mb-3">Địa điểm ở {{ $area->name }}<input type="button" value=""></h1>
    {{-- <a href="{{ route('tour.create') }}" class="my-4 create-tour-btn">Tạo Tour</a> --}}
    <div class="list-tour">
        @foreach($tours as $tour)
            <form action="{{ route('tour.destroy', ['tour' => $tour->id]) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <div class="item-tour">

                    <a href="{{ route('tour.show', ['tour'=>$tour->id]) }}" class="text-dark ">
                        @if($tour->firstImage)
                            <div class="item-tour-image">
                                <img src="{{ $tour->firstImage->image }}" alt="Tour Image">
                            </div>
                        @else
                            <div class="item-tour-image">
                                <img src="/path/to/default-image.jpg" alt="Default Image">
                            </div>
                        @endif

                        <div class="p-3" style="max-width:400px">
                            <h2 style="color: #003C71;
                            font-size: 28px;
                            font-weight: bold;">{{ $tour->name }}</h2>
                            <p class="truncate-2-line">{{ $tour->description }}</p>
                            <p><i class="fa-solid fa-location-dot"  style="width: 25px"></i> Xuất phát từ {{ $area->name }}</p>
                            @php
                                $tourBookings = $bookings->where('tour_id', $tour->id);
                                $totalNumberOfAdults = $tourBookings->sum('number_of_adults');
                                $totalNumberOfChildren = $tourBookings->sum('number_of_children');
                                $totalNumberOfPeople = $totalNumberOfAdults + $totalNumberOfChildren;
                            @endphp
                            <p>
                                <i class="fa-solid fa-users" style="width: 25px"></i> 
                                Số lượng người tham gia {{ $totalNumberOfPeople }}/{{ $tour->number_of_participants }}
                                @if ($totalNumberOfPeople >= $tour->number_of_participants)
                                    <span style="color: red;">(Đã hết chỗ)</span>
                                @else
                                    <span style="">(Còn {{$tour->number_of_participants - $totalNumberOfPeople}} chỗ)</span>

                                @endif

                            </p>
                            <p><i class="fa-regular fa-clock me-1" style="width: 25px"></i>2 ngày 1 đêm</p>
                            <p style="font-size: 22px;
                            font-weight: bold;
                            color: #131142;"> {{ number_format($tour->price, 0, '.', '.') . '.000 VNĐ' }}</p>
                        </div>
                    </a>
                    {{-- <a href="{{ route('tour.edit', ['tour' => $tour->id]) }}" class="action-button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <button type="submit" class="action-button" style="background: none; border: none; padding: 0; cursor: pointer;">
                        <i class="fa-solid fa-trash"></i>
                    </button> --}}

                </div>
            </form>
        @endforeach
    </div>
</div>
@endsection