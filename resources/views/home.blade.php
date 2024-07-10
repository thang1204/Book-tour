@extends('layouts.app')

@section('content')
<div class="top mb-5">
    @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
    @endif
    <img src="https://www.sony.com.vn/image/bc6d25fa6371c2899ce704a2bed7614c?fmt=png-alpha&wid=960" alt="" class="image-top">
    <div class="form-search">
        <h1 class="text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 1)">Thế giới trong tay bạn</h1>
        <p class="text-white fs-30px" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 1); font-size:24px;">Phục vụ tận tâm, giá siêu ưu đãi</p>
        <select id="area-search" class="input-search" style="width: 100%;">
            <option value="" disabled selected>Bạn muốn đi đâu?</option>
        </select>
    </div>
</div>
<div class="container">
    
    <h1 class="text-align-center mb-5">Những địa điểm hấp dẫn trong nước</h1>
    <div class="image-list">
        @foreach($areas as $area)
            <a href="{{ route('areas.index', ['area_id' => $area->id]) }}" class="item-image-top mb-3">
                <img src="{{ $area->thumbnail }}" alt="">
                <h5 class="text-image-top">{{ $area->name }}</h5>
            </a>
        @endforeach
    </div>


    <div class="d-flex justify-content-center my-5">
        <hr class="hr-line">
        <div class="px-2" style="min-width: fit-content;">
            Why you are seeing these recommendations
        </div>
        <hr class="hr-line">
    </div>
    {{--  --}}
    <h1 class="text-align-center mb-5">Why book with WinND</h1>
    <div class="d-flex justify-content-between">
        <div class="text-align-center" style="width:25%">
            <i class="fa-solid fa-money-bill"></i>
            <p>Hủy miễn phí</p>
            <p>Linh hoạt trong chuyến đi của bạn</p>
        </div>
        <div class="text-align-center" style="width:25%">
            <i class="fa-solid fa-photo-film"></i>
            <p>Hơn 300,00 trải nghiệm</p>
            <p>Tạo nên những kỷ niệm trên khắp thế giới.</p>
        </div>
        <div class="text-align-center" style="width:25%">
            <i class="fa-regular fa-calendar"></i>
            <p>Đặt trước, thanh toán sau</p>
            <p>Đặt chỗ của bạn.</p>
        </div>
        <div class="text-align-center" style="width:25%">
            <i class="fa-regular fa-star"></i>
            <p>Đánh giá đáng tin cậy</p>
            <p>4,5 sao từ hơn 140.000 đánh giá của Trustpilot.</p>
        </div>
    </div>

    <div class="d-flex justify-content-center my-5">
        <hr class="hr-line">
        <div class="px-2" style="min-width: fit-content;">
            Why you are seeing these recommendations
        </div>
        <hr class="hr-line">
    </div>

    {{--  --}}


    <h1 class="text-align-center mb-3">Điểm đến yêu thích nước ngoài</h1>
    
</div>
<script>
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


    $(document).ready(function() {
        $('#area-search').select2({
            placeholder: "Bạn muốn đi đâu?",
            ajax: {
                url: '{{ route('areas.search') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('#area-search').on('select2:select', function (e) {
            var data = e.params.data;
            window.location.href = '/areas/' + data.id;
        });
    });
</script>
@endsection