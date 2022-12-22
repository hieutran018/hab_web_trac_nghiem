<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Faker\Factory;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Factory::create();
        $limit = 3;
        $listCate = ['1','2','3'];
        $listtitle = ['Nhà khoa học Mỹ tạo giống lúa chịu ngập được 2 tuần','
Trình UNESCO hồ sơ quốc gia "Di sản Văn hóa Mo Mường"','Tổng giám đốc Tổng công ty Công nghiệp Tàu thủy bị khiển trách'];
        $listContent = ['
Khoa họcKhoa học trong nướcThứ năm, 22/12/2022, 11:30 (GMT+7)
Nhà khoa học Mỹ tạo giống lúa chịu ngập được 2 tuần
GS Pamela C. Ronald vừa nhận giải đặc biệt của VinFuture 2022 cho nghiên cứu phân lập gene lúa đặc hiệu để tạo ra các giống lúa năng suất cao, chịu được ngập úng.

Trong lễ vinh danh tối 20/12 tại Hà Nội, GS Pamela C. Ronald (61 tuổi) bày tỏ sự xúc động khi hội đồng giải thưởng Khoa học công nghệ toàn cầu - VinFuture xướng tên bà ở hạng mục "giải đặc biệt dành cho nhà khoa học nữ", trị giá 500.000 USD.

Công trình của GS Pamela C. Ronald tiên phong nghiên cứu phân lập gene lúa (Sub1A) để phát triển các giống lúa năng suất cao, chịu ngập vượt trội. Đây là một phát hiện đột phá trong lĩnh vực nghiên cứu giống lúa. Giống lúa này phù hợp với điều kiện trồng trọt ở Lào, Bangladesh, Ấn Độ và có thể được áp dụng thêm ở quốc gia khác. Tại Việt Nam, người dân nhiều địa phương đang trồng giống lúa Khang Dân được lai tạo từ Sub1 như Hải Dương và một số tỉnh trung du miền Trung.','Bà Bùi Thị Niềm - Giám đốc Sở Văn hóa - Thể thao và Du lịch tỉnh Hòa Bình, Trưởng Ban xây dựng hồ sơ quốc gia "Di sản Văn hóa Mo Mường" - cho biết sắp tới sẽ tổ chức hội thảo quốc tế về chủ đề "Mo Mường và những hình thức nghi lễ tín ngưỡng tương đồng trên thế giới".
Ban xây dựng hồ sơ quốc gia sẽ tiếp tục sưu tầm, thu thanh, ghi hình về "Di sản Văn hóa Mo Mường" tại các tỉnh Thanh Hóa, Đắk Lắk và TP Hà Nội; viết hồ sơ khoa học và làm hậu kỳ các phim tư liệu, tổ chức thẩm định hồ sơ... Đây là những dữ liệu và cơ sở quan trọng để đệ trình UNESCO công nhận "Di sản Văn hóa Mo Mường", và được ghi danh vào danh sách Di sản Văn hóa phi vật thể cần bảo vệ khẩn cấp.','Ông Cao Thành Đồng, Tổng giám đốc Tổng Công ty Công nghiệp Tàu thủy bị Ủy ban Kiểm tra Trung ương khiển trách trong kỳ họp 24 diễn ra ngày 20-21/12.

Ủy ban Kiểm tra Trung ương cũng khiển trách Ban Thường vụ Đảng ủy Tổng công ty Công nghiệp Tàu thủy nhiệm kỳ 2015-2020; cảnh cáo Ban Thường vụ Đảng ủy Tổng Công ty nhiệm kỳ 2010-2015 và ông Vũ Anh Tuấn, Bí thư Đảng ủy, Chủ tịch Hội đồng thành viên.

Cơ quan Kiểm tra Trung ương đề nghị Ban Bí thư xem xét, kỷ luật ông Nguyễn Ngọc Sự, nguyên Ủy viên Ban Chấp hành Đảng bộ Khối Doanh nghiệp Trung ương, nguyên Bí thư Đảng ủy, nguyên Chủ tịch Hội đồng thành viên.
Đầu tháng 11, Ủy ban Kiểm tra Trung ương kết luận, ông Vũ Anh Tuấn, Chủ tịch Hội đồng thành viên và Cao Thành Đồng, Tổng giám đốc Tổng công ty Công nghiệp Tàu thủy, vi phạm đến mức phải xem xét kỷ luật.

Ban Thường vụ Đảng ủy Tổng công ty các nhiệm kỳ 2010-2015, 2015-2020 bị xác định vi phạm nguyên tắc tập trung dân chủ, quy chế làm việc; buông lỏng lãnh đạo, chỉ đạo, thiếu kiểm tra, giám sát. Hậu quả, Hội đồng thành viên, Ban tổng giám đốc, các đơn vị trực thuộc và một số cá nhân vi phạm quy định của Đảng, pháp luật của Nhà nước trong việc quản lý và sử dụng kinh phí tái cơ cấu doanh nghiệp, làm thất thoát, lãng phí lớn tiền và tài sản của Nhà nước, nhiều cá nhân bị xử lý hình sự.

Những vi phạm nêu trên "gây hậu quả nghiêm trọng, ảnh hưởng xấu đến uy tín của tổ chức đảng và Tổng công ty Công nghiệp Tàu thủy, đến mức phải xem xét, xử lý kỷ luật".

Tổng công ty Công nghiệp Tàu thủy được Bộ Giao thông Vận tải thành lập từ năm 2013, trên cơ sở tổ chức lại Công ty mẹ và một số đơn vị thành viên của Tập đoàn Công nghiệp Tàu thủy Việt Nam. SBIC là công ty trách nhiệm hữu hạn một thành viên do Nhà nước nắm giữ 100% vốn điều lệ.

Tại kỳ họp 24, Ủy ban Kiểm tra Trung ương đã xem xét kết quả giám sát và nhận thấy, Ban cán sự đảng Bộ Tài nguyên và Môi trường có một số vi phạm, khuyết điểm trong thực hiện các nguyên tắc và quy định của Đảng; thiếu trách nhiệm, buông lỏng lãnh đạo, chỉ đạo.

Hậu quả là Bộ và một số tổ chức, cá nhân có vi phạm, khuyết điểm trong công tác cán bộ; trong tham mưu, xây dựng, ban hành và tổ chức thực hiện thể chế, chính sách về đất đai, tài nguyên, khoáng sản, bảo vệ môi trường; trong thực hiện một số dự án đầu tư công và trong công tác kiểm tra, thanh tra.

Cơ quan kiểm tra Trung ương yêu cầu Ban cán sự đảng Bộ Tài nguyên và Môi trường kiểm điểm, rút kinh nghiệm; kịp thời lãnh đạo, chỉ đạo khắc phục các vi phạm, khuyết điểm đã được chỉ ra; chỉ đạo kiểm tra, thanh tra, kiểm điểm, xem xét trách nhiệm các tổ chức, cá nhân có liên quan.'];
        $lstImage = ['1670763714.jpg','1670763810.jpg','1670764148.jpg'];

        for ($i = 0; $i < $limit; $i++){
            DB::table('news')->insert([
                'title' => $listtitle[$i],
                'news_content' => $listContent[$i],
                'image'=>$lstImage[$i],
                'user_id'=> 1,
                'news_category_id'=>$listCate[$i],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
                'status'=>1,
            ]);
        }
    }
}