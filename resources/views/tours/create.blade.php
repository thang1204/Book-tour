@extends('layouts.app')

@section('content')
<div class="container pt-3" style="min-height: 880px;">
    <h1 class="text-center">Tạo Tour</h1>
    <form id="form-ai-store" action="{{ route('tour.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('tour.index') }}" class="btn btn-tour" id="btn-back-ai"><i class="fas fa-long-arrow-alt-left"></i>&nbsp; Trở lại</a>
            <button data-url="" class="btn btn-tour" id="btn-save-ai">Tạo mới</button>
        </div>
        
        <div id="message-err" class="text-danger mt-4"></div> 
        <div class="form-group">
            <label for="name-tour" class="control-label text-muted mb-0">Tên Tour<span class="text-danger">*</span></label>
            <div class="">
                <input type="text" name="name" id="name-tour" class="form-control" placeholder="" value="{{ old('name') }}">
            </div>
        </div>
        
        <div class="form-group">
            <label for="description-tour" class="control-label text-muted mb-0">Nội dung tour</label>
            <textarea name="description" class="form-control js-count-limit" id="description-tour" data-limit="200" rows="5">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="area" class="control-label text-muted mb-0">Khu vực tour</label>
            <select name="area" class="form-control" id="area">
                <option value="">Chọn Khu vực tour</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ old('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="hotel" class="control-label text-muted mb-0">Khách sạn</label>
            <select name="hotel" class="form-control" id="hotel">
                <option value="">Chọn Khách sạn</option>
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}" {{ old('hotel') == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="vehicle" class="control-label text-muted mb-0">Phương tiện</label>
            <select name="vehicle" class="form-control" id="vehicle">
                <option value="">Chọn Phương Tiện</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ old('vehicle') == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->type }} {{ $vehicle->model }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="guide" class="control-label text-muted mb-0">Hướng dẫn viên</label>
            <select name="guide" class="form-control" id="guide">
                <option value="">Chọn Hướng dẫn viên</option>
                @foreach($guides as $guide)
                    <option value="{{ $guide->id }}" data-img-src="{{ asset('storage/' . $guide->avatar) }}" {{ old('guide') == $guide->id ? 'selected' : '' }}>
                        {{ $guide->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="date-ranges-section">
            @php
                $oldStartDates = old('start_date', []);
                $oldEndDates = old('end_date', []);
            @endphp
            @for ($i = 0; $i < max(count($oldStartDates), 1); $i++)
            <div class="form-group d-flex align-items-center mb-3" id="date-range-{{ $i }}">
                <div class="me-3">
                    <label for="start-date-{{ $i }}" class="control-label text-muted mb-0">Ngày bắt đầu</label>
                    <input type="date" name="start_date[]" id="start-date-{{ $i }}" class="form-control" value="{{ old('start_date.' . $i) }}">
                </div>
                <div class="me-3">
                    <label for="end-date-{{ $i }}" class="control-label text-muted mb-0">Ngày kết thúc</label>
                    <input type="date" name="end_date[]" id="end-date-{{ $i }}" class="form-control" value="{{ old('end_date.' . $i) }}">
                </div>
                <a class="btn-delete-date-range text-danger fs-26 mt-4" style="cursor:pointer;">&times;</a>
            </div>
            @endfor
        </div>
        <a id="btn-add-date-range" class="btn btn-tour">＋Thêm khoảng thời gian</a>
        <div class="form-group">
            <label for="price" class="form-label text-muted mb-0">Giá Tour</label>
            <div class="input-group no-wrap">
                <input type="text" name="price" id="price" class="form-control w-150px p-0 ps-3" value="{{ old('price') }}" oninput="formatCurrency(this)">
                <span class="input-group-text">000VND</span>
            </div>
        </div>
        <div class="form-group">
            <label for="number_of_participants" class="control-label text-muted mb-0">Số lượng người</label>
            <input type="number" name="number_of_participants" class="form-control" value="{{ old('number_of_participants') }}">
        </div>
        
        <hr>
        <div>
            <div class="d-flex align-items-center justify-content-between">
                <h3>Ảnh tour</h3>
                <a class="btn btn-tour" id="btn-add-img-tour">＋Thêm ảnh</a>
            </div>
            <div class="form-group list-item-image sort-data-pr-title">
                <div class="sortable-data-pr-title col list-unstyled d-flex align-items-center flex-wrap mb-3 gap-3 div-ai-image">
                    <div class="rounded-3 me-2 no-drag-title" style="
                        width: 250px;
                        height: 100%;
                        background-size: contain !important;
                        background-position: center !important;
                        background-repeat: no-repeat !important;
                        background-color: #dfdfdf !important;
                        border-radius: 8px;
                        aspect-ratio: 1.91 !important;
                        position: relative;
                        overflow: hidden;">
                        <img id="image-preview-0" src="/assets/img/common/noimage/no_image_base64.png" alt="" style="
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 130%;
                        height: 130%;
                        object-fit: contain;
                        transform: translate(-50%, -50%);">
                    </div>
                    <div class="col list-unstyled d-flex flex-wrap gap-2 no-drag-title">
                        <div class="col-12 d-flex justify-content-between">
                            <input type="file" name="image[]" id="image-input-0" onchange="previewImage(event, 0)">
                            <a class="btn-delete-ai-image bg-light mt-3"><i class="fas fa-trash-alt fs-26 cursor-pointer"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
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
    function previewImage(event, index) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('image-preview-' + index);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    $(document).ready(function() {
        let imageIndex = 1;
        $("#btn-add-img-tour").on("click", function () {
            const newItem =`
                <div class="col list-unstyled d-flex align-items-center flex-wrap mb-3 gap-3 div-ai-image">
                    <div class="rounded-3 me-2 no-drag-title" style="
                        width: 250px;
                        height: 100%;
                        background-size: contain !important;
                        background-position: center !important;
                        background-repeat: no-repeat !important;
                        background-color: #dfdfdf !important;
                        border-radius: 8px;
                        aspect-ratio: 1.91 !important;
                        position: relative;
                        overflow: hidden;">
                        <img id="image-preview-${imageIndex}" src="/assets/img/common/noimage/no_image_base64.png" alt="" style="
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 130%;
                        height: 130%;
                        object-fit: contain;
                        transform: translate(-50%, -50%);
                        ">
                    </div>
                    <div class="col list-unstyled d-flex flex-wrap gap-2 no-drag-title">
                        <div class="col-12 d-flex justify-content-between">
                            <input type="file" name="image[]" id="image-input-${imageIndex}" onchange="previewImage(event, ${imageIndex})">
                            <a class="btn-delete-ai-image bg-light"><i class="fas fa-trash-alt fs-26 cursor-pointer"></i></a>
                        </div>
                    </div>
                </div>
            `;
        $(".list-item-image").append(newItem);
        imageIndex++;
    });
    $("body").on("click", ".btn-delete-ai-image", function() {
        if ($('.div-ai-image').length > 1) {
            $(this).closest('.div-ai-image').remove();
        } else {
            toastr.error('Phải có ít nhất một ảnh');

        }
    });


    $(document).ready(function() {
        let dateIndex = {{ count($oldStartDates) }};
        $("#btn-add-date-range").on("click", function () {
            const newDateRange = `
                <div class="form-group d-flex align-items-center mb-3" id="date-range-${dateIndex}">
                    <div class="me-3">
                        <label for="start-date-${dateIndex}" class="control-label text-muted mb-0">Ngày bắt đầu</label>
                        <input type="date" name="start_date[]" id="start-date-${dateIndex}" class="form-control" value="">
                    </div>
                    <div class="me-3">
                        <label for="end-date-${dateIndex}" class="control-label text-muted mb-0">Ngày kết thúc</label>
                        <input type="date" name="end_date[]" id="end-date-${dateIndex}" class="form-control" value="">
                    </div>
                    <a class="btn-delete-date-range text-danger fs-26 mt-4" style="cursor:pointer;">&times;</a>
                </div>
            `;
            $("#date-ranges-section").append(newDateRange);
            dateIndex++;
        });

        $("body").on("click", ".btn-delete-date-range", function() {
            if ($('.form-group.d-flex.align-items-center.mb-3').length > 1) {
                $(this).closest('.form-group').remove();
            } else {
                toastr.error('Phải có ít nhất một khoảng thời gian');
            }
        });
    });


    $(document).ready(function() {
        function formatGuide(guide) {
            if (!guide.id) {
                return guide.text;
            }
            var $guide = $(
                '<span><img src="' + $(guide.element).data('img-src') + '" class="img-avatar" /> ' + guide.text + '</span>'
            );
            return $guide;
        };

        $('#guide').select2({
            templateResult: formatGuide,
            templateSelection: formatGuide,
            width: '100%'
        });
    });
    
});
</script>
@endsection