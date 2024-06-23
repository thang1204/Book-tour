<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedTourData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:seed-tour-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed data into tours, tour_images, areas, hotels, vehicles, drivers, and tour_guides tables';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::transaction(function () {
                $this->seedAreasTable();
                $this->seedHotelsTable();
                $this->seedVehiclesTable();
                $this->seedDriversTable();
                $this->seedTourGuidesTable();
                $this->seedToursTable();
                $this->seedTourImagesTable();
            });

            $this->info('Seeded data into all tables successfully.');
        } catch (Exception $e) {
            $this->error('Failed to seed data: ' . $e->getMessage());
        }
    }

    /**
     * Seed data for areas table
     *
     * @return void
     */

     
    private function seedAreasTable()
    {
        $areas = [
            ['id' => 1, 'name' => 'Hà Nội', 'thumbnail' => 'images/ha_noi.jpg'],
            ['id' => 2, 'name' => 'TP. Hồ Chí Minh', 'thumbnail' => 'images/ho_chi_minh.jpg'],
            ['id' => 3, 'name' => 'Đà Nẵng', 'thumbnail' => 'images/da_nang.jpg'],
            ['id' => 4, 'name' => 'Hội An', 'thumbnail' => 'images/hoi_an.jpg'],
            ['id' => 5, 'name' => 'Huế', 'thumbnail' => 'images/hue.jpg'],
            ['id' => 6, 'name' => 'Nha Trang', 'thumbnail' => 'images/nha_trang.jpg'],
            ['id' => 7, 'name' => 'Hà Giang', 'thumbnail' => 'images/ha_giang.jpg'],
            ['id' => 8, 'name' => 'Phú Quốc', 'thumbnail' => 'images/phu_quoc.jpg'],
            ['id' => 9, 'name' => 'Sa Pa', 'thumbnail' => 'images/sapa.jpg'],
            ['id' => 10, 'name' => 'Hạ Long', 'thumbnail' => 'images/quang_ninh.jpg'],
        ];

        DB::table('areas')->insert($areas);
        $this->info('Seeded areas table successfully.');
    }

    /**
     * Seed data for hotels table
     *
     * @return void
     */
    private function seedHotelsTable()
    {
        $hotels = [
            [
                'id' => 1,
                'name' => 'Intercontinental Danang Sun Peninsula Resort',
                'address' => 'Phường Thọ Quang, Bán Đảo Sơn Trà, TP. Đà Nẵng',
                'stars' => 5,
                'phone' => '023 6393 8888',
                'description' => 'Khu nghỉ dưỡng hàng đầu của IHG tại Việt Nam khai trương vào tháng 6 năm 2012, với diện tích 39 ha sườn núi được bảo tồn cẩn trọng trong Khu Bảo Tồn Tự nhiên Bán đảo Sơn Trà. Khu nghỉ dưỡng sang trọng bao gồm 201 phòng nằm ẩn mình trong khu rừng hoang sơ với tầm nhìn hướng ra Vịnh Bãi Bắc, nơi có bãi biển hoang sơ dài 700m và được vinh danh là một trong những bãi biển đẹp nhất Việt Nam. InterContinental Danang Sun Peninsula Resort chắc chắn là điểm nghỉ dưỡng mà bạn không nên bỏ qua.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'La Veranda Resort Phú Quốc – MGallery',
                'address' => 'Trần Hưng Đạo, TP. Phú Quốc, Kiên Giang',
                'stars' => 5,
                'phone' => '038 323 1234',
                'description' => 'Mỗi khu nghỉ boutique thuộc thương hiệu MGallery là một câu chuyện đặc biệt, nơi du khách có thể đắm chìm trong những hành trình kỳ thú về phiêu lưu, lãng mạn, lịch sử, văn hóa, thiên nhiên và nhiều trải nghiệm khác nhau trong mỗi kỳ nghỉ đáng nhớ. Khách sạn La Veranda Phú Quốc xây dựng theo phong cách dinh thự Pháp thập niên 1920, tọa lạc giữa khu vườn nhiệt đới bên bãi biển dài xanh mát. La Veranda có 70 phòng tiêu chuẩn 5 sao quốc tế, 2 nhà hàng, một quán bar, bể bơi, khu vui chơi thể thao nước và spa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'JW Marriott Hotel Hanoi',
                'address' => '8 Đỗ Đức Dục, Quận Nam Từ Liêm, TP. Hà Nội',
                'stars' => 5,
                'phone' => '024 3833 5588',
                'description' => 'Không thể không nhắc đến JW Marriott Hotel Hanoi trong danh sách những khách sạn tuyệt vời nhất Việt Nam. Với sự đánh giá cao từ khách hàng và vị trí đắc địa tại trung tâm thủ đô Hà Nội, JW Marriott Hotel Hanoi mang đến trải nghiệm sang trọng và đẳng cấp. Với thiết kế hiện đại, dịch vụ đạt chuẩn quốc tế, khách sạn JW Marriott Hanoi cam kết mang lại dịch vụ hoàn hảo nhất cho du khách.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'The Reverie Saigon',
                'address' => 'Tòa nhà Times Square 22-36 Nguyễn Huệ, Quận 1, TP. HCM',
                'stars' => 5,
                'phone' => '028 3823 6688',
                'description' => 'The Reverie Saigon được biết đến là biểu tượng của sự xa hoa và là thành viên độc nhất vô nhị của Tổ Chức Các Khách Sạn Hàng Đầu Thế Giới tại Việt Nam. Nằm tại vị trí đắc địa trên tòa nhà Times Square nổi tiếng, quận 1, khách sạn này không chỉ mang đến dịch vụ hàng đầu thế giới mà còn gây ấn tượng với thiết kế nội thất phong cách Ý tinh tế và sang trọng độc đáo. Với dịch vụ chuyên nghiệp, tiện nghi hiện đại và không gian lộng lẫy, hãy tận hưởng mọi khoảnh khắc nghỉ ngơi tại The Reverie Saigon. Không chỉ là nơi nghỉ, đây còn là một tác phẩm nghệ thuật sống với phong cách pha trộn giữa Á và Âu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Vinpearl Luxury Nha Trang',
                'address' => 'Đảo Hòn Tre, Phường Vĩnh Nguyên, TP. Nha Trang, Khánh Hòa',
                'stars' => 5,
                'phone' => '1900 232 389',
                'description' => 'Vinpearl Luxury Nha Trang là điểm đến không thể bỏ lỡ với những du khách trân trọng từng khoảnh khắc bình yên bên người thương. Nằm bên bờ biển thiên đàng, 84 căn biệt thự tinh tế tọa lạc giữa khu vườn nhiệt đới xanh mát, lắng nghe nhịp sống nhẹ nhàng của sóng biển như bản nhạc êm dịu của thiên nhiên, tạo nên không gian yên bình và ấm cúng như một \'ốc đảo hạnh phúc\' xa xôi khỏi cuộc sống hối hả ở thành phố.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Pullman Hanoi',
                'address' => '40 Cát Linh, Quận Đống Đa, TP. Hà Nội',
                'stars' => 5,
                'phone' => '024 3733 0688',
                'description' => 'Khách sạn Pullman Hà Nội là điểm đến sang trọng không thể bỏ qua tại trung tâm thủ đô Hà Nội, với kiến trúc và thiết kế không kém phần đẳng cấp so với các khách sạn thế giới. Cho dù bạn đến để nghỉ ngơi hay công tác, Pullman luôn là lựa chọn hoàn hảo cho kỳ nghỉ của bạn. Với vị trí thuận lợi tại góc đường Cát Linh và Trung tâm Triển lãm Giảng Võ, khách sạn gần các cơ quan chính phủ, đại sứ quán và trung tâm thương mại.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'InterContinental Hanoi Landmark72',
                'address' => 'Tòa nhà Hanoi Landmark72 Lô E6, Quận Nam Từ Liêm, TP. Hà Nội',
                'stars' => 5,
                'phone' => '024 3698 8888',
                'description' => 'InterContinental Hanoi Landmark72 là đỉnh cao của sự sang trọng tại Hà Nội với chiều cao hơn 346m. Với 358 phòng nghỉ tiện nghi, 5 nhà hàng và bar sáng tạo, khách sạn mang đến trải nghiệm ẩm thực tinh tế và tầm nhìn toàn cảnh thành phố. Với cơ sở vật chất hàng đầu cho sự kiện và hội nghị, cùng Club InterContinental Lounge lớn nhất Đông Nam Á, InterContinental Hanoi Landmark72 hứa hẹn dịch vụ chuyên nghiệp và cá nhân hóa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Vinpearl Resort & Spa Hạ Long',
                'address' => 'Đảo Rều, Bãi Cháy, Thành phố Hạ Long, Tỉnh Quảng Ninh',
                'stars' => 5,
                'phone' => '020 3385 7858',
                'description' => 'Với vẻ đẹp kiến trúc lâu đài độc đáo, Vinpearl Resort & Spa Hạ Long là điểm đến lý tưởng tại miền Bắc Việt Nam, nằm trên bãi biển, nhấn chìm trong không gian huyền bí của vịnh Hạ Long. Thiết kế sang trọng, 3 bãi biển riêng tư, hồ bơi rộng lớn tạo nên không gian nghỉ dưỡng tuyệt vời. Phòng nghỉ rộng rãi với ban công lớn mang đến trải nghiệm đắm chìm trong vẻ đẹp của thành phố Hạ Long và biển cả.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'Park Hyatt Saigon',
                'address' => '2 Công Trường Lam Sơn, Bến Nghé, Quận 1, TP. HCM',
                'stars' => 5,
                'phone' => '028 3824 1234',
                'description' => 'Được vinh danh trong danh sách 500 khách sạn hàng đầu thế giới, Park Hyatt Saigon kết hợp văn hóa Việt truyền thống và kiến trúc hiện đại, mang đến trải nghiệm sang trọng với dịch vụ đẳng cấp quốc tế. Tọa lạc trên Quảng trường Lam Sơn, chỉ cách sân bay Tân Sơn Nhất 7.5km, khách sạn đem đến vị trí trung tâm thuận lợi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'name' => 'Hanoi La Siesta Central & Spa',
                'address' => '94 Mã Mây, Quận Hoàn Kiếm, TP. Hà Nội',
                'stars' => 4,
                'phone' => '024 3926 3641',
                'description' => 'Hanoi La Siesta Central Hotel & Spa là địa điểm lý tưởng cho du khách quốc tế. Nằm trong bán kính 300 m từ Đền Ngọc Sơn và 700 m từ Ô Quan Chưởng. Mọi phòng tại Hanoi La Siesta Central Hotel & Spa đều trang bị đầy đủ tiện nghi hiện đại như bàn ghế, TV màn hình phẳng, phòng tắm riêng, máy điều hòa, bàn làm việc và máy pha cà phê. Bảo đảm thoải mái và tiện nghi khi lưu trú.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        DB::table('hotels')->insert($hotels);
        $this->info('Seeded hotels table successfully.');
    }

    /**
     * Seed data for vehicles table
     *
     * @return void
     */
    private function seedVehiclesTable()
    {
        $vehicles = [
            [
                'id' => 1,
                'type' => 'Bus',
                'model' => 'Volvo 7900 Hybrid',
                'license_plate' => '44A-01734',
                'capacity' => 58,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'type' => 'Bus',
                'model' => 'Golden Dragon XML6102',
                'license_plate' => '45C-01845',
                'capacity' => 52,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'type' => 'Bus',
                'model' => 'Hyundai Aero City',
                'license_plate' => '29B-00123',
                'capacity' => 50,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'type' => 'Bus',
                'model' => 'Mercedes-Benz Intouro',
                'license_plate' => '29B-00456',
                'capacity' => 55,
                'driver_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'type' => 'Car',
                'model' => 'Toyota Camry',
                'license_plate' => '51D-12345',
                'capacity' => 5,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'type' => 'Car',
                'model' => 'Honda Civic',
                'license_plate' => '52E-23456',
                'capacity' => 5,
                'driver_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'type' => 'Aircraft',
                'model' => 'Boeing 737',
                'license_plate' => '03B-56789',
                'capacity' => 200,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'type' => 'Aircraft',
                'model' => 'Airbus A320',
                'license_plate' => '04C-67890',
                'capacity' => 180,
                'driver_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'type' => 'Train',
                'model' => 'Shinkansen N700',
                'license_plate' => '15F-98765',
                'capacity' => 600,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'type' => 'Train',
                'model' => 'Eurostar E320',
                'license_plate' => '16G-87654',
                'capacity' => 500,
                'driver_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('vehicles')->insert($vehicles);
        $this->info('Seeded vehicles table successfully.');
    }

    /**
     * Seed data for drivers table
     *
     * @return void
     */
    private function seedDriversTable()
    {
        $drivers = [
            [
                'name' => 'Driver 1',
                'avatar' => 'path/to/avatar1.jpg',
                'phone' => '55511234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            

            
        ];

        DB::table('drivers')->insert($drivers);
        $this->info('Seeded drivers table successfully.');
    }

    /**
     * Seed data for tour_guides table
     *
     * @return void
     */
    private function seedTourGuidesTable()
    {
        $tourGuides = [
            [
                'id' => 1,
                'name' => 'Nguyễn Đình Thắng',
                'avatar' => 'path/to/avatar1.jpg',
                'phone' => '555-1111',
                'email' => 'nguyendinhthang@gmail.com',
                'bio' => 'Nguyễn Đình Thắng là một hướng dẫn viên có kinh nghiệm lâu năm trong ngành du lịch. Anh có niềm đam mê sâu sắc với lịch sử và văn hóa địa phương. Với sự am hiểu sâu rộng và sự nhiệt huyết, Nguyễn Đình Thắng luôn mang lại trải nghiệm độc đáo và đáng nhớ cho khách du lịch.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Trần Thị Hương',
                'avatar' => 'path/to/avatar2.jpg',
                'phone' => '555-2222',
                'email' => 'huongtran@gmail.com',
                'bio' => 'Trần Thị Hương là một hướng dẫn viên năng động và thân thiện, có khả năng giao tiếp tốt và sự hiểu biết sâu sắc về các điểm tham quan địa phương. Với kinh nghiệm dày dặn và sự quan tâm tận tâm đến từng chi tiết, Hương luôn đảm bảo du khách có một chuyến đi thú vị và an toàn.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Lê Văn Nam',
                'avatar' => 'path/to/avatar3.jpg',
                'phone' => '555-3333',
                'email' => 'namle@gmail.com',
                'bio' => 'Lê Văn Nam là một hướng dẫn viên tài năng với khả năng tổ chức tuyệt vời và sự chăm sóc tận tâm đến từng khách hàng. Nam có kinh nghiệm dày dặn trong việc dẫn tour và biết cách kết nối với mọi đối tượng khách hàng. Anh luôn mong muốn mang lại cho du khách những kỷ niệm đáng nhớ và những trải nghiệm đầy ý nghĩa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Phạm Thị Mai',
                'avatar' => 'path/to/avatar4.jpg',
                'phone' => '555-4444',
                'email' => 'maipham@gmail.com',
                'bio' => 'Phạm Thị Mai là một hướng dẫn viên có sự nhiệt huyết và khả năng giao tiếp tuyệt vời. Với sự am hiểu sâu rộng về văn hóa địa phương và lịch sử, Mai luôn mang đến cho du khách những trải nghiệm đáng nhớ và kiến thức bổ ích.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Nguyễn Văn Hùng',
                'avatar' => 'path/to/avatar5.jpg',
                'phone' => '555-5555',
                'email' => 'hungnguyen@gmail.com',
                'bio' => 'Nguyễn Văn Hùng là một hướng dẫn viên nhiệt huyết với đam mê khám phá và chia sẻ kiến thức. Anh có kinh nghiệm phong phú trong lĩnh vực du lịch và luôn nỗ lực mang đến cho du khách những trải nghiệm tuyệt vời nhất.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Hoàng Thị Lan',
                'avatar' => 'path/to/avatar6.jpg',
                'phone' => '555-6666',
                'email' => 'lanhoang@gmail.com',
                'bio' => 'Hoàng Thị Lan là một hướng dẫn viên chuyên nghiệp với kinh nghiệm lâu năm trong việc dẫn dắt tour du lịch. Với sự quan tâm tận tâm và kiến thức sâu rộng về các địa danh du lịch, Lan luôn mang đến cho du khách những trải nghiệm đầy ý nghĩa và đáng nhớ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Đỗ Minh Tuấn',
                'avatar' => 'path/to/avatar7.jpg',
                'phone' => '555-7777',
                'email' => 'tuando@gmail.com',
                'bio' => 'Đỗ Minh Tuấn là một hướng dẫn viên tài năng với khả năng tổ chức và giao tiếp xuất sắc. Anh có niềm đam mê sâu sắc với lịch sử và văn hóa địa phương, luôn mong muốn chia sẻ những kiến thức và trải nghiệm đặc biệt với du khách.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Vũ Thị Ngọc',
                'avatar' => 'path/to/avatar8.jpg',
                'phone' => '555-8888',
                'email' => 'ngocvu@gmail.com',
                'bio' => 'Vũ Thị Ngọc là một hướng dẫn viên nhiệt huyết và chuyên nghiệp. Với kinh nghiệm phong phú và sự quan tâm tận tâm đến từng chi tiết, Ngọc luôn mang đến cho du khách những trải nghiệm du lịch đáng nhớ và thú vị.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'Lê Đức Anh',
                'avatar' => 'path/to/avatar9.jpg',
                'phone' => '555-9999',
                'email' => 'anhle@gmail.com',
                'bio' => 'Lê Đức Anh là một hướng dẫn viên có kinh nghiệm lâu năm và sự am hiểu sâu sắc về lịch sử và văn hóa địa phương. Anh luôn mang đến cho du khách những trải nghiệm tuyệt vời và những kỷ niệm đáng nhớ trong các chuyến đi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'name' => 'Phan Thanh Hà',
                'avatar' => 'path/to/avatar10.jpg',
                'phone' => '555-1010',
                'email' => 'haphan@gmail.com',
                'bio' => 'Phan Thanh Hà là một hướng dẫn viên tận tâm và chuyên nghiệp, luôn mong muốn mang lại cho du khách những trải nghiệm du lịch đặc biệt và đáng nhớ nhất.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'name' => 'Lê Thị Hà',
                'avatar' => 'path/to/avatar14.jpg',
                'phone' => '555-1414',
                'email' => 'hale@gmail.com',
                'bio' => 'Lê Thị Hà là một hướng dẫn viên chuyên nghiệp với kinh nghiệm dẫn tour đa dạng và sự am hiểu sâu rộng về văn hóa địa phương. Với sự quan tâm tận tâm và tình yêu với nghề, Hà luôn cố gắng mang đến cho du khách những trải nghiệm tuyệt vời nhất.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'name' => 'Nguyễn Văn Phúc',
                'avatar' => 'path/to/avatar15.jpg',
                'phone' => '555-1515',
                'email' => 'phucnguyen@gmail.com',
                'bio' => 'Nguyễn Văn Phúc là một hướng dẫn viên tận tâm và có kinh nghiệm trong lĩnh vực du lịch. Anh có khả năng giao tiếp xuất sắc và luôn cố gắng mang đến cho du khách những trải nghiệm du lịch đáng nhớ và ý nghĩa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tour_guides')->insert($tourGuides);
        $this->info('Seeded tour_guides table successfully.');
    }

    /**
     * Seed data for tours table
     *
     * @return void
     */
    private function seedToursTable()
    {
        $tours = [
            [
                'area_id' => 1,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Kỳ nghỉ Hà Nội - Sapa',
                'description' => 'Khám phá vẻ đẹp hùng vĩ của Sapa với những thửa ruộng bậc thang và các dân tộc thiểu số.',
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-05',
                'price' => 1200,
                'number_of_participants' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 2,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Hành trình Văn hóa Huế - Hội An',
                'description' => 'Đắm mình trong di sản văn hóa phong phú của Huế và phố cổ Hội An.',
                'start_date' => '2024-07-05',
                'end_date' => '2024-07-10',
                'price' => 1500,
                'number_of_participants' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 3,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Chuyến phiêu lưu Đà Nẵng - Bà Nà Hills',
                'description' => 'Thưởng thức vẻ đẹp ngoạn mục của Bà Nà Hills và khám phá Cầu Vàng.',
                'start_date' => '2024-07-10',
                'end_date' => '2024-07-15',
                'price' => 1100,
                'number_of_participants' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 4,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Khám phá Sài Gòn - Đồng Bằng Sông Cửu Long',
                'description' => 'Khám phá cảnh quan xanh mát và thăm thị trường nổi của Đồng Bằng Sông Cửu Long.',
                'start_date' => '2024-07-15',
                'end_date' => '2024-07-20',
                'price' => 1300,
                'number_of_participants' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 5,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Nghỉ dưỡng Đảo Phú Quốc',
                'description' => 'Thư giãn trên những bãi biển hoang sơ và khám phá vẻ đẹp tự nhiên của Đảo Phú Quốc.',
                'start_date' => '2024-07-20',
                'end_date' => '2024-07-25',
                'price' => 1400,
                'number_of_participants' => 16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 1,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Tour ẩm thực Hà Nội',
                'description' => 'Trải nghiệm đa dạng và ngon miệng của ẩm thực Hà Nội qua tour này.',
                'start_date' => '2024-07-25',
                'end_date' => '2024-07-30',
                'price' => 900,
                'number_of_participants' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 2,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Thủ đô cổ Hòa Lư - Ninh Bình',
                'description' => 'Khám phá lịch sử của Hoa Lư - thủ đô cổ và cảnh đẹp ngoạn mục của Ninh Bình.',
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-05',
                'price' => 1250,
                'number_of_participants' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 3,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Đà Nẵng - Hành trình Thánh địa Mỹ Sơn',
                'description' => 'Khám phá di sản cổ của Thánh địa Mỹ Sơn và tận hưởng vẻ đẹp bờ biển của Đà Nẵng.',
                'start_date' => '2024-08-05',
                'end_date' => '2024-08-10',
                'price' => 1350,
                'number_of_participants' => 17,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 4,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Khám phá Địa đạo Củ Chi',
                'description' => 'Tìm hiểu về lịch sử của Địa đạo Củ Chi và khám phá mạng lưới phức tạp của nó.',
                'start_date' => '2024-08-10',
                'end_date' => '2024-08-15',
                'price' => 1150,
                'number_of_participants' => 16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 5,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Phong Nha - Kẻ Bàng - Cuộc phiêu lưu',
                'description' => 'Khám phá hang động tuyệt đẹp và những ngọn núi đá vôi của Vườn quốc gia Phong Nha - Kẻ Bàng.',
                'start_date' => '2024-08-15',
                'end_date' => '2024-08-20',
                'price' => 1450,
                'number_of_participants' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 1,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Thiên nhiên thô cứng Hà Giang - Đồng Văn',
                'description' => 'Khám phá chuyến đi mạo hiểm qua vẻ đẹp dã man của Hà Giang và Đồng Văn.',
                'start_date' => '2024-08-20',
                'end_date' => '2024-08-25',
                'price' => 1550,
                'number_of_participants' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 2,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Quảng Bình - Khám phá Hang Động Thiên Đường',
                'description' => 'Khám phá vẻ đẹp huyền bí của Hang Động Thiên Đường và những kỳ quan thiên nhiên khác tại Quảng Bình.',
                'start_date' => '2024-08-25',
                'end_date' => '2024-08-30',
                'price' => 1300,
                'number_of_participants' => 16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 3,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Hội An - Trải nghiệm Lễ hội Đèn Lồng',
                'description' => 'Tham gia vào Lễ hội Đèn Lồng lãng mạn và khám phá sức hút văn hóa của Hội An.',
                'start_date' => '2024-09-01',
                'end_date' => '2024-09-05',
                'price' => 1400,
                'number_of_participants' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 4,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Cần Thơ - Thăm thị trường nổi Cái Răng',
                'description' => 'Trải nghiệm không khí sôi động của thị trường nổi Cái Răng tại Cần Thơ.',
                'start_date' => '2024-09-05',
                'end_date' => '2024-09-10',
                'price' => 1200,
                'number_of_participants' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 1,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Làng Chài Mũi Né - Trải nghiệm Đờn ca tài tử',
                'description' => 'Khám phá vẻ đẹp của Làng Chài Mũi Né và thưởng thức âm nhạc đờn ca tài tử truyền thống.',
                'start_date' => '2024-09-10',
                'end_date' => '2024-09-15',
                'price' => 1100,
                'number_of_participants' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 2,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Đền Mỹ Sơn - Di sản thế giới của Quảng Nam',
                'description' => 'Khám phá các đền tháp cổ của Mỹ Sơn - Di sản thế giới tại Quảng Nam.',
                'start_date' => '2024-09-15',
                'end_date' => '2024-09-20',
                'price' => 1250,
                'number_of_participants' => 17,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 3,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Đảo Cát Bà - Bãi biển Vũng Đục',
                'description' => 'Nghỉ dưỡng tại Bãi biển Vũng Đục và khám phá sự hấp dẫn của Đảo Cát Bà.',
                'start_date' => '2024-09-25',
                'end_date' => '2024-09-30',
                'price' => 1300,
                'number_of_participants' => 16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 4,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Vịnh Hạ Long - Khám phá thế giới kỳ diệu của đá vôi',
                'description' => 'Khám phá hệ thống hang động và những ngọn đá vôi kỳ diệu của Vịnh Hạ Long.',
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-05',
                'price' => 1350,
                'number_of_participants' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 5,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Núi Bà Đen - Chinh phục đỉnh cao đồi núi',
                'description' => 'Tham gia cuộc phiêu lưu leo núi Bà Đen và tận hưởng cảnh quan hoang sơ từ đỉnh núi.',
                'start_date' => '2024-10-10',
                'end_date' => '2024-10-15',
                'price' => 1400,
                'number_of_participants' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 1,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Chợ phiên Sapa - Trải nghiệm văn hóa dân tộc',
                'description' => 'Tham gia vào các chợ phiên văn hóa của Sapa và khám phá sự đa dạng của các dân tộc thiểu số.',
                'start_date' => '2024-10-20',
                'end_date' => '2024-10-25',
                'price' => 1450,
                'number_of_participants' => 16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 2,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Đường Lâm - Làng cổ Hà Nội',
                'description' => 'Khám phá lịch sử và vẻ đẹp kiến trúc của Làng cổ Đường Lâm, nơi được bảo tồn những giá trị văn hóa truyền thống của Hà Nội.',
                'start_date' => '2024-10-25',
                'end_date' => '2024-10-30',
                'price' => 1200,
                'number_of_participants' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 4,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Lễ hội Rước đèn lồng Hội An',
                'description' => 'Tham gia vào Lễ hội Rước đèn lồng ấn tượng của Hội An và khám phá sự huyền bí của đèn lồng truyền thống.',
                'start_date' => '2024-11-05',
                'end_date' => '2024-11-10',
                'price' => 1350,
                'number_of_participants' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 5,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Vườn quốc gia Cát Tiên - Cuộc phiêu lưu thiên nhiên',
                'description' => 'Khám phá vẻ đẹp hoang sơ của Vườn quốc gia Cát Tiên và tham gia các hoạt động khám phá thiên nhiên.',
                'start_date' => '2024-11-15',
                'end_date' => '2024-11-20',
                'price' => 1400,
                'number_of_participants' => 16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 1,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Khám phá Hà Nội qua văn hóa ẩm thực',
                'description' => 'Trải nghiệm văn hóa ẩm thực đặc sắc của Hà Nội qua các món ăn truyền thống và hiện đại.',
                'start_date' => '2024-11-25',
                'end_date' => '2024-11-30',
                'price' => 1200,
                'number_of_participants' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 2,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Đảo Bình Ba - Bãi biển Hoàng Hôn',
                'description' => 'Nghỉ dưỡng tại bãi biển Hoàng Hôn và khám phá sự hoang sơ và đẹp tự nhiên của Đảo Bình Ba.',
                'start_date' => '2024-12-01',
                'end_date' => '2024-12-05',
                'price' => 1300,
                'number_of_participants' => 17,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 3,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Làng nghề Lục Ngạn - Thủ công mỹ nghệ Quảng Ninh',
                'description' => 'Khám phá và tham gia vào các hoạt động thủ công mỹ nghệ tại Làng nghề Lục Ngạn, Quảng Ninh.',
                'start_date' => '2024-12-05',
                'end_date' => '2024-12-10',
                'price' => 1250,
                'number_of_participants' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 4,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Trải nghiệm Cáp treo Bà Nà - Đà Nẵng',
                'description' => 'Thưởng thức cảnh quan từ Cáp treo Bà Nà và khám phá các hoạt động giải trí tại khu nghỉ dưỡng Bà Nà Hills.',
                'start_date' => '2024-12-10',
                'end_date' => '2024-12-15',
                'price' => 1400,
                'number_of_participants' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 5,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Phú Yên - Mũi Điện - Đại Lãnh',
                'description' => 'Khám phá vẻ đẹp hoang sơ của Mũi Điện và hòa mình vào không gian thiên nhiên tại Đại Lãnh, Phú Yên.',
                'start_date' => '2024-12-15',
                'end_date' => '2024-12-20',
                'price' => 1450,
                'number_of_participants' => 16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 1,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Thủ đô cổ Huế - Di sản văn hóa thế giới',
                'description' => 'Khám phá các di tích lịch sử và văn hóa của Huế, thành phố thủ đô cổ của Việt Nam.',
                'start_date' => '2024-12-25',
                'end_date' => '2024-12-30',
                'price' => 1500,
                'number_of_participants' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 2,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Đồng Tháp - Trải nghiệm văn hóa miền Tây',
                'description' => 'Tham gia vào các hoạt động trải nghiệm văn hóa dân gian miền Tây tại Đồng Tháp.',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-05',
                'price' => 1200,
                'number_of_participants' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_id' => 3,
                'hotel_id' => 1,
                'vehicle_id' => 1,
                'guide_id' => 1,
                'name' => 'Lễ hội Lồng đèn Đông Hà',
                'description' => 'Tham gia vào Lễ hội Lồng đèn truyền thống tại Đông Hà, Quảng Trị.',
                'start_date' => '2025-01-05',
                'end_date' => '2025-01-10',
                'price' => 1250,
                'number_of_participants' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tours')->insert($tours);
        $this->info('Seeded tours table successfully.');
    }

    /**
     * Seed data for tour_images table
     *
     * @return void
     */
    private function seedTourImagesTable()
    {
        $tourImages = [
            [
                'tour_id' => 1,
                'image' => 'path/to/image1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tour_images')->insert($tourImages);
        $this->info('Seeded tour_images table successfully.');
    }
}