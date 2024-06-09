@extends('layouts.app')

@section('content')
<div class="container pt-3" style="min-height: 880px;">
    <h1>Show</h1>
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