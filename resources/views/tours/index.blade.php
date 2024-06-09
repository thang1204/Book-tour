@extends('layouts.app')

@section('content')
<div class="top mb-5">
    @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
    @endif
    <img src="https://dolcehanoigoldenlake.com/wp-content/uploads/2024/04/hanoi01.jpg" alt="" class="image-top">
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
    <h1 class="text-align-center mb-3">Địa điểm ở Hà Nội<input type="button" value=""></h1>
    <a href="{{ route('tour.create') }}" class="my-4">Tạo Tour</a>
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
                            <p>{{ $tour->description }}</p>
                            <p><i class="fa-regular fa-clock me-1"></i>2 ngày 1 đêm</p>
                            <p style="font-size: 22px;
                            font-weight: bold;
                            float: right;
                            color: #00C1DE;"> {{ number_format($tour->price, 0, ',', '.') . ' VNĐ' }}</p>
                        <button class="btn-book-now" data-url="{{ route('bookings.store') }}" data-tour-id="{{ $tour->id }}">Book now</button>
                        </div>
                    </a>
                    <a href="{{ route('tour.edit', ['tour' => $tour->id]) }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                </div>
            </form>
        @endforeach
    </div>
    {{-- <div class="d-flex swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($tours as $tour)
                <div class="text-dark item-tour swiper-slide" style="min-height: 480px">
                    <div class="item-tour-image">
                        <img src="" alt="">
                    </div>
                    <div>
                        <h2><i class="fa-solid fa-map-location-dot fs-12"></i> {{ $tour->name }}</h2>
                        <p>{{ $tour->description }}</p>
                        <p>{{ $tour->time }}</p>
                        <p> {{ $tour->price }}$</p>
                    </div>
                    <button class="btn-book-now" data-url="{{ route('bookings.store') }}" data-tour-id="{{ $tour->id }}">Book now {{ $tour->id }}</button>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div> --}}
</div>
<script>
    var swiper = new Swiper(".mySwiper", {
      cssMode: true,
      slidesPerView: 3,
      spaceBetween: 30,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
      },
      mousewheel: true,
      keyboard: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    });
    
    $(document).ready(function() {
        $('.btn-book-now').click(function(event) {
            event.preventDefault();
            const url = $(this).attr('data-url');
            const tourId = $(this).data('tour-id');
            $.ajax({
                url: url,
                data: {
                    tour_id: tourId,
                },
                success: function(response) {
                    window.location.href = '/bookings';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
   
</script>
@endsection