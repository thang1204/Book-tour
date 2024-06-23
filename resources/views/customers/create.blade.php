@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Khách Hàng Mới</h1>
    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="user_id">Chọn Tài Khoản Người Dùng</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">Chọn Tài Khoản</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="full_name">Họ Tên</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
        </div>
        <div class="form-group">
            <label for="address">Địa Chỉ</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
        </div>
        <div class="form-group">
            <label for="phone">Điện Thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label for="gender">Giới Tính</label>
            <select class="form-control" id="gender" name="gender">
                <option value="">Chọn Giới Tính</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date_of_birth">Ngày Sinh</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
        </div>
        <div class="form-group">
            <label for="avatar">Ảnh Đại Diện</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        function formatDriver(driver) {
            if (!driver.id) {
                return driver.text;
            }
            var baseUrl = driver.element.getAttribute('data-img-src');
            var $driver = $(
                '<span><img src="' + baseUrl + '" class="img-circle mr-2" style="width: 30px; height: 30px;" /> ' + driver.text + '</span>'
            );
            return $driver;
        };

        $('#driver_id').select2({
            templateResult: formatDriver,
            templateSelection: formatDriver
        });
    });
</script>
@endsection