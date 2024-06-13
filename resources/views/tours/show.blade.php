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
            <div class="form-group">
                <label for="tour_date">Chọn Lịch Trình và Xem Giá:</label>
                <div class="form-group">
                    <label for="saturdayDate">Chọn ngày</label>
                    <input type="date" id="saturdayDate" class="form-control" placeholder="Choose a date">
                    <small id="error-message" class="error-message">Vui lòng chọn ngày là Thứ Bảy.</small>
                </div>
            </div>
            <div class="form-group">
                <label for="adults">Người lớn (> 10 tuổi)</label>
                <input type="number" class="form-control" id="adults" name="adults" value="1" min="1">
            </div>
            <div class="form-group">
                <label for="children">Trẻ em (< 10 tuổi)</label>
                <input type="number" class="form-control" id="children" name="children" value="0" min="0">
            </div>
            {{--  --}}
            <div class="form-group">
                <label for="children">Mã giảm giá</label>
                <input type="text" class="form-control" >
            </div>
            {{--  --}}
            <div class="form-group">
                <label>Giá gốc:</label>
                <div id="original_price" class="price">{{ $tour->price }} VND</div>
            </div>
            <div class="form-group">
                <label>Tổng Giá Tour:</label>
                <div id="total_price" class="price">0 VND</div>
            </div>
            <button class="btn-book-now" data-url="{{ route('bookings.store') }}" data-tour-id="{{ $tour->id }}" data-adults="" data-children="" data-total-price="">>Book now</button>
        </div>
   </div>
</div>
<script>
    var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
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
            
            // Update the display element with formatted price
            totalPriceElement.innerText = totalPrice.toLocaleString('vi-VN') + ' VND';
            
            // Update data-total-price attribute with the numeric value
            totalPriceElement.setAttribute('data-total-price', totalPrice);
            
            // Update data attributes on the button
            bookNowButton.setAttribute('data-total-price', totalPrice);
            bookNowButton.setAttribute('data-adults', adults);
            bookNowButton.setAttribute('data-children', children);
        }

        // Add event listener to input fields
        adultsInput.addEventListener('input', calculateTotalPrice);
        childrenInput.addEventListener('input', calculateTotalPrice);

        // Calculate total price on page load
        calculateTotalPrice();


    $(document).ready(function() {
        $('.btn-book-now').click(function(event) {
            event.preventDefault();
            const url = $(this).attr('data-url');
            const tourId = $(this).data('tour-id');
            const adults = $(this).attr('data-adults');
            const children = $(this).attr('data-children');
            const totalPrice = $(this).attr('data-total-price');
            
            console.log(url);
            console.log(tourId);
            console.log(adults);
            console.log(children);
            console.log(totalPrice);
            $.ajax({
                url: url,
                data: {
                    tour_id: tourId,
                    number_of_adults: adults,
                    number_of_children: children,
                    total_price: totalPrice,
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
    //////////////////////

    const dateInput = document.getElementById('saturdayDate');
        const errorMessage = document.getElementById('error-message');

        // Sự kiện khi thay đổi ngày
        dateInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const dayOfWeek = selectedDate.getUTCDay(); // 0 = Chủ Nhật, 6 = Thứ Bảy

            if (dayOfWeek !== 6) { // Nếu không phải Thứ Bảy
                errorMessage.style.display = 'block';
                this.value = ''; // Xóa giá trị nhập
            } else {
                errorMessage.style.display = 'none';
            }
        });

        // Khởi tạo giá trị mặc định
        initializeDate();

        function initializeDate() {
            const today = new Date();
            const currentDay = today.getUTCDay();

            // Nếu hôm nay không phải là Thứ Bảy, tìm Thứ Bảy gần nhất
            if (currentDay !== 6) {
                const daysUntilSaturday = (6 - currentDay + 7) % 7;
                today.setDate(today.getDate() + daysUntilSaturday);
            }
            
            dateInput.value = today.toISOString().split('T')[0];
        }
</script>
@endsection