<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 50 sản phẩm mẫu
        // Product::factory(60)->create();

        // Tạo sản phẩm với thông tin cụ thể

        /////////////////////////////////////////////////////////// seller 1: Thế Giới Thời Trang
        Product::create([
            'name' => 'Đầm tiểu thư trễ vai xoè tầng đính tag nơ, váy bèo tầng sang chảnh chất tơ xốp',
            'description' => 'HOT HOT SHOP TOÀN ĐỒ XINH
                Hiinea_store Mang Đến Vẻ Đẹp Cho Các Nàng !!!
                Đầm tiểu thư trễ vai xoè tầng đính tag nơ, váy bèo tầng sang chảnh chất tơ xốp có mút ngực HV246

                + Chất liệu: tơ xốp
                + Size : S<48kg, eo<67cm
                        M<56kg, eo<72cm
                + Màu sắc : kem/hồng/đen
                + Xuất xứ : Việt Nam

                🌀 Màu sắc ( lưu ý ) :
                ● Do ánh sáng góc chụp, màn hình khác nhau, hàng thật có thể khác với hình ảnh. Vui lòng lấy sản phẩm thật làm tiêu chuẩn!
                🌀 Cam kết: Chất lượng và Mẫu mã Sản phẩm giống với Hình ảnh.
                🔥Lưu ý : 
                + Giao hàng tận nơi. Nhận hàng thanh toán.
                (Nếu Sản phẩm bị lỗi Quý khách vui lòng inbox liên hệ Shop để được hỗ trợ đổi hàng hoặc Trả hàng/Hoàn tiền cho Khách ạ. Rất mong Quý Khách đừng vì lỗi nhỏ mà cho Shop 1 - 2 sao tội nghiệp Shop! Và đồng nghĩa Quý khách sẽ mất đi quyền lợi đổi hàng nha)

                🌞 𝐇𝐔̛𝐎̛́𝐍𝐆 𝐃𝐀̂̃𝐍 𝐒𝐔̛̉ 𝐃𝐔̣𝐍𝐆:
                1. Giặt máy ở nhiệt độ thường, khuyến khích giặt tay
                2. Không sử dụng nước tẩy chứa CLO
                3. Không sấy khô/ủi khô sản phẩm
                4. Nên phơi sản phẩm ở nơi thoáng mát, tránh để ẩm ướt kéo dài gây mốc
                
                🌞 Đ𝐈𝐄̂̀𝐔 𝐊𝐈𝐄̣̂𝐍 𝐀́𝐏 𝐃𝐔̣𝐍𝐆 Đ𝐎̂̉𝐈/𝐓𝐑𝐀̉ 𝐇𝐀̀𝐍𝐆:
                1. Shop chịu toàn bộ chi phí vận chuyển đổi/trả hàng trong những trường hợp sau: hàng lỗi (rách, lem màu, hỏng cúc,...), giao sai mẫu, sai màu.
                2. Chỉ nhận đổi trả 7 ngày từ khi nhận hàng 
                3. Có video quay quá trình mở gói hàng đầy đủ
                4. Sản phẩm chưa qua sử dụng, giặt ủi, còn nguyên tem mac.
                Mời quý khách "𝑴𝑼𝑨 𝑵𝑮𝑨𝒀" để sở hữu ngay sản phẩm tuyệt vời này! 
                𝘾𝙖̉𝙢 𝙤̛𝙣 𝙦𝙪𝙮́ 𝙠𝙝𝙖́𝙘𝙝! 💋',
            'status' => 'active',
            'seller_id' => 1, 
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Áo Khoác Da Thời Trang Vintage Cho Nữ Áo Blazer Rộng Ngắn Của Phụ Mùa Thu Nữ',
            'description' => '⭐★Cửa hàng chúng tôi vận chuyển từ Hà Nội, không cần phải chờ đợi
                ⭐Tất cả các sản phẩm đều hoàn toàn mới.
                ⭐Hãy ghé thăm cửa hàng của chúng tôi hàng năm. ✔️Nhận phần thưởng
                ⭐Ưu tiên vận chuyển các sản phẩm của chúng tôi

                Màu sắc: đen, nâu
                Danh mục sản phẩm: Quần áo/Áo khoác da
                Kích thước: mét, chiều dài, XL, 2XL
                Loại phong cách: giải trí Nhật Bản và Hàn Quốc
                Cổ áo: Ve áo
                Yếu tố phổ biến: túi
                Phân loại da: da nhân tạo
                Kiểu tay áo: tay áo thông thường
                Phòng thí nghiệm: Dây kéo
                Thành phần vải chính: PU
                Quần áo: Kiểu thông thường (50cm<chiều dài quần áo 65cm)
                Giới tính áp dụng: Nữ
                Phong cách xuyên biên giới: đường phố cá tính
                Nhóm tuổi áp dụng: Người lớn
                Tay áo dài: tay áo dài
                Phong cách: Phong cách thông thường
                Quy trình: vật liệu composite

                ♥Bạn có thể tham khảo ý kiến ​​nhân viên chăm sóc khách hàng trước khi mua hàng và chúng tôi sẽ giới thiệu size phù hợp cho bạn.
                ●Chúng tôi tập trung vào thời trang, sự trẻ trung và sự thoải mái. Tận hưởng mua sắm.
                ◆Do các yếu tố như độ sáng và độ sáng của màn hình, màu sắc thực tế của sản phẩm có thể hơi khác so với hình ảnh hiển thị trên trang web.

                🍄Nếu khách hàng có thắc mắc vui lòng liên hệ với chúng tôi trước. Cửa hàng của chúng tôi sẵn sàng giúp bạn giải quyết vấn đề này.
                🍓Khi khách hàng hài lòng với sản phẩm của chúng tôi. Đừng quên cung cấp 5 cửa hàng tiêu chuẩn để tiếp tục hoạt động sau khi nhận hàng🍓🍓',
            'status' => 'active',
            'seller_id' => 1, 
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Sét Váy Dạ 3 Món Áo Dạ Phối Cổ Sơ Mi 2 Lớp Có Đệm Vai+Chân Váy Xếp Ly Có Quần Váy',
            'description' => 'SET DẠ HOT 3 MÓN PHỐI CỔ TAY KÈM ĐAI DA
                🍀Áo phối kẻ siêu đẹp, chất dạ text 2 lớp lên form đứng dáng lắm ạ
                Chân váy xếp ly liền quần thoải mái vận động không sợ lộ nha
                ➖Tặng kèm thêm đai da sịn sò
                
                ---------------------------------------

                Chất liệu: Dạ 
                Size: S, M, L
                📌 Bảng size tham khảo :
                    Size S dưới 47kg 
                Size M từ 48-54kg
                Size L từ  55-60kg(Tùy Chiều Cao Nhé)

                -----------------------------------------

                🌿LUỐN ĐẶT UY TÍN  LÊN HÀNG ĐẦU
                🌿GIÁ RẺ ĐẾN TẬN TAY KHÁCH HÀNG
                ❤️Shop chuyên sỉ, lẻ quần áo giá tận xưởng không qua trung gian
                ❤️Cập nhập mẫu mã liên tục giá tốt nhất
                ❤️ Liên tục tuyển sỉ CTV toàn quốc - LẤY CÀNG NHIỀU • GIÁ CÀNG YÊU
                =>> Lưu ý:
                    + Khách đặt hàng online sẽ nhận được hàng sau khoảng 1-3 ngày làm việc tùy theo khoảng cách và đơn vị vận chuyển. 
                + Mọi thắc mắc, góp ý về sản phẩm, giao hàng vui lòng nhắn tin trực tiếp cho Shop
                + Đối với các mặt hàng đổi trả bảo hành, vui lòng liên hệ và cung cấp hình ảnh cũng như chi tiết lỗi để chuyên viên bên shop đánh giá, khắc phục đảm bảo quyền lợi cho quý khách.

                ♥️ Xin chân thành cảm',
            'status' => 'active',
            'seller_id' => 1, 
            'category_id' => 2,
        ]);
    }
}
