@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tạo mới ngân hàng</h2>
        <form action="{{ route('banks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="bank_name">Tên ngân hàng:</label>
                <input type="text" id="bank_name" name="bank_name" required>
            </div>
            <div class="form-group">
                <label for="account_number">Số tài khoản:</label>
                <input type="text" id="account_number" name="account_number" required>
            </div>
            <div class="form-group">
                <label for="account_holder_name">Tên chủ tài khoản:</label>
                <input type="text" id="account_holder_name" name="account_holder_name" required>
            </div>
            <div class="form-group">
                <label for="qr_code">Chọn ảnh mã QR:</label>
                <input type="file" id="qr_code" name="qr_code">
            </div>
            <button type="submit">Tạo mới</button>
        </form>
</div>
@endsection
