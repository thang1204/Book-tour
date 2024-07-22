@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Danh Sách Tài Xế</h1>
    <a href="{{ route('drivers.create') }}" class="btn btn-tour mb-3">Thêm Tài Xế</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Avatar</th>
                <th>Điện Thoại</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $index => $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>
                        @if($driver->avatar)
                            <img src="{{ asset('storage/' . $driver->avatar) }}" alt="Avatar" width="100">
                        @else
                            <img src="https://via.placeholder.com/100" alt="Default Avatar" width="100">
                        @endif
                    </td>
                    <td>{{ $driver->phone }}</td>
                    <td>
                        <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning">Chỉnh Sửa</a>
                        <button type="button" class="btn btn-danger" id="showDeleteModal{{ $index }}">Xóa</button>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác nhận xóa tài xế</h5>
                                    </div>
                                    <div class="modal-body justify-content-center">
                                        <h6 class="text-center">Bạn có chắc chắn muốn xóa tài xế này không?</h6>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" id="close{{ $index }}" data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn btn-primary confirmDelete" data-id="{{ $index }}">Đồng ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden form for deletion -->
                        <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
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
        @foreach($drivers as $index => $driver)
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
