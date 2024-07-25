@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="text-center">Quản lý Tour</h1>
    <a href="{{ route('tour.create') }}" class="btn btn-tour mb-3">Tạo Tour</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Tour</th>
                <th>Khu vực</th>
                <th>Khách sạn</th>
                <th>Phương tiện</th>
                <th>Hướng dẫn viên</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Giá (VND)</th>
                <th>Số lượng người tham gia</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tours as $index => $tour)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tour->name }}</td>
                    <td>{{ $tour->area->name }}</td>
                    <td>{{ $tour->hotel->name ?? 'N/A' }}</td>
                    <td>{{ $tour->vehicle->model ?? 'N/A' }}</td>
                    <td>{{ $tour->guide->name ?? 'N/A' }}</td>
                    <td>
                        @if ($tour->tourDates->isNotEmpty())
                            @foreach ($tour->tourDates as $tourDate)
                                {{ \Carbon\Carbon::parse($tourDate->start_date)->format('d/m/Y') }}<br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($tour->tourDates->isNotEmpty())
                            @foreach ($tour->tourDates as $tourDate)
                                {{ \Carbon\Carbon::parse($tourDate->end_date)->format('d/m/Y') }}<br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ number_format($tour->price, 0, ',', '.') }}.000VND</td>
                    <td>{{ $tour->number_of_participants }}</td>
                    <td style="text-align: left; white-space: nowrap;">
                        <a href="{{ route('tour.edit', ['tour' => $tour->id]) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                        <button type="button" class="btn btn-danger btn-sm" id="showDeleteModal{{ $index }}">Xóa</button>
            
                        <!-- Modal xác nhận xóa -->
                        <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác nhận xóa tour</h5>
                                    </div>
                                    <div class="modal-body justify-content-center">
                                        <h6 class="text-center">Bạn có chắc chắn muốn xóa tour này không?</h6>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" id="close{{ $index }}" data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn btn-primary confirmDelete" data-id="{{ $index }}">Đồng ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Form xóa -->
                        <form action="{{ route('tour.destroy', ['tour' => $tour->id]) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
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
    @if(session('error'))
        toastr.error("{{ session('error') }}");
        <?php session()->forget('error'); ?>
    @endif
    @if(session('success'))
        toastr.success("{{ session('success') }}");
        <?php session()->forget('success'); ?>
    @endif
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
        @foreach($tours as $index => $tour)
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
