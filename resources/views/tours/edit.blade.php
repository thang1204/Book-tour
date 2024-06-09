@extends('layouts.app')

@section('content')
<div class="container pt-3" style="min-height: 880px;">
    <form id="form-ai-store" action="{{ route('tour.update', ['tour' => $tour->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('tour.index') }}" class="btn-create-ai" id="btn-back-ai"><i class="fas fa-long-arrow-alt-left"></i>&nbsp; Trở lại</a>
            <button data-url="" class="btn-create-ai" id="btn-save-ai">Chỉnh sửa</button>
        </div>
        <div id="message-err" class="text-danger mt-4"></div> 
        <div class="form-group pt-3">
            <label for="name-tour" class="control-label text-muted mb-0">Tên Tour<span class="text-danger">*</span></label>
            <div class="">
                <input type="text" name="name" id="name-tour" class="form-control" placeholder="" value="{{ $tour->name }}">
            </div>
        </div>
        
        <div class="form-group">
            <label for="description-tour" class="control-label text-muted mb-0">Nội dung tour</label>
            <textarea name="description" class="form-control js-count-limit" id="description-tour" data-limit="200" rows="5">{{ $tour->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="start-date" class="control-label text-muted mb-0">Ngày bắt đầu</label>
            <input type="date" name="start_date" id="start-date" class="form-control" value="{{ $tour->start_date }}">
            <label for="end-date" class="control-label text-muted mb-0">Ngày kết thúc</label>
            <input type="date" name="end_date" id="end-date" class="form-control" value="{{ $tour->end_date }}">
        </div>
        <div class="form-group">
            <label for="price" class="control-label text-muted mb-0">Giá Tour</label>
            <input type="number" name="price" class="form-control" value="{{ $tour->price }}">
        </div>
        <div class="form-group">
            <label for="number_of_participants" class="control-label text-muted mb-0">Số lượng người</label>
            <input type="number" name="number_of_participants" class="form-control" value="{{ $tour->number_of_participants }}">
        </div>
        
        <hr>
        <div>
            <div class="d-flex align-items-center justify-content-between">
                <h3>Ảnh tour</h3>
                <a class="btn-add-image fs-16 mb-3" id="btn-add-img-tour">＋Thêm ảnh</a>
            </div>
            <div class="form-group list-item-image sort-data-pr-title">
                @foreach($tour->images()->get() as $index => $image)
                <div class="sortable-data-pr-title col list-unstyled d-flex align-items-center flex-wrap mb-3 gap-3 div-ai-image">
                    <i class="fas fa-grip-vertical text-info cursor-move fs-26"></i>
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
                            <img id="image-preview-{{ $index }}" src="{{ $image->image }}" alt="" style="
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 100%;
                        height: 100%;
                        object-fit: contain;
                        transform: translate(-50%, -50%);">
                    </div>

                    <div class="col list-unstyled d-flex flex-wrap gap-2 no-drag-title">
                        <div class="col-12 d-flex justify-content-between">
                            <input type="hidden" name="images[{{ $index }}][id]" value="{{ $image->id }}">
                            <input type="file" name="images[{{ $index }}][file]" id="image-input-{{ $index }}" onchange="previewImage(event, {{ $index }})">
                            <a class="btn-delete-ai-image bg-light"><i class="fas fa-trash-alt fs-26"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
function previewImage(event, index) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('image-preview-' + index);
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
$(document).ready(function() {
    let uniqueIndex = {{$tour->images()->count() }};
    $("#btn-add-img-tour").on("click", function () {
        uniqueIndex++;
        const newItem =`
            <div class="col list-unstyled d-flex align-items-center flex-wrap mb-3 gap-3 div-ai-image">
                <i class="fas fa-grip-vertical text-info cursor-move fs-26"></i>
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
                    <img id="image-preview-${uniqueIndex}" src="/assets/img/common/noimage/no_image_base64.png" alt="" style="
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                    transform: translate(-50%, -50%);
                    ">
                </div>
                <div class="col list-unstyled d-flex flex-wrap gap-2 no-drag-title">
                    <div class="col-12 d-flex justify-content-between">
                        <input type="hidden" name="images[${uniqueIndex}][id]">

                        <input type="file" name="images[${uniqueIndex}][file]" id="image-input-${uniqueIndex}" onchange="previewImage(event, ${uniqueIndex})">
                        <a class="btn-delete-ai-image bg-light"><i class="fas fa-trash-alt fs-26"></i></a>
                    </div>
                </div>
            </div>
        `;
        $(".list-item-image").append(newItem);
    });
    $("body").on("click", ".btn-delete-ai-image", function() {
        $(this).closest('.div-ai-image').remove();
    })

        
    // var csrfToken = $('meta[name="csrf-token"]').attr('content');
    // $('#btn-save-ai').click(function () {
    //     openModalConfirm("Bạn có muốn tạo mới không?", function () {
    //         var action = $('#form-ai-store').attr('action');
    //         var formData = new FormData($('#form-ai-store')[0]);
    //         $.ajax({
    //             type: 'POST',
    //             url: action,
    //             data: formData,
    //             contentType: false,
    //             processData: false,
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function(response) {
    //                 $("#message-err").empty();
    //                 toastr.success(response.message);
    //                 setTimeout(function() {
    //                     window.location.href = document.referrer;
    //                 }, 3000);
    //             },
    //             error: function(xhr, status, error) {
    //                 var validateErrors = xhr.responseJSON.errors;
    //                 $("#message-err").empty();
    //                 for (const [key, value] of Object.entries(validateErrors)) {
    //                     $("#message-err").append(`${value}<br>`);
    //                 }
    //             }
    //         });
    //     })
    // });
    // function openModalConfirm(title, handleConfirmOke) {
    //   Swal.fire({
    //     title: title,
    //     icon: "question",
    //     showCancelButton: true,
    //     confirmButtonColor: "#3085d6",
    //     cancelButtonColor: "#d33",
    //     confirmButtonText: "保存",
    //     cancelButtonText: "キャンセル",
    //     reverseButtons: true,
    //     animation: true,
    //     showLoaderOnDeny: true,
    //     customClass: {
    //       title: 'title-sweet',
    //       cancelButton: 'btn-cancel-sweetalert w-120px',
    //       confirmButton: 'btn-confirm-sweetalert w-120px',
    //     }
    //   }).then((result) => {
    //     if (result.isConfirmed) {
    //       handleConfirmOke()
    //     }
    //   });
    // }
    // $('.sort-data-pr-title').sortable({
    //     cancel: '.no-drag-title',
    //     update: function() {
    //     var sortedItems = $(this).find('.sortable-data-pr-title');
    //     var orderData = [];
    //     sortedItems.each(function(index) {
    //         var itemId = $(this).attr('data-id');
    //         orderData.push({
    //             id: itemId,
    //             order: index + 1 
    //         });
    //     });
    //     $.ajax({
    //         url: url,
    //         type: 'POST',
    //         data: {
    //             orderData: orderData,
    //             _token: '{{ csrf_token() }}'
    //         },
    //         success: function(response) {
    //         },
    //         error: function(error) {
    //         }
    //     });
    //     }
    // });
    
});
</script>
@endsection