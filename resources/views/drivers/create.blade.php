@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Tài Xế</h1>
    <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar" onchange="previewAvatar(event)">
            <div class="mt-2">
                <img id="avatarPreview" src="" alt="Avatar Preview" width="100" style="display: none;">
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Điện Thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-tour mt-3">Thêm</button>
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