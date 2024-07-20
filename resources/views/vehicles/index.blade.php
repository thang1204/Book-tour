@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Danh sách xe</h1>
    <a href="{{ route('vehicles.create') }}" class="btn btn-tour mb-3">Thêm xe mới</a>
    <table class="table">
        <thead>
            <tr>
                <th>Phương tiện</th>
                <th>Loại xe</th>
                <th>Biển số xe</th>
                <th>Sức chứa</th>
                <th>Tài xế</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $index => $vehicle)
            <tr>
                <td>{{ $vehicle->type }}</td>
                <td>{{ $vehicle->model }}</td>
                <td>{{ $vehicle->license_plate }}</td>
                <td>{{ $vehicle->capacity }}</td>
                <td>
                    @if($vehicle->driver)
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $vehicle->driver->avatar) }}" alt="Avatar" width="50" height="50" class="rounded-circle mr-2">
                            <span>{{ $vehicle->driver->name }}</span>
                        </div>
                    @else
                        <span>Chưa Có Tài Xế</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                    <button type="button" class="btn btn-danger btn-sm" id="showDeleteModal{{ $index }}">Xóa</button>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác nhận xóa phương tiện</h5>
                                </div>
                                <div class="modal-body justify-content-center">
                                    <h6 class="text-center">Bạn có chắc chắn muốn xóa phương tiện này không?</h6>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" id="close{{ $index }}" data-dismiss="modal">Hủy</button>
                                    <button type="button" class="btn btn-primary confirmDelete" data-id="{{ $index }}">Đồng ý</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden form for deletion -->
                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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

    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($vehicles as $index => $vehicle)
            document.getElementById(`showDeleteModal{{ $index }}`).addEventListener('click', function() {
                $(`#deleteConfirmationModal{{ $index }}`).modal('show');
            });

            document.querySelector(`#deleteConfirmationModal{{ $index }} .confirmDelete`).addEventListener('click', function() {
                const form = document.getElementById(`deleteForm{{ $index }}`);
                form.submit();
            });

            document.querySelector(`#close{{ $index }}`).addEventListener('click', function() {
                $(`#deleteConfirmationModal{{ $index }}`).modal('hide');
            });
        @endforeach
    });
</script>
@endsection