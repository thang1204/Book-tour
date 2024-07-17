<?php

namespace App\Mail;

use App\Models\Bank;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;


class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $bank;
    public $qrCodeBase64;

    /**
     * Create a new message instance.
     *
     * @param Booking $booking Thông tin đặt tour
     * @param Bank $bank Thông tin ngân hàng (bao gồm đường dẫn đến QR Code)
     * @return void
     */
    public function __construct(Booking $booking, Bank $bank)
    {
        $this->booking = $booking;
        $this->bank = $bank;


        // Đọc và chuyển đổi ảnh QR Code thành base64
        $qrCodePath = storage_path('app/' . $bank->qr_code_path);
        $qrCodeData = File::get($qrCodePath);
        $this->qrCodeBase64 = base64_encode($qrCodeData);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.booking_confirmed')
                    ->subject('Xác nhận đặt tour')
                    ->with([
                        'booking' => $this->booking,
                        'bank' => $this->bank,
                        'qrCodeBase64' => $this->qrCodeBase64,
                    ]);
    }
}