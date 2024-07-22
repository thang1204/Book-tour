@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cập Nhật Mã QR Thanh Toán</h2>
    <form action="{{ route('banks.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="bank_name">Tên ngân hàng:</label>
            <input type="text" id="bank_name" name="bank_name" value="{{ $bank->bank_name }}" required>
        </div>
        <div class="form-group">
            <label for="account_number">Số tài khoản:</label>
            <input type="text" id="account_number" name="account_number" value="{{ $bank->account_number }}" required>
        </div>
        <div class="form-group">
            <label for="account_holder_name">Tên chủ tài khoản:</label>
            <input type="text" id="account_holder_name" name="account_holder_name" value="{{ $bank->account_holder_name }}" required>
        </div>
        <div class="form-group">
            <label for="qr_code">Chọn ảnh mã QR mới:</label>
            <input type="file" id="qr_code" name="qr_code" onchange="previewQRCode()">
        </div>
        <div id="qr-preview">
            <img id="qr-image" src="{{ Storage::url($bank->qr_code_path) }}" alt="QR Code Preview" style="{{ $bank->qr_code_path ? 'display:block;' : 'display:none;' }}">
        </div>
            <button type="submit" class="btn-tour">Cập Nhật</button>
    </form>
</div>

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
    function previewQRCode() {
        const file = document.getElementById('qr_code').files[0];
        const preview = document.getElementById('qr-image');

        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
<style>
    input[type="text"],
        input[type="file"] {
            display: block;
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            margin-bottom: 10px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        #qr-preview {
            margin-top: 15px;
            text-align: center;
        }
        #qr-preview img {
            max-width: 100%;
            max-height: 300px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
</style>
@endsection
