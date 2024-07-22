@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Danh sách khu vực</h1>
    <a href="{{ route('areanew.create') }}" class="btn btn-tour mb-3">Thêm khu vực mới</a>
    <table class="table">
        <thead>
            <tr>
                <th>Tên khu vực</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($areas as $index => $area)
            <tr>
                <td>{{ $area->name }}</td>
                <td>
                    <a href="{{ route('areanew.edit', $area->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                    <button type="button" class="btn btn-danger btn-sm" id="showDeleteModal{{ $index }}">Xóa</button>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác nhận xóa khu vực</h5>
                                </div>
                                <div class="modal-body justify-content-center">
                                    <h6 class="text-center">Bạn có chắc chắn muốn xóa khu vực này không?</h6>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" id="close{{ $index }}" data-dismiss="modal">Hủy</button>
                                    <button type="button" class="btn btn-primary confirmDelete" data-id="{{ $index }}">Đồng ý</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden form for deletion -->
                    <form action="{{ route('areanew.destroy', $area->id) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
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
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($areas as $index => $area)
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
