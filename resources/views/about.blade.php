@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-4">Chào mừng đến với WinND</h1>
        <p class="lead">Khám phá những địa điểm tuyệt vời nhất trên thế giới với dịch vụ tour du lịch của chúng tôi.</p>
        <hr class="my-4">
        <p>WinND cung cấp những tour du lịch chất lượng, giúp bạn có những trải nghiệm đáng nhớ và tuyệt vời.</p>
        <a class="btn btn-tour" href="{{ route('home') }}" role="button">Khám phá các tour</a>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <img src="https://scontent.fhan5-2.fna.fbcdn.net/v/t39.30808-6/451545933_1186374732781578_9012673048414881308_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=4WwqLL-MMS0Q7kNvgGo0y8d&_nc_ht=scontent.fhan5-2.fna&oh=00_AYClPcgIVY47Z_didgld-gnQe2nMwmPKz3rlqMaEX5JIjg&oe=66A15A3F" class="card-img-top" alt="Tour 1" style="height: 400px">
                <div class="card-body">
                    <h5 class="card-title">Tour Nội Địa</h5>
                    <p class="card-text">Khám phá những địa điểm nổi bật và đẹp nhất trong nước với dịch vụ chất lượng cao.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <img src="https://scontent.fhan5-9.fna.fbcdn.net/v/t39.30808-6/451316276_1186374712781580_4745011760526041747_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=w0iDW6yBnfkQ7kNvgFUi-dz&_nc_ht=scontent.fhan5-9.fna&oh=00_AYAJTRxRazOLvrSb8dLpWHVd3h29mgvHVoQqFyn2zO_8gg&oe=66A147DD" class="card-img-top" alt="Tour 3" style="height: 400px">
                <div class="card-body">
                    <h5 class="card-title">Tour Gia Đình</h5>
                    <p class="card-text">Dành cho các gia đình muốn có kỳ nghỉ tuyệt vời, những kỉ niệm đáng nhớ và gắn kết.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="text-center mb-4">Tại sao chọn WinND?</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Chất lượng dịch vụ</h4>
                        <p class="card-text">Chúng tôi cam kết cung cấp dịch vụ chất lượng cao với đội ngũ hướng dẫn viên chuyên nghiệp và thân thiện.</p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Giá cả hợp lý</h4>
                        <p class="card-text">Chúng tôi luôn cố gắng đem đến những tour du lịch với giá cả hợp lý, phù hợp với mọi đối tượng khách hàng.</p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Đa dạng lựa chọn</h4>
                        <p class="card-text">Chúng tôi có nhiều lựa chọn tour du lịch đa dạng, phù hợp với mọi sở thích và nhu cầu của khách hàng.</p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Hỗ trợ tận tình</h4>
                        <p class="card-text">Đội ngũ hỗ trợ khách hàng của chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc và hỗ trợ bạn trong suốt hành trình.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection