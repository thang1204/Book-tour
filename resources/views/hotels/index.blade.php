@extends('layouts.app')

@section('content')
<div class="container pt-3" style="min-height: 880px;">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="btn-create-ai" id="btn-back-ai"><i class="fas fa-long-arrow-alt-left"></i>&nbsp; Trở lại</a>
    </div>
    <h1 class="text-center">Danh sách khách sạn</h1>
    <a href="{{ route('hotels.create') }}" class="btn btn-tour mb-3">Thêm khách sạn</a>

    <div id="message-err" class="text-danger mt-4"></div> 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên khách sạn</th>
                <th>Địa chỉ</th>
                <th>Đánh giá</th>
                <th>Số điện thoại</th>
                <th>Mô tả</th>
                <th>Thêm sửa xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $index => $hotel)
                <tr>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->address ?? 'N/A' }}</td>
                    <td>{{ $hotel->stars ?? 'N/A' }}<i class="fa-solid fa-star" style="color: rgb(255, 242, 0)"></i></td>
                    <td>{{ $hotel->phone ?? 'N/A' }}</td>
                    <td>{{ $hotel->description ?? 'N/A' }}</td>
                    <td style="text-align: left; white-space: nowrap;">
                        <a href="{{ route('hotels.edit', ['hotel' => $hotel->id]) }}" class="btn btn-warning">Chỉnh Sửa</a>
                        <button type="button" class="btn btn-danger" id="showDeleteModal{{ $index }}">Xóa</button>
        
                        <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác nhận xóa khách sạn</h5>
                                    </div>
                                    <div class="modal-body justify-content-center">
                                        <h6 class="text-center">Bạn có chắc chắn muốn xóa khách sạn này không?</h6>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" id="close{{ $index }}" data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn btn-primary confirmDelete" data-id="{{ $index }}">Đồng ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <form action="{{ route('hotels.destroy', ['hotel' => $hotel->id]) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
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
        @foreach($hotels as $index => $hotel)
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
