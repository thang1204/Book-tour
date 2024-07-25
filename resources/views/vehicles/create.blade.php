@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Thêm xe mới</h1>
    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Phương tiện</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="form-group">
            <label for="model">Loại xe</label>
            <input type="text" class="form-control" id="model" name="model">
        </div>
        <div class="form-group">
            <label for="license_plate">Biển số xe</label>
            <input type="text" class="form-control" id="license_plate" name="license_plate" required>
        </div>
        <div class="form-group">
            <label for="capacity">Sức chứa</label>
            <input type="number" class="form-control" id="capacity" name="capacity">
        </div>
        <div class="form-group">
            <label for="driver_id">Tài Xế</label>
            <select class="form-control" id="driver_id" name="driver_id" required>
                <option value="">Chọn Tài Xế</option>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}" data-img-src="{{ asset('storage/' . $driver->avatar) }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                        {{ $driver->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-tour mt-3">Thêm</button>
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