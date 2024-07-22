@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Sửa Khu Vực</h1>
    
    <form action="{{ route('areanew.update', $area->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên Khu Vực:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $area->name }}" required>
        </div>

        <div class="form-group">
            <label for="thumbnail">Hình Ảnh:</label>
            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage(event)">
            <div class="mt-2">
                @if($area->thumbnail)
                    <img id="preview" src="{{ asset('storage/' . $area->thumbnail) }}" alt="Preview" class="img-thumbnail" style="max-width: 100%; height: auto;">
                @else
                    <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 100%; height: auto; display: none;">
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>

    <a href="{{ route('areanew.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('preview');
        
        reader.onload = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection