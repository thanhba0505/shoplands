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
        // product_id: 1
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

        // product_id: 2
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

        // product_id: 3
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

        // product_id: 4
        Product::create([
            'name' => 'Set đồ nữ áo khoác kaki mix áo lot chất cotton sang chảnh cá tính và chân váy ngắn xinh xắn dành cho các nàng đi chơi',
            'description' => '😍Chất liệu :   Kaki lot cotton có lót trong   😍
                😍 Form:  Freesize (40-59kg tùy chiều cao) 
                😍 V1 ( Vòng ngực):  dưới 92cm
                😍V2 (Vòng Eo): dưới 78cm
                😍 V3 : Dưới 92cm
                😍 1m50 - 1m55 từ 40 - 46kg vừa
                😍 1m55 - 1m6 từ 47 - 53kg vừa
                Trên 1m6 từ 51kg - 55kg vừa
                💎Váy tiểu thư bánh bèo cực cưng cho các nàng
                💎set đẹp tôn da dã man nhé
                💎Dáng xoè ngắn nên dưới m6 mặc sẽ xinh hơn ạ 
                Nhanh tay đặt hàng để nhận nhiều ưu đãi của shop các nàng ơi ❤

                =>> LƯU Ý:
                + Khách đặt hàng online sẽ nhận được hàng sau khoảng 1-4 ngày làm việc tùy theo khoảng cách và đơn vị vận chuyển. 
                + Mọi thắc mắc, góp ý về sản phẩm, giao hàng vui lòng liên hệ với shop để được hỗ trợ trực tiếp và nhanh nhất. 
                + Đối với các mặt hàng đổi trả, vui lòng liên hệ và cung cấp hình ảnh cũng như chi tiết lỗi để chuyên viên bên shop hỗ trợ , khắc phục đảm bảo quyền lợi cho quý khách.
                + Các mặt hàng bị lỗi hoặc không ưng , khách vui lòng CHAT hoặc liên hệ với  shop, trước khi đánh giá shop nhé! Shop sẽ hỗ trợ đổi trả hàng cho khách ạ',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 2,
        ]);

        // product_id: 5
        Product::create([
            'name' => 'Áo Sơ Mi Trắng Nữ Rymola, Không Nhăn, Giấu Nút, Tay Dài Có Bigsize, Sơ Mi Trắng, Công Sở Chất Vải Cotton Form Suông',
            'description' => 'Áo Sơ Mi Trắng Nữ Không Nhăn Giấu Nút Tay Dài Có Bigsize Rymola, Sơ Mi Trắng Công Sở Chất Vải Cotton Form Suông Basic cao cấp
                SHIP HOẢ TỐC - QUÝ KHÁCH NHẬN NGAY SAU KHI ĐẶT HÀNG 45 PHÚT

                THÔNG TIN SẢN PHẨM ÁO SƠ MI RYMOLA
                ✔️ Màu sắc: Trắng Tinh - Trắng Ngà - Đen
                ✔️ Chất Liệu: Cotton Mềm Mịn, chất vải đanh, mặc đứng dáng, chống nhăn, có độ thoáng khi mặc, thấm hút mồ hôi
                ✔️ Áo may 3 nút ngay ngực và có nẹp che nên đảm bảo không bị lộ hở bên trong.
                ✔️ Thiết kế basic giấu cúc, đơn giản dễ mặc và sử dụng, dễ phối với các trang phục khác
                ✔️ Size: S, M, L, XL, 2Xl, 3Xl, 4Xl

                HƯỚNG DẪN CHỌN SIZE
                ✪ Size có thể thay đổi tùy vào chiều cao mỗi người khác nhau nên khách đừng vội chọn SIZE theo đánh giá của khách hàng nhé!
                ✪ Nếu khó chọn SIZE hoặc còn đang phân vân đừng ngại ngần cứ chat với Shop để tư vấn chọn SIZE chuẩn nhất ạ!

                BẢNG SIZE

                S -- V1 < 80cm -- Vai: 32cm -- Hông: 80cm -- Dài Tay: 53cm -- Dài Áo: 62cm -- Cân Nặng: 38kg đến 43kg
                M -- V1 < 84cm -- Vai: 34cm -- Hông: 85cm -- Dài Tay: 55cm -- Dài Áo: 64cm -- Cân Nặng: 44kg đến 48kg
                L -- V1 < 88cm -- Vai: 36cm -- Hông: 90cm -- Dài Tay: 57cm -- Dài Áo: 66cm -- Cân Nặng: 49kg đến 52kg
                XL -- V1 < 92cm -- Vai: 38cm -- Hông: 95cm -- Dài Tay: 59cm -- Dài Áo: 68cm -- Cân Nặng: 53kg đến 58kg
                Lưu ý: Cách tốt nhất để chọn Size không bị sai số quý khách vui lòng dựa vào số đo Ngực (đã mặc áo ngực khi đo) hoặc nhắn tin ngay cho Shop để được tư vấn!

                RYMOLA CAM KẾT:

                Không bán hàng kém chất lượng.
                RYMOLA đã được đăng ký bảo hộ thương hiệu.
                Áo sơ mi 100% giống mô tả.
                Tư vấn nhiệt tình, chu đáo luôn lắng nghe khách hàng để phục vụ tốt.
                Giao hàng nhanh đúng tiến độ không phải để quý khách chờ đợi lâu để nhận hàng.
                ĐỔI TRẢ

                Shop rất dễ dàng trong việc đổi size và trả hàng.
                Quý khách vui lòng nhắn tin ngay cho shop để được tư vấn hỗ trợ.
                HƯỚNG DẪN GIẶT ỦI (LÀ):

                Tốt nhất nên giặt tay và không nên chà mạnh bằng bàn chải có sợi cứng.
                Nếu giặt máy, nên chọn chế độ giặt nhẹ và sản phẩm có chất vải phù hợp để bảo quản được lâu.
                Không nên sử dụng chất giặt tẩy.
                Không nên ngâm chung với trang phục ra bị màu.
                Tránh phơi với ánh nắng trực tiếp.
                Ủi (là) sản phẩm nếu cần và cài đặt nhiệt độ bàn ủi (là) phù hợp với từng loại vải.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 2,
        ]);

        // product_id: 6
        Product::create([
            'name' => 'Áo thun nữ form vừa SUNTEE STFV505 phong cách basic in hình 06 vải cotton 250GSM cao cấp thoáng mát',
            'description' => 'Tên sản phẩm: Áo thun nữ form vừa SUNTEE STFV505 phong cách basic in hình 06, vải cotton 250GSM cao cấp thoáng mát
                Mã sản phẩm: STFV505
                Chất liệu: Cotton 100% cao cấp, co giãn 2 chiều
                Kiểu dáng: Áo thun form vừa
                Nơi sản xuất: Việt Nam
                Thương hiệu: SUNTEE
                Họa tiết: In trên ngực áo, công nghệ in sắc nét, không bong tróc
                Màu sắc: Đen, Trắng, Nâu, Trắng kem

                Mô tả sản phẩm:

                Áo phông nữ basic dáng vừa được thiết kế bởi local brand SunTee.
                Thiết kế phong cách cơ bản, dễ mặc, dễ phối đồ.
                Phù hợp cho các bạn nữ diện đi chơi hoặc đi làm.
                Cam kết chất liệu cotton 100% cao cấp, thấm hút, thoáng mát, mang lại sự thoải mái và chất lượng tốt nhất.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 2,
        ]);

        // product_id: 7
        Product::create([
            'name' => 'Áo thun nữ , áo form vừa đẹp kiểu dáng trẻ trung chất liệu cotton co giãn bốn chiều mềm mại thoải mái khi mặc mỗi ngày',
            'description' => 'Áo thun nữ - Form vừa đẹp, kiểu dáng trẻ trung, chất liệu cotton co giãn bốn chiều mềm mại, thoải mái khi mặc mỗi ngày

                1. Giới thiệu sản phẩm:
                Chất liệu vải: 70% cotton và 30% poly
                Chất liệu: Thun cotton co giãn 4 chiều, mềm mại, thoáng mát, thấm hút mồ hôi
                Đường chỉ may kỹ lưỡng, tinh tế
                Form áo: Form vừa, thoải mái khi mặc hằng ngày
                Màu sắc:
                Kích thước có sẵn: S, M, L, XL
                Nơi sản xuất: Sản xuất trực tiếp tại xưởng – Hàng Việt Nam xuất khẩu

                2. Bảng hướng dẫn chọn size:
                Size S: 40kg - 50kg
                Size M: 51kg - 60kg
                Size L: 61kg - 67kg
                Size XL: 68kg - 75kg

                3. Chính sách bán hàng:
                Freeship cho mọi đơn hàng trên 50K
                Tặng mã voucher hoặc hoàn xu cho toàn bộ đơn hàng
                Về sản phẩm: Shop cam kết đúng như mô tả
                Về dịch vụ: Shop trả lời thắc mắc nhanh chóng
                Sản phẩm mới, sản xuất tại xưởng 100%
                Đổi trả: Quý khách có quyền đổi trả sản phẩm lỗi trong vòng 2 ngày

                4. Hân hạnh được phục vụ quý khách!',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 2,
        ]);

        // product_id: 8
        Product::create([
            'name' => 'Áo khoác Nỉ Crotop Hàn dáng rộng siêu xinh , Áo Sweater Nỉ Dài Tay ( có bigsize) - Hàng mới về',
            'description' => 'Áo khoác Nỉ Crotop Hàn dáng rộng siêu xinh , Áo Sweater Nỉ tay dài ( có bigsize)
                Thông tin item và cam đoan mua sắm chọn lựa tại shop
                ✔️ Xuất xứ: Hàng Quảng Châu Trung Quốc và sx kiến thiết riêng
                ✔️ Size : 
                            S M L XL XXL 3xl
                            Size S :dưới 50kg  Eo < 66, 
                            Size M : dưới 55kg  Eo < 70  
                            Size L : dưới 59kg  Eo 74, Mông 100
                            Size xl : 58-65kg eo 78cm
                            Size xxl 66-70kg eo 82 cm
                            Size 3xl 71-80kg eo 86cm 
                Size dựa vào cả độ cao và cân nặng 
                Chứ ngoài ra mỗi cân nặng❤️',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 2,
        ]);

        // product_id: 9
        Product::create([
            'name' => 'Áo khoác măng tô dáng dài QC cao cấp hàng loại 1 vải kaki lụa không nhăn',
            'description' => 'Shop chuyên nhập hàng loại 1, hàng Quảng Châu cao cấp, vải không nhăn, áo nặng khoảng gần 1kg nhé m.n

                size 
                size XS ( dưới 52kg): dài áo 109, ngực 106, dài tay 67, chu vi ống tay 35

                size S ( 52-57kg): dài áo 110, ngực 110, dài tay 68, chu vi ống tay 36

                size M ( 57-63kg) : dài áo 111, ngực 114, dài tay 69, chu vi ống tay 37

                size L ( 63-67kg): dài áo 112, ngực 118, dài tay 70, chu vi ống tay 38

                size XL ( 67-77kg): dài áo 113, ngực 122, dài tay 71, chu vi ống tay 39

                Hàng order 10-15 ngày',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 2,
        ]);

        // product_id: 10
        Product::create([
            'name' => 'Lovito Váy chữ A hoa Ditsy thường ngày dành cho nữ L71ED093',
            'description' => '✅ĐIỂM NỔI BẬT 
                -❤️Một dòng 
                -❤️Tweed 
                -❤️Zip bên

                ✅Mô TẢ 
                Mô hình: Ditsy Floral
                Phong cách: Giản dị
                Loại váy: A-Line
                Cộng với kích thước: Không
                Chất liệu: polyeste
                Thành phần: 100% Polyester
                Loại phù hợp: Slim Fit
                Trong suốt: Không
                Kéo dài: Không căng
                Xuất xứ: Trung Quốc đại lục 
                
                ✅GÓI BAO GỒM 
                1x váy',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 2,
        ]);
    }
}
