@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tạo Khu Vực Mới</h1>

    <form action="{{ route('areanew.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên Khu Vực:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="thumbnail">Hình Ảnh:</label>
            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage(event)" required>
            <div class="mt-2">
                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 100%; height: auto; display: none;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Tạo</button>
    </form>

    <a href="{{ route('areanew.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
</div>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('preview');
        
        reader.onload = function() {
            preview.src = reader.result;
        };
        
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
