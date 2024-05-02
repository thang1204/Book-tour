@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($tours as $tour)
                <div class="text-dark item-tour swiper-slide" style="min-height: 480px">
                    <div class="item-tour-image">
                        <img src="https://media.tacdn.com/media/attractions-splice-spp-674x446/0b/26/44/b5.jpg" alt="">
                    </div>
                    <div>
                        <h2><i class="fa-solid fa-map-location-dot fs-12"></i> {{ $tour->name }}</h2>
                        <p>{{ $tour->description }}</p>
                        <p>Time: {{ $tour->time }}</p>
                        <p>Price: {{ $tour->price }}$</p>
                    </div>
                    <a class="" href="">Book now</a>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
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
</script>
@endsection