@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Thêm Khách Sạn</h1>
    <form action="{{ route('hotels.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Địa Chỉ</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="stars">Hạng Sao</label>
            <input type="number" class="form-control" id="stars" name="stars" min="1" max="5">
        </div>
        <div class="form-group">
            <label for="phone">Điện Thoại</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-tour mt-3">Thêm</button>
    </form>
</div>
@endsection

@section('script')

@endsection