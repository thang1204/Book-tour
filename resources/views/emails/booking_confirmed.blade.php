
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Chuyển Khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
        }
        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .bank-info {
            width: 70%;
        }
        .qr-code {
            width: 50%;
            text-align: center;
        }
        .qr-code img {
            width: 100%;
        }
        .qr-code p {
            margin-top: 10px;
        }
        .highlight {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Cảm ơn bạn đã đặt tour với chúng tôi!</h1>
            <h2>THANH TOÁN CHUYỂN KHOẢN</h2>
        </div>
        <div class="content">
            <div>
                <ul>
                    <p>Chi tiết đặt tour của bạn:</p>
                    <li>Mã tour: <span class="highlight">{{ $booking->order_code}}</span></li>
                    <li>Tour: {{ $booking->tour->name }}</li>
                    <li>Ngày khởi hành: {{ $booking->start_date }}</li>
                    <li>Số người lớn: {{ $booking->number_of_adults }}</li>
                    <li>Số trẻ em: {{ $booking->number_of_children }}</li>
                    <li>Tổng giá: {{ $booking->total_price }}</li>
                </ul>
            </div>
            <div class="qr-code">
                <p>Quét mã để thanh toán</p>
                {{-- @dd( $qrCodeBase64) --}}
                {{-- <p>{{ $qrCodeBase64 }}</p> --}}
                <img src="https://github.com/thang1204/Book-tour/blob/main/public/images/QRcode.jpg?raw=true" alt="" style="width: 100px;">
                {{-- <img src="data:image/png;base64,{{ trim($qrCodeBase64) }}" alt="QR Code"> --}}
                <p>Ngân hàng: {{ $bank->bank_name }}</p>
                <p>Số tài khoản: {{ $bank->account_number }}</p>
                <p>Chủ tài khoản: {{ $bank->account_holder_name }}</p>
                <p>Nội dung chuyển tiền: <span class="highlight">{{ $booking->order_code }}</span></p>
            </div>
        </div>
    </div>
</body>
</html>

