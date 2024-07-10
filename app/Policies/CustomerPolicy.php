<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Customer $customer)
    {
        return $user->id === $customer->user_id;
    }

    public function delete(User $user, Customer $customer)
    {
        return $user->id === $customer->user_id;
    }
}


// 3 trạng thái thanh toán
// Đặt tour xong thì gửi mail -> gồm có mã đơn đã đặt để thanh toán Thêm cột mã đơn
// Tài khoản nhận tiền
// Quản lý đơn đặt tour có chức năng tìm (Admin xem hết, user chỉ xem được user đó)

// Chọn ngày đi và ngày về du lịch
// Các xe và các tài xế, hướng dẫn viên du lịch không thể chọn cùng 1 ngày
// Phân trang

// Giảm giá
// Giỏ hàng (Lưu tour)
// Review

// Khi chưa đăng nhập thì đặt tour chuyển đến đăng nhập

// Modal
// Validate
// CSS bookings
// Footer
// CSS
// QR
// Đưa lên serve
// Viết quyển
// Slide
// Fake data