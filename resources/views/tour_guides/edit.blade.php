@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Cập Nhật Hướng Dẫn Viên</h1>
    <form action="{{ route('tour_guides.update', $tourGuide->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $tourGuide->name }}" required>
        </div>
        <div class="form-group">
            <label for="avatar">Ảnh Đại Diện</label>
            <input type="file" class="form-control" id="avatar" name="avatar" onchange="previewAvatar(event)">
            @if($tourGuide->avatar)
                <img id="avatarPreview" src="{{ \Storage::url($tourGuide->avatar) }}" alt="Avatar" width="100" class="mt-2">
            @else
                <img id="avatarPreview" src="" alt="Xem Trước Avatar" width="100" class="mt-2" style="display:none;">
            @endif
        </div>
        <div class="form-group">
            <label for="phone">Điện Thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $tourGuide->phone }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $tourGuide->email }}">
        </div>
        <div class="form-group">
            <label for="bio">Tiểu Sử</label>
            <textarea class="form-control" id="bio" name="bio">{{ $tourGuide->bio }}</textarea>
        </div>
        <button type="submit" class="btn btn-tour mt-3">Cập Nhật</button>
    </form>
</div>
@endsection

@section('script')
<script>
    function previewAvatar(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('avatarPreview');
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endsection