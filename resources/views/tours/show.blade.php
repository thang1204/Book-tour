@extends('layouts.app')

@section('content')
<div class="container pt-3" style="min-height: 880px;">
    <h1>{{ $tour->name }}</h1>
    <hr>
   <div class="d-flex">
        <div class="col-8">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($tour->images()->get() as $index => $image)
                        <div class="rounded-3 no-drag-title swiper-slide" style="
                            width: 500px;
                            height: 100%;
                            background-size: contain !important;
                            background-position: center !important;
                            background-repeat: no-repeat !important;
                            background-color: #dfdfdf !important;
                            border-radius: 8px;
                            aspect-ratio: 1.91 !important;
                            position: relative;
                            overflow: hidden;">
                                <img id="image-preview-{{ $index }}" src="{{ $image->image }}" alt="" style="
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            width: 100%;
                            height: 100%;
                            object-fit: contain;
                            transform: translate(-50%, -50%);">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="d-flex justify-content-center">
                @foreach($tour->images()->get() as $index => $image)
                    <div class="rounded-3 me-2" style="
                        width: 200px;
                        height: 100%;
                        background-size: contain !important;
                        background-position: center !important;
                        background-repeat: no-repeat !important;
                        background-color: #dfdfdf !important;
                        border-radius: 8px;
                        aspect-ratio: 1.91 !important;
                        position: relative;
                        overflow: hidden;">
                            <img id="image-preview-{{ $index }}" src="{{ $image->image }}" alt="" style="
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 100%;
                        height: 100%;
                        object-fit: contain;
                        transform: translate(-50%, -50%);">
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-evenly block-infor">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-location-dot me-1"></i>
                    <p class="m-0">Hà Nội</p>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fa-regular fa-clock me-1"></i>
                    <p class="m-0">3 ngày 2 đêm</p>
                </div>
                <div class="d-flex align-items-center">
                    <p class="m-0 me-1">Phương tiện: </p>
                    <i class="fa-solid fa-plane me-1"> </i>
                    <i class="fa-solid fa-bus"></i>
                </div>
                <p class="m-0">Đánh giá: 4.4 (25)</p>
            </div>
            <div>
                {{ $tour->description }} 
            </div>
        </div>
        <div class="col-4 book-tour">
            <h1 class="mt-5">Lịch Trình và Giá Tour</h1>
            <form id="booking-form" action="{{ route('bookings.store') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <input type="hidden" name="tour_id" value="{{ $tour->id }}">
            
                <div class="form-group">
                    <label>Chọn ngày đi</label>
                    <select name="tour_dates">
                        @foreach($tour->tourDates as $tourDate)
                            <option value="{{ $tourDate->start_date }}|{{ $tourDate->end_date }}">
                                Ngày đi: {{ $tourDate->start_date }} -> {{ $tourDate->end_date }}
                            </option>
                        @endforeach
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="adults">Người lớn (> 10 tuổi)</label>
                    <input type="number" class="form-control" id="adults" name="adults" value="1" min="1" onchange="updateTotalPrice()">
                </div>
            
                <div class="form-group">
                    <label for="children">Trẻ em (< 10 tuổi)</label>
                    <input type="number" class="form-control" id="children" name="children" value="0" min="0" onchange="updateTotalPrice()">
                </div>
            
                <div class="form-group">
                    <label for="discount_code">Mã giảm giá</label>
                    <input type="text" class="form-control" id="discount_code" name="discount_code">
                </div>
            
                <div class="form-group">
                    <label>Giá gốc:</label>
                    <div id="original_price" class="price">{{ number_format($tour->price, 0, '.', '.') }}.000 VND</div>
                </div>
            
                <div class="form-group">
                    <label>Tổng Giá Tour:</label>
                    <div id="total_price" class="price">0 VND</div>
                </div>
                @if($totalNumberOfPeople >= $tour->number_of_participants)
                <button class="btn-tour-disabled">Tour đã hết chỗ</button>
                @else
                <button type="button" class="btn-tour" id="showConfirmationModal">Đặt tour</button>
                @endif
            </form>
        </div>
   </div>
</div>


<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h5 class="modal-title" id="confirmationModalLabel">Xác nhận đặt tour</h5>
        </div>
        <div class="modal-body justify-content-center">
          <h6 class="text-center">Bạn có chắc chắn muốn đặt tour này không?</h6>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary close" data-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-primary" id="confirmBooking">Đồng ý</button>
        </div>
      </div>
    </div>
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
    var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });

    document.getElementById('showConfirmationModal').addEventListener('click', function() {
        $('#confirmationModal').modal('show');
    });

    document.getElementById('confirmBooking').addEventListener('click', function() {
        document.getElementById('booking-form').submit();
    });
    document.querySelector('.close').addEventListener('click', function() {
        $('#confirmationModal').modal('hide');
    }); 

    const adultsInput = document.getElementById('adults');
    const childrenInput = document.getElementById('children');
    const originalPriceElement = document.getElementById('original_price');
    const totalPriceElement = document.getElementById('total_price');
    const bookNowButton = document.querySelector('.btn-book-now');

    const originalPrice = parseInt(originalPriceElement.innerText.replace(/[^0-9]/g, ''));

    function calculateTotalPrice() {
        const adults = parseInt(adultsInput.value) || 0;
        const children = parseInt(childrenInput.value) || 0;
        
        const childrenPrice = originalPrice / 2;
        const totalPrice = (adults * originalPrice) + (children * childrenPrice);
        
        totalPriceElement.innerText = totalPrice.toLocaleString('vi-VN') + ' VND';
        
        totalPriceElement.setAttribute('data-total-price', totalPrice);
        
        bookNowButton.setAttribute('data-total-price', totalPrice);
        bookNowButton.setAttribute('data-adults', adults);
        bookNowButton.setAttribute('data-children', children);
    }

    // Add event listener to input fields
    adultsInput.addEventListener('input', calculateTotalPrice);
    childrenInput.addEventListener('input', calculateTotalPrice);

    calculateTotalPrice();
</script>
@endsection