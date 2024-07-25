@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Chỉnh Sửa Tài Xế</h1>
    <form action="{{ route('drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $driver->name }}" required>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar" onchange="previewAvatar(event)">
            <div class="mt-2">
                @if($driver->avatar)
                    <img id="avatarPreview" src="{{ asset('storage/' . $driver->avatar) }}" alt="Avatar" width="100">
                @else
                    <img id="avatarPreview" src="" alt="Avatar Preview" width="100" style="display: none;">
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Điện Thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $driver->phone }}" required>
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