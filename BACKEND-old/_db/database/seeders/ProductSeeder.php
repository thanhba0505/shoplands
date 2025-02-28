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

        // product_id: 11
        Product::create([
            'name' => 'Áo sơ mi nam nữ tay ngắn chất kaki cao cấp kiểu dáng form rộng, unisex, dễ phối đồ mặc cực đẹp',
            'description' => 'I. SHOP CAM KẾT
                - Sản phẩm Áo sơ mi kaki tay lỡ form rộng giống mô tả 100%
                - Hình ảnh sản phẩm là ảnh thật, các hình hoàn toàn do shop tự thiết kế.
                - Kiểm tra  cẩn thận trước khi gói hàng giao cho Quý Khách
                - Hàng có sẵn, giao hàng ngay khi nhận được đơn 
                - Hoàn tiền nếu sản phẩm không giống với mô tả
                - Chấp nhận đổi hàng khi size không vừa trong 3 ngày.
                II. HỖ TRỢ ĐỔI TRẢ THEO QUY ĐỊNH CỦA SHOPEE
                - Điều kiện áp dụng (trong vòng 2 ngày kể từ khi nhận sản phẩm) 
                - Hàng hoá bị rách, in lỗi, bung chỉ, và các lỗi do vận chuyển hoặc do nhà sản xuất.
                1. Trường hợp được chấp nhận: 
                    - Hàng giao sai size khách đã đặt hàng 
                - Giao thiếu hàng 
                2. Trường hợp không đủ điều kiện áp dụng chính sách: 
                    - Quá 2 ngày kể từ khi Quý khách nhận hàng 
                - Gửi lại hàng không đúng mẫu mã, không phải sản phẩm của 20SILK
                - Không thích, không hợp, đặt nhầm mã, nhầm màu,... 
                III. MÔ TẢ SẢN PHẨM
                ⭐ Tên sản phẩm : Áo sơ mi nam-nữ tay ngắn chất kaki cao cấp kiểu dáng form rộng, unisex, dễ phối đồ mặc cực đẹp
                ⭐ Chất Liệu: kaki cao cấp
                ⭐Bảng size bên shop các bạn tham khảo ạ, áo form rộng rãi các bạn có thể tăng size hoặc lùi size theo sở thích, hãy nhớ ib shop tư vấn cho các bạn nhé!
                Size M: Dành cho người nặng từ  40kg - 55kg
                Size L : Dành cho người nặng từ  56kg - 64kg
                Size XL: Dành cho người nặng từ  65kg  - 70kg
                Size XXL: Dành cho người nặng từ  71kg  - 80kg
                👉 Bảng size mang tính chất tham khảo bạn có thể lấy size to hơn hoặc nhỏ theo yêu cầu của bạn!
                Lưu ý: Các bạn có thể nhắn tin cho shop để tư vấn size',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);

        // product_id: 12
        Product::create([
            'name' => 'Bộ Đồ Nam Cao Cấp Mặc Nhà Chất Tổ Ong , Bộ Thể Thao Chất Cotton Mềm Mịn Thêu N.Y Siêu Đẹp BO09',
            'description' => 'Bộ Đồ Nam Cao Cấp Mặc Nhà Chất Tổ Ong , Bộ Thể Thao Chất Cotton Mềm Mịn Thêu NY Siêu Đẹp BO09 - MINHSTORE 66
                ✔️ GIỚI THIỆU THƯƠNG HIỆU MINHSTORE
                Là 1 trong những shop thời trang nam được xứng danh “MẪU MÃ ĐẸP - CHẤT LƯỢNG TỐT- GIÁ TẬN XƯỞNG” nên Minhstore luôn chú trọng nghiên cứu phát triển mẫu mã cải tiến và đặc biệt tối ưu giá tốt nhất, giá tận xưởng đến tay khách hàng.
                ✔️ ĐẶC ĐIỂM NỔI BẬT BỘ THỂ THAO NAM TỔ ONG BO09
                - Mã sản phẩm: BO09
                - Bộ thể thao nam tổ ong Cotton được thiết kế theo đúng form chuẩn của nam giới Việt Nam
                - Sản phẩm Bộ thể thao nam chất Tổ ong mềm mịn chính là mẫu thiết kế mới nhất cho mùa hè này
                - Chất liệu: Tổ ong co dãn 4 chiểu cao cấp (thoáng mát, thấm hút mồ hôi)
                - Đem lại sự thoải mái tiện lợi nhất cho người mặc
                ✔️ HƯỚNG DẪN CHỌN SIZE BỘ THỂ THAO NAM TỔ ONG THÊU NY -  BO09
                - Size M (42-57kg)
                - Size L (57-63kg)
                - Size XL (63-73kg)
                - Size 2XL (73-85kg)
                - Size 3XL (85-95kg)
                Bảng size phù hợp 90% khách hàng. Nếu bạn không chắc chắn thì inbox shop tư vấn ạ
                Nếu bạn béo bụng hay muốn mặc rộng hơn chút thì nhớ tăng 1 size nha!
                ************************
                ✔️ CHẾ ĐỘ BẢO HÀNH                                                                                   
                - Tất cả các sản phẩm đều được Shop bảo hành 6 tháng                                                                                                
                - Giao hàng trên toàn quốc
                - Chính sách đổi trả hàng miễn phí khi sản phẩm kém chất lượng, không giống hình, nhầm size, số lượng mà quý khách đã đặt. 
                - Sản phẩm chỉ được đổi/ trả khi còn nguyên tem mác. Quý khách vui lòng chụp toàn bộ bao bì, sản phẩm để shop xác nhận, gửi lại shop chậm nhất trong 7 ngày.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 13
        Product::create([
            'name' => 'Quần jean nam,quần jean nam baggy xuông hottren phong cách trẻ trung năng động',
            'description' => 'Quần jean nam baggy cạp cao ống suông rộng, quần bò nam phom xuông chất bò mềm, dày dặn top xu hướng 2023
                Quần jean nam hottrend với vải jean chính phẩm được nhập tại quảng châu và sản xuất tại nhà máy dệt may Hà Nội cho chất lượng sản phẩm cao cấp.
                Quần bò nam mang theo giấc mơ xây dựng một thương hiệu thời trang với chất lượng cao cấp và MỨC GIÁ HỢP LÍ để bạn có thể tự do thể hiện phong cách riêng của mình 
                HÃY ỦNG HỘ GIẤC MƠ CỦA TỤI MÌNH NHÉ! 
                ️ TẠI SAO NÊN CHỌN MUA QUẦN JEAN NAM, JEAN BAGGY NAM XANH ĐEN ?
                - Quần bò nam CHẤT LƯỢNG: Chất vải jean CHÍNH PHẨM gồm 95% cotton ( thấm hút, vải mềm) và 5% spandex ( độ co dãn). Giặt hạn chế k phai mầu, bề mặt vải mịn bền .
                - GIÁ CẢ : Chúng tôi trực tiếp sản xuất với số lượng lớn. Nên chất lượng quần và giá thành rẻ cho các bạn.
                - HÃY INBOX CHO SHOP KHI SẢN PHẨM CÓ VẤN ĐỀ ( ĐỔI SIZE, SP LỖI...) ĐỂ HỖ TRỢ TRƯỚC KHI ĐÁNH GIÁ.
                NOTE : Hãy nhắn tin cho shop để được tư vấn size chuẩn nhất với bạn.
                QUẦN JEAN NAM BAGGY - DÁNG ỐNG SUÔNG, RỘNG NAM CAO CẤP:
                - Có phải bạn đang muốn tìm cho mình một chiếc quần jean nam baggy XANH, ĐEN cao cấp mang style hàn quốc? 
                Bởi vì đây là một chiếc quần jean mà cực kỳ dễ phối đồ từ áo thun, hoodie, áo khoác..cho đến các loại sneakers, boots.
                ️ Thông Tin Sản Phẩm:
                - Kiểu Dáng: quần bò nam jean baggy dành cho nam,nữ
                - Mầu Sắc: Xanh Sky, Đen full, Xanh nhạt
                - Chất liệu: jean cao cấp, ko phai mầu
                - Số lượng : hàng đủ size , xuất khẩu
                - gồm có đủ size: từ size 26 ( 42kg) -> size 40(120kg)',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);

        // product_id: 14
        Product::create([
            'name' => 'Áo khoác Blazer Nam Form rộng dài tay unisex basic chất Flannel Hàn cao cấp ,hợp mọi thời đại, phong cách Hàn Quốc, Vest',
            'description' => 'MÔ TẢ SẢN PHẨM
                ✪ Chất Liệu Vải :  Flannel xuất Hàn cao cấp 100%, co giãn 4 chiều, vải mềm, mịn, thoáng mát, không xù lông.
                ✪ Kĩ thuật may: Đường may chuẩn chỉnh, tỉ mỉ, chắc chắn
                ✪ Kiểu Dáng :Form Rộng Thoải Mái
                ✪ Full size nam nữ : 40 - 85 kg

                I. SHOP CAM KẾT
                - Sản phẩm Áo Blazer Nam Form rộng cao cấp giống mô tả 100%
                - Hình ảnh sản phẩm là ảnh thật, các hình hoàn toàn do shop tự thiết kế.
                - Kiểm tra  cẩn thận trước khi gói hàng giao cho Quý Khách
                - Hàng có sẵn, giao hàng ngay khi nhận được đơn 
                - Hoàn tiền nếu sản phẩm không giống với mô tả
                - Chấp nhận đổi hàng khi size không vừa trong 3 ngày.

                II. HỖ TRỢ ĐỔI TRẢ THEO QUY ĐỊNH CỦA SHOPEE
                - Điều kiện áp dụng (trong vòng 2 ngày kể từ khi nhận sản phẩm) 
                - Hàng hoá bị rách, in lỗi, bung chỉ, và các lỗi do vận chuyển hoặc do nhà sản xuất.
                1. Trường hợp được chấp nhận: 
                - Hàng giao sai size khách đã đặt hàng 
                - Giao thiếu hàng 
                2. Trường hợp không đủ điều kiện áp dụng chính sách: 
                - Quá 2 ngày kể từ khi Quý khách nhận hàng 
                - Gửi lại hàng không đúng mẫu mã, không phải sản phẩm của shop
                - Không thích, không hợp, đặt nhầm mã, nhầm màu,... ',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 15
        Product::create([
            'name' => 'Áo Sweater cổ zip PN STORE vải nỉ 2 da có khóa cổ form rộng unisex',
            'description' => 'Áo Sweater cổ lọ PN STORE với chất liệu nỉ 2 da cao cấp là sự lựa chọn hoàn hảo cho mọi người
                Màu: Đen, Tiêu Xanh Than
                Size: M, L, XL, 2XL
                Thiết kế Unisex: Áo form rộng dễ dàng mix đồ cho cả nam và nữ.
                Khóa cổ tiện lợi: Được thiết kế với khóa cổ, tạo điểm nhấn thời trang và tiện ích.
                Mùa sử dụng: Phù hợp để mặc vào mùa Đông, Thu và Xuân.
                Với chiều dài tay áo Dài tay đầy cá tính, bạn có thể thoải mái di chuyển mà không gặp bất kỳ khó khăn nào.
                Hướng dẫn giặt: Khô sạch để bảo quản áo luôn mới mẻ và bền đẹp theo thời gian.
                Dịp phối: Phù hợp cho các hoạt động hàng ngày hay các buổi đi chơị thông thường.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 16
        Product::create([
            'name' => 'Áo len nam cổ tròn lót lông cừu dày cao cấp Chenille dệt kim chui đầu',
            'description' => '💕 Chào mừng đến với Cửa hàng của chúng tôi 💕
                🔖 Kích thước và mô hình của sản phẩm được thể hiện trong hình. Vui lòng đọc kỹ.
                🔖 Do đo lường thủ công, lỗi có thể là 1-2 cm
                Lợi ích, xin vui lòng lưu ý. 📣📣📣
                ✨ Theo dõi cửa hàng của chúng tôi để nhận phiếu giảm giá cửa hàng. Vui lòng nhấp vào "Theo dõi" để thử. ✨
                📫 Nếu bạn có bất kỳ câu hỏi nào về việc mua sắm, xin vui lòng liên hệ với chúng tôi. Chúng tôi sẽ cung cấp cho bạn những câu trả lời thỏa đáng nhất.
                ✔ Chúng tôi có nhiều kinh nghiệm và sản phẩm chất lượng cao. Chúng tôi sẽ cung cấp cho bạn trải nghiệm mua sắm tốt nhất.
                ✔ Sản phẩm của chúng tôi là 100% mới.
                ✔ Chúng tôi theo đuổi chất lượng cao và giá cả thấp.
                ✔ Chúng tôi luôn có sản phẩm mới. Vui lòng tiếp tục theo dõi tin tức mới nhất trong cửa hàng của chúng tôi. Chúng tôi sẽ gửi cho bạn phiếu giảm giá và giảm giá.
                🛒 Nếu bạn thích sản phẩm của chúng tôi, vui lòng cho chúng vào giỏ hàng và mang đi.
                ⭐ Chúng tôi mong đợi đánh giá năm sao của bạn.
                ❗ Do thiết bị hiển thị và ánh sáng khác nhau, hình ảnh có thể không phản ánh màu sắc trung thực của tất cả các sản phẩm. Cảm ơn bạn cho sự hiểu biết của bạn.
                ❕ Nếu bạn có bất kỳ câu hỏi nào, xin vui lòng liên hệ với chúng tôi. Chúng tôi sẽ trả lời câu hỏi của bạn càng sớm càng tốt và cố gắng hết sức để giải quyết vấn đề của bạn.
                💞 Chúng tôi mong bạn chú ý và mua sắm. 💞',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 17
        Product::create([
            'name' => 'Áo sơ mi ngắn tay form rộng, thời trang hiện đại unisex chất liệu vải lụa mềm chống nhăn',
            'description' => 'Shop cam kết luôn mang lại chất lượng sản phẩm tốt nhất dành cho khách hàng với chăm ngon : “Trao đi giá trị, nhận lại yêu thương”
                ÁO SƠ MI NGẮN TAY FORM RỘNG, THỜI TRANG HIỆN ĐẠI UNISEX CHẤT LIỆU VẢI LỤA MỀM CHỐNG NHĂN
                -	Chất liệu: Lụa chéo Hàn Quốc.
                -	Công dụng: Chống nhăn, giãn nhẹ, êm ái, mềm mịn và mát da.
                -	Phong cách: Unisex, Form rộng, Sweetwear.
                -	Dành cho: Nam và Nữ.
                -	Xu xướng: Hiện đại 2024.
                -	Xuất xứ: Made in Việt Nam.
                ÁO SƠ MI NGẮN TAY FORM RỘNG, THỜI TRANG HIỆN ĐẠI UNISEX CHẤT LIỆU VẢI LỤA MỀM CHỐNG NHĂN
                -	Quần short -> Tạo nên phong cách vô cùng đơn giản nhưng không kém phần cuốn hút. Đặc biệt mang đến cảm giác thoải mái cho người mặc. Phù hợp để đi dạo phố và trà sữa cùng bạn bè.
                -	Quần jean, kaki, âu dài -> Tạo nên phong cách cá tính và năng động, chiếc quần rách sẽ làm trang phục có thêm điểm nhấn. Phù hợp để đi chơi xa, đi dạo phố, đi đám cưới, tiệc tùng sinh nhật.
                SHOP CAM KẾT
                - Uy tín 100%.
                - Hỗ trợ khách hàng nhiệt nhiệt tình.
                - Đặt chất lượng sản phẩm lên hàng đầu.
                - Nếu sản phẩm không đúng, không vừa hãy inbox riêng đến shop để được tư vấn hỗ trợ trả hàng và hoàn tiền nhé ! 
                Shop tự tin về Sản Phẩm chất lượng cũng như giá Rẻ vì đội ngũ may mặc có tay nghề cao. Có Xưởng sản xuất quy mô lớn nên giá thành thấp để phục vụ cho Khách Hàng.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 18
        Product::create([
            'name' => 'Áo Sweater Nam Phối Sơ Mi ZONEF OFFICIAL Phối Sơ Mi Kẻ Xanh Nhạt Liền Thân Chất Nỉ 2 Da',
            'description' => 'THÔNG TIN SẢN PHẨM
                Áo Sweater Nam Nữ ZONEF OFFICIAL Phối Sơ Mi Kẻ Xanh Nhạt Liền Thân Chất Nỉ 2 Da ANT
                - Chất liệu: vải nỉ 2 da mềm mại, bề mặt mềm mịn, không bai, không xù, không nhăn
                - Áo thiết kế độc đáo có cổ áo và tay áo phối sơ mi mang lại sự trẻ trung, lịch thiệp cho người mặc
                - Áo dễ phối đò cho cả nam và nữ
                SHOP CAM KẾT
                1. Hình ảnh sản phẩm là ảnh thật do shop tự chụp 
                2. Hàng chính hãng 100%, áo được kiểm tra kỹ, cẩn thận và tư vấn nhiệt tình
                3. Chính sách đổi trả lên đến 5 ngày
                4. Hàng có sẵn, giao hàng ngay khi nhận được đơn
                5. Hoàn tiền nếu sản phẩm không giống với mô tả
                QUY ĐỊNH BẢO HÀNH ĐỔI TRẢ
                1. Điều kiện áp dụng (trong vòng 5 ngày kể từ khi nhận sản phẩm)
                - Hàng hoá vẫn còn mới, chưa qua sử dụng
                - Hàng hoá bị lỗi hoặc hư hỏng do vận chuyển hoặc do nhà sản xuất
                ( Chương trình không áp dụng đối với các sản phẩm quà tặng)
                2. Trường hợp được chấp nhận:
                - Hàng không đúng size, kiểu dáng như quý khách đặt hàng
                - Không đủ số lượng, không đủ bộ như trong đơn hàng
                3. Trường hợp không đủ điều kiện áp dụng chính sách:
                - Quá 5 ngày kể từ khi Quý khách nhận hàng
                - Gửi lại hàng không đúng mẫu mã, không phải sản phẩm của Shop.
                - Không thích, không hợp, đặt nhầm mã, nhầm màu,...',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 19
        Product::create([
            'name' => 'Bộ vest nam lịch lãm, trẻ trung, sang trọng, Form ôm body, phong cách Hàn Quốc, Tặng phụ kiện vest',
            'description' => 'Chuyên sỉ và lẻ các mẫu vest blazer gile nam, bộ comle, quần tây chất liệu cao cấp
                Cập nhật liên tục theo các event nhiều voucher giảm giá, freeship mới
                THÔNG TIN SẢN PHẨM
                - Xuất xứ: Việt Nam
                - Màu sắc: Trắng/Đen/Xanh Than/Xanh Cô Ban/ Xanh Hòa Bình/Ghi Sáng/Xám Đá/ Be Sữa/ Đỏ Mận/ Nâu Tây/ Chì Tối
                - Size: S/M/L/XL/2XL/3XL/4XL
                ĐẶC ĐIỂM SẢN PHẨM
                - Chất liệu vải cao cấp có độ co giãn nhẹ, không nhăn, không xù, giặt không phai màu.
                - Vest may 3 lớp dày dặn. trong cùng có lớp lọt lụa mặc êm ái và thoải mái.
                - Có đệm múi cầu vai giúp tôn form tôn dánh lên rất nhiều.
                - Có sẻ tà đằng sau. giúp anh em ngồi xuống không bị bó.
                - Chất vải thấm hút mồ hôi tốt, thích hợp mặc vào mùa nóng, hoặc các công việc ngoài trời, dự tiệc, sự kiện, hội họp...
                - Hàng may tại xưởng và phân phối đến tận tay khách hàng không qua trung gian.
                HƯỚNG DẪN CHỌN SIZE
                - Size S: Cân nặng 40-50kg chiều cao 140 - 160cm
                - Size M: Cân nặng từ 51-59kg chiều cao từ 160 - 165cm
                - Size L: Cân nặng từ 60-64kg chiều cao từ 165 - 170cm
                - Size XL: Cân nặng từ 65-72kg chiều cao 170 - 175cm
                - Size 2XL: Cân nặng từ 72-77kg chiều cao 170 - 180cm
                - Size 3XL: Cân nặng từ 78-85kg chiều cao 175 - 185cm
                - Size 4XL: Cân nặng từ 85-95kg chiều cao 180 – 195cm
                (Nhắn tin trực tiếp với shop để được tư vấn chọn size phù hợp chuẩn nhất)
                HƯỚNG DẪN SỬ DỤNG VÀ BẢO QUẢN
                - Chỉ Giặt tay không được giặt máy
                - 1 Năm nên giặt khô ở tiệm 1-2 lần để bảo quản tốt nhất
                - Không được tẩy
                - Ủi với nhiệt độ không quá 110°C
                - Không được sấy khô.
                ✋ CAM KẾT CỦA SHOP:
                👉 Áo vest nam được may tại xưởng của shop, không qua trung gian 
                👉 Cam kết chất lượng và mẫu mã giống hình ảnh 
                👉 Áo vest nam được may theo số đo chuẩn form từng người 
                👉 Áo vest cam kết 100% như hình 
                👉 Hoàn tiền 100%, nếu như không đúng mẫu mã hoặc chất lượng.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 20
        Product::create([
            'name' => 'Áo sơ mi nam nữ tay ngắn chất kaki cao cấp kiểu dáng form rộng, unisex, dễ phối đồ mặc cực đẹp',
            'description' => 'LƯU Ý : KHÁCH ĐẶT HÀNG CHÚ Ý KỸ BẢNG SIZE NHÉ, NẾU CẦN TƯ VẤN SIZE BẠN NHẮN TIN CHO SHOP CHIỀU CAO CÂN NẶNG SHOP TƯ VẤN SIZE PHÙ HỢP NHẤT NHÉ .
                Áo khoác dù nam hàng VNXK
                Chất liệu vải dù nhám dày dặn 2 lớp.Trong lớp lót giúp áo thoáng nhiệt.
                Thiết kế áo  form rộng mặc thoáng mát, phù hợp khoác chống nắng hằng ngày và thời tiết se lạnh. thiết kế kiểu basic với logo nhỏ tạo điểm nhấn
                
                -Áo gồm 2 túi ngoài "CÓ KHÓA KÉO" an toàn và 1 túi trong
                
                Bảng size áo khoác:
                    size S : Dưới 42kg , dưới 1m55
                    size M : Dưới 50kg , dưới 1m62
                    size L : Dưới 58kg , dưới 1m68
                    size XL : Dưới 68kg , dưới 1m73
                    size 2XL: Dưới 80kg , dưới 1m79
                    size 3XL : Dưới 90kg 
                    size 4XL : Dưới 110kg

                ( Bảng size tương đối , nếu cận size các bạn lấy tăng lên 1 size nhé)',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 21
        Product::create([
            'name' => 'Áo thun nam áo phông chất mềm mịn thấm hút mồ hôi phối 2 màu trẻ trung năng động N55',
            'description' => 'Áo thun Polo là một trong những lựa chọn hàng đầu của cánh mày râu mỗi khi đi mua sắm. Chiếc áo nam đẹp và cơ bản của cánh mày râu khá đa dạng từ những món đồ cá nhân như đồ lót, tất,..đến áo thun, quần short. Áo thun polo cũng là một trong những món đồ cơ bản không thể thiếu trong tủ đồ của cánh mày râu. Thiết kế năng động, đậm nét thể thao, vừa thanh lịch mà vẫn thoải mái là những ưu điểm hàng đầu giúp áo thun polo dành được nhiều sự ưa chuộng bởi nhiều lứa tuổi, nhiều tầng lớp. Vẫn được giữ nguyên những đường nét cổ điển với dáng cổ áo, nay được bổ sung thêm hàng nút gài ở cổ chắc hẳn bạn sẽ không thể bỏ qua áo thun polo trong tủ đồ của mình.
                Thông tin sản phẩm
                - Chất liệu: cotton, không xù lông, phai màu.
                - Co giãn tốt, mặc cực thoải mái, thấm hút mồ hôi tốt.
                - Chất vải đẹp, đứng form áo.
                - Đường may cực tỉ mỉ cực đẹp.
                - Có thể mặc đi làm, đi chơi, dễ phối đồ, không kén người mặc.
                - Kiểu dáng: Thiết kế theo form rộng vừa,đơn giản , dễ mặc ..Tôn lên được sự trẻ trung năng động cho các bạn nam, kèm vào đó là sự hoạt động thoải mái khi mặc sản phẩm.
                Chính sách đổi trả
                ● Cam kết 100% đổi size nếu sản phẩm khách đặt không vừa ( hỗ trợ đổi size trong vòng 3 ngày )
                ● Sản phẩm còn nguyên vẹn, nguyên tem mác, chưa giặt, chưa qua sử dụng và sửa chữa.
                ● Nếu có bất kì khiếu nại cần Shop hỗ trợ về sản phẩm, khi mở sảm phẩm khách hàng vui lòng quay lại video quá trình mở sản phẩm để được đảm bảo 100% đổi lại sản phẩm mới nếu Shop giao hàng bị lỗi.
                ● Quý khách nhận được sản phẩm vui lòng đánh giá giúp Shop để được hưởng thêm nhiều ưu đãi hơn nhé ạ ^^

                𝐇𝐮̛𝐨̛́𝐧𝐠 𝐝𝐚̂̃𝐧 𝐐𝐮𝐲́ 𝐤𝐡𝐚́𝐜𝐡 𝐡𝐚̀𝐧𝐠 𝐜𝐡𝐨̣𝐧 𝐬𝐢𝐳𝐞
                𝐌 (𝟒𝟓-𝟓𝟓𝐤𝐠 ≤𝟏𝐦𝟕 )
                𝐋 (𝟓𝟓-𝟔𝟓𝐤𝐠 ≥𝟏𝐦𝟕 )
                𝐗𝐋 (𝟔𝟓-𝟕𝟑𝐤𝐠 ≥𝟏𝐦𝟕 )
                𝟐𝐗𝐋 (𝟕𝟑-𝟖𝟑𝐤𝐠 ≥𝟏𝐦𝟕 )
                ⚠️ 𝐍𝐄̂́𝐔 𝐐𝐔𝐘́ 𝐊𝐇𝐀́𝐂𝐇 𝐃𝐔̛𝐎̛́𝐈 𝟏𝐦𝟕 𝐓𝐇𝐈̀ 𝐓𝐀̆𝐍𝐆 𝟏 𝐒𝐈𝐙𝐄 𝐆𝐈𝐔́𝐏 𝐒𝐇𝐎𝐏 𝐀̣',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 22
        Product::create([
            'name' => 'Áo Phông Đức Nam A Đi Đát Phối Sọc Thân Mix Logo Đức Thêu Siêu Nét - Áo Thun Đức Nam Nữ Chất Vải Cotton Tàu Bản Hoàn',
            'description' => 'Áo Phông Đức Nam A Đi Đát Phối Sọc Thân Mix Logo Đức Thêu Siêu Nét - Áo Thun Đức Nam Nữ Chất Vải Cotton Tàu Bản Hoàn

                ĐIỂM NỔI BẬT CỦA SẢN PHẨM:		
                - Chất Cotton mịn thoáng mát co dãn 2 chiều, thoáng mát, hút ẩm tốt, mềm mịn, dày dặn, thoải mái khi vận động.		
                - Hàng may kỹ chắc chắn - Thiết kế đơn giãn thanh lịch trẻ đẹp phù hợp mọi lứa tuổi		
                - Dễ dàng kết hợp với quần ngắn, quần dài... cho bạn trông thật bảnh bao khi dạo phố, đi chơi, học tập, làm việc hay mặc thường ngày ở nhà.		
                        
                SHOP CAM KẾT		
                ✔ Mang đến cho khách hàng những sản phẩm với chất lượng tốt nhất trong tầm giá.		
                ✔ Chính sách bảo  hành tốt nhất ( Hỗ trợ đổi size, sản phẩm lỗi)		
                ✔ Shop Cam Kết Chất Lượng và Mẫu Mã Giống hình ảnh 100%		
                ✔ Mẫu Mã Đa Dạng ,Cập Nhật Liên Tục, Chất liệu hàng đầu, giá cả hợp lý.		
                ✔ Nhận hàng không ưng hoặc lỗi khách hàng có thể hoàn hàng và được hoàn tiền 100%		
                        
                HƯỚNG DẪN CHỌN SIZE :		
                        
                ✔ Size S:  Nặng 43-52kg ~ Cao 1m55-1m65		
                ✔ Size M: Nặng 52- 58kg ~ Cao 1m60-1m68		
                ✔ Size L: Nặng 59 - 69kg ~ Cao 1m65-1m72		
                ✔ Size XL: Nặng 69-79kg ~ Cao 1m68-1m80		
                        
                (Bảng size chỉ mang tính chất tham khảo ,quý khách có thể tùy chọn lên xuống 1 size tùy theo sở thích ăn mặc của bạn)',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 23
        Product::create([
            'name' => 'Đồ Bộ Nam SPACE siêu đẹp phong cách thời trang',
            'description' => '= THÔNG TIN CHI TIẾT SẢN PHẨM : Đồ Bộ Nam SPACE siêu đẹp phong cách thời trang
                ⭐ 4 SIZE S, M ,L, XL ( 40-78KG )
                + S [45-52KG] DƯỚI 1M60
                + M [52-60KG] DƯỚI 1M65
                + L [60-65KG] DƯỚI 1M70
                + XL [65-78KG] DƯỚI 1M75
                ⭐ Màu Sắc : TRẮNG, ĐEN, XÁM, XANH
                ⭐ Kích Thước : 

                - KÍCH THƯỚC ÁO: DÀI 65CM - RỘNG 50CM - TAY 20CM
                - KÍCH THƯỚC QUẦN: DÀI 50CM - ỐNG 28CM - ĐŨNG 34CM
                + MỖI KÍCH THƯỚC SIZE CHÊNH NHAU 1,2 CM

                ⭐ CHẤT LIỆU: THUN MÈ thấm hút mồ hôi tốt, phù hợp trong mọi hoạt động, thoải mái cả ngày.
                Kiểu dáng thời trang, đường chỉ may tỉ mỉ, tinh tế.
                - Sản phẩm được thiết kế và sản xuất tại Việt Nam, được chăm chút và giám sát chặt chẽ về chất lượng. Cho ra những sản phẩm cao cấp và chất lượng tốt nhất.
                - Màu sắc sản phẩm bám tốt, không bị phai mau sau nhiều lần giặt.
                thoitrangnamdt sẽ kiểm tra cẩn thận trước khi giao hàng, nhưng đôi khi nó sẽ bị bỏ sót. Ví dụ: bạn khám phá ra các lỗi, thiếu sót và các vấn đề về chất lượng sau khi nhận được hàng. Vui lòng liên hệ với chúng tôi càng sớm càng tốt. Chúng tôi chân thành và có trách nhiệm ~~

                *  Nếu bạn hài lòng với sản phẩm và dịch vụ của chúng tôi, xin vui lòng cho chúng tôi 5 sao ⭐⭐⭐⭐⭐Cảm ơn các bạn đã ủng hộ và chúc các bạn sống vui vẻ ~~~',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 24
        Product::create([
            'name' => 'Quần dài thể thao nam ống suông nhẹ chất poly co giãn',
            'description' => 'Quần dài thể thao nam ống suông nhẹ chất poly lưng thun co giãn
                - Chất liệu thun Poly co giãn 4 chiều tạo cảm giác thoải mái khi mặc
                - Đặc biệt không nhăn không nhàu
                - Kiểu dáng trơn đơn giản dễ mặc
                - Quần có 3 túi  2 túi sườn 1 túi sau
                -Mẫu quần gió có 3 túi khoá
                - 4 màu Đen,Than,Xám,Ghi
                -------------------------------------------------------------------------------------------
                Bảng size:M-3XL 48-88kg
                M48-59kg
                L 60-67kg
                XL 68-74kg
                2XL 75-81kg
                3XL 82-88kg
                ----------------------------------------------------------------------------------------------
                Khách Hàng được kiểm tra quần trước khi thanh toán
                Hàng xưởng việt nam sản xuất
                - Cam kết mang đến cho khách hàng những sản phẩm với chất lượng tốt nhất trong tầm giá
                - Cam kết chính sách bảo hành tốt nhất (Hỗ trợ đổi size, Hỗ trợ đổi Sản phẩm lỗi) theo quy định của shopee
                - Nếu quá thời hạn 3 ngày kể từ ngày nhận đơn hàng, chế độ bảo hành sẽ hết hiệu lực',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 25
        Product::create([
            'name' => 'Quần Jeans nam TORANO dáng basic Slim Co Giãn Tốt, Không Bai Xù, Bền Màu, Phom Trẻ Trung EABJ012',
            'description' => '📌THÔNG TIN SẢN PHẨM:
                📍Tên sản phẩm: Quần Jeans nam TORANO dáng basic Slim Co Giãn Tốt, Không Bai Xù, Bền Màu, Phom Trẻ Trung BJ012
                📍 Chất liệu: Jeans dày dặn, siêu bền, không phai màu 
                📍Màu sắc: Xám nhạt, Xanh da trời nhạt, Đen nhạt, Xám, Darknavy, Xanh da trời đậm, Xanh da trời, Đen
                📍Phom dáng: basic hơi ôm
                📍Size: 29-30-31-32-33
                📍Xuất xứ: Việt Nam
                📍Tính năng nổi bật:
                 + Thấm hút tốt
                + Co giãn, mềm mại, đàn hồi tốt
                + Bền màu, không bai xù sau nhiều lần giặt
                + Phom dáng trẻ trung, năng động
                + Túi trước sâu rộng, thêm hai túi hậu thời trang, tiện lợi để được nhiều đồ như ví, điện thoại,...
                + Đường may nổi chắc chắn, tinh tế
                📍 Hướng dẫn bảo quản quần jean:
                + Sau khi mua về bạn nên ngâm chiếc quần jean của mình với nước lạnh pha muối đậm, giấm ăn hoặc phèn chua ít nhất 12 tiếng đồng hồ. Sau đó, đem xả lại bằng nước sạch. Bạn chú ý là không sử dụng xà phòng để giặt quần trong lần đầu tiên.
                + Nên phơi quần jean trong bóng râm
                + Giặt bằng nước lạnh
                + Không ngâm quần jean quá lâu, chỉ ngâm 3-5 phút
                + Nên giặt tay để quần bền màu lâu hơn.
                📍Hướng dẫn sử dụng:
                + Giặt máy với chu kỳ trung bình và vòng quay ngắn
                + Giặt với nhiệt độ tối đa 30 độ C
                + Sấy nhẹ ở nhiệt độ thường
                + Là ủi không quá 110 độ C
                + Phơi bằng móc dưới bóng râm
                + Không sử dụng chất tẩy
                📍 Lưu ý nhỏ:
                + Không giặt chung với đồ dễ xước
                + Cẩn thận vướng mắc khi phơi
                ----------------------
                📌QUY ĐỊNH LÊN ĐƠN TRÊN SHOPEE Không nhận lên đơn hàng trên ghi chú. ( vd khách đặt hàng size M, nhưng ghi chú shop lấy size L, trường hợp này shop sẽ gửi size M theo đúng size khách đặt ban đầu.)
                📌CHÍNH SÁCH ĐỔI- TRẢ:
                • Torano hỗ trợ đổi hàng trong trường hợp: sp mặc không vừa, khách không ưng sp đã đặt, sp có lỗi của nhà sản xuất.
                • Sản phẩm đổi phải đạt điều kiện: còn nguyên tem mác, chưa qua sử dụng, không có vết bẩn, rách…
                • Thời gian đổi trả: trong vòng 7 NGÀY kể từ ngày khách nhận hàng.
                • LƯU Ý: - Quý khách vui lòng liên hệ qua Shopee nếu cần hỗ trợ đổi hàng trước khi xác nhận ĐÃ NHẬN ĐƯỢC HÀNG
                - Nếu khách hàng bấm “ĐÃ NHẬN HÀNG” khách hàng THANH TOÁN 2 CHIỀU PHÍ SHIP khi đổi hàng.
                - Nếu có khiếu nại cần hỗ trợ, quý khách CẦN CÓ VIDEO QUAY LẠI QUÁ TRÌNH MỞ HÀNG để đảm bảo vấn đề sẽ được giải quyết .
                - Khách muốn đổi hàng vui lòng liên hệ qua hộp thư trên Shopee để được hướng dẫn.
                - Khách được ĐỔI DUY NHẤT 1 LẦN với 1 đơn hàng.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 26
        Product::create([
            'name' => 'HIP Áo thun ngắn tay local brand fashion áo phông nam nữ unisex bigsize vintage 230g cotton',
            'description' => 'HIPHOPPUNKS CAM KẾT:
                Chất liệu vải Cotton 100% co dãn 2 chiều, Định lượng cao 230gsm, 
                Vải chính phẩm đã qua xử lý co rút, và lông thừa
                chất vải mềm mịn dày nhưng cực kì mát và không xù
                Hoàn tiền nếu sản phẩm không giống với mô tả
                Nam và Nữ đều mặc được, form áo rộng chuẩn TAY LỠ UNISEX cực đẹp
                ————————————————————
                Mẹo nhỏ bảo quản Cotton tốt:
                Giặt ở nhiệt độ bình thường, với đồ có màu tương tự
                Không được dùng hóa chất tẩy
                Hạn chế sử dụng máy sấy và ủi ở nhiệt độ thích hợp
                Lộn mặt trái khi phơi tránh bị phai màu
                Áo thun unisex, áo phông nam nữ tay lỡ form rộng -',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 27
        Product::create([
            'name' => '( Ống suông ) Quần dài nam ống suông thun Poly phong cácH thể thao trơn có khóa túi form rộng có big size',
            'description' => 'Chất liệu vải mềm mịn, co giãn thoải mái, độ dày vừa phải, thấm hút mồ hôi tốt, thoáng mát.
                Quần thể thao màu trơn, kiểu dáng đơn giản.
                Quần dài nam thiết kế ống suông.
                Lưng thun co giãn thoải mái, có dây rút.
                Đường may kỹ chắt chắn.
                Quần dài dễ dàng phối đồ với các loại trang phục và phụ kiện khác.
                Quần thun nam có thể mặc đi làm, đi chơi, đi học,... và nhiều sự kiện khác nữa.
                Quần dài nam thể thao thiết kế đầy trẻ trung, năng động, tiện lợi, có thể mặc từ nhà ra phố với rất nhiều style khác nhau.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 28
        Product::create([
            'name' => 'Áo Sơ Mi Nam Tay Ngắn Nhung Tăm Cao Cấp Kiểu Dáng Form Rộng, Unisex, Basic Mặc Cực Đẹp Abandon A4',
            'description' => 'I. SHOP CAM KẾT
                - Sản phẩm Áo sơ mi nhung tăm tay lỡ form rộng giống mô tả 100%
                - Hình ảnh sản phẩm là ảnh thật, các hình hoàn toàn do shop tự thiết kế.
                - Kiểm tra  cẩn thận trước khi gói hàng giao cho Quý Khách
                - Hàng có sẵn, giao hàng ngay khi nhận được đơn 
                - Hoàn tiền nếu sản phẩm không giống với mô tả
                - Chấp nhận đổi hàng khi size không vừa trong 3 ngày.
                II. HỖ TRỢ ĐỔI TRẢ THEO QUY ĐỊNH CỦA SHOPEE
                - Hàng hoá bị rách, in lỗi, bung chỉ, và các lỗi do vận chuyển hoặc do nhà sản xuất.
                1. Trường hợp được chấp nhận: 
                    - Hàng giao sai size khách đã đặt hàng 
                - Giao thiếu hàng 
                2. Trường hợp không đủ điều kiện áp dụng chính sách: 
                    - Gửi lại hàng không đúng mẫu mã, không phải sản phẩm
                - Không thích, không hợp, đặt nhầm mã, nhầm màu,... 
                III. MÔ TẢ SẢN PHẨM
                ⭐ Tên sản phẩm : Áo sơ mi nhung tăm tay lỡ nam nữ unisex basic cao cấp
                ⭐ Chất Liệu: nhung tăm cao cấp ',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 29
        Product::create([
            'name' => 'Quần Jean Nam Ống Suông Wash Xanh Retro P&H JEAN, Quần Jean Nam Baggy Loang Chất Liệu Cao Cấp',
            'description' => 'P&H JEAN – Chúng tôi là đơn vị chuyên cung cấp các sản phẩm quần jean nam hottrend cho giới trẻ; Chuyên cung cấp các mẫu quần jean nam, quần jean nam baggy, ... với chất lượng tốt và giá cả vô cùng hợp lý. 
                --- 
                Thông tin sản phẩm: 
                - Chất liệu quần: 97% cotton, 3% spandex. 
                - Form dáng: Quần jean nam dài, ống rộng, dáng quần suông. 
                - Đặc điểm quần: Khóa cúc bụng; Khóa kéo; Có 4 túi trước và sau; Chất jean mềm, quần có wash màu.
                - Màu sắc: 3 Màu Wash Xanh Retro, Wash Đen khói và Wash Xanh Sky
                ---
                Đặc điểm nổi bật: 
                - Quần jean nam ống suông được làm chất liệu jean mềm cao cấp, chất jean co giãn nhẹ và thấm hút mồ hôi giúp người dùng thực sự thoải mái trong quá trình sử dụng.
                - Quần jean nam P&H JEAN được thiết kế tiện lợi để đồ như ví, smartphone, ... 
                - Là mẫu quần jean nam ống suông hottrend được ưa chuộng trên thị trường, form dáng chuẩn dễ dàng phối đồ trong khi đi làm, đi chơi, ... 
                - Bên cạnh đó, mẫu quần jean baggy nam của P&H JEAN có màu sắc chuẩn, nhiều mẫu mã giúp người dùng dễ dàng lựa chọn 
                --- 
                Hướng dẫn lựa chọn size: Sản phẩm có đủ size từ 27-36 phù hợp cho mọi dáng người; Chi tiết như sau: 
                Size 27: Từ 44 - 50kg; Cao Dưới 1m70 
                Size 28: Từ 50 - 54kg; Cao Dưới 1m75 
                Size 29: Từ 54 - 58kg; Cao Dưới 1m80 
                Size 30: Từ 58 - 63kg; Cao Dưới 1m80 
                Size 31: Từ 63 - 68kg; Cao Dưới 1m85 
                Size 32: Từ 68 - 73kg; Cao Dưới 1m85 
                Size 33: Từ 73 - 75kg; Cao Dưới 1m85 
                Size 34: Từ 75 - 80kg; Cao Dưới 1m85 
                Size 35: Từ 80 - 85kg; Cao Dưới 1m85 
                Size 36: Từ 85 - 90kg; Cao Dưới 1m85 
                --- 
                Lưu ý trong quá trình sử dụng: 
                + Sau khi mua về bạn nên ngâm chiếc quần jean của mình với nước lạnh pha muối đậm, giấm ăn hoặc phèn chua ít nhất 12 tiếng đồng hồ. Sau đó, đem xả lại bằng nước sạch. Bạn chú ý là không sử dụng xà phòng để giặt quần trong lần đầu tiên.
                + Nên phơi quần jean trong bóng râm
                + Giặt bằng nước lạnh
                + Không ngâm quần jean quá lâu, chỉ ngâm 3-5 phút
                + Nên giặt tay để quần bền màu lâu hơn
                Cam kết của shop về sản phẩm: 
                -  Về sản phẩm: Shop cam kết cả về chất liệu và hình dáng giống ảnh
                -  Về giá cả: Shop sản xuất với số lượng nhiều và trực tiếp không qua trung gian nên sẽ rẻ nhất
                -  Về dịch vụ: tư vấn nhiệt tình, chu đáo, luôn lắng nghe khách hàng để phục vụ tốt, hỗ trợ tư vấn và giải đáp thắc mắc cho quý khách 24/7.
                -  Về thời gian chuẩn bị hàng: nhanh, đúng tiến độ, không để quý khách chờ đợi
                ---
                Quy định đổi trả của shop: Sản phẩm được áp dụng đổi trả theo quy định của shopee và đáp ứng các điều kiện sau: 
                - Phản hồi và đổi trả không quá 3 ngày kể từ ngày nhận được sản phẩm. 
                - Sản phẩm chưa qua sử dụng, vẫn còn đầy đủ tem mác. ',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 30
        Product::create([
            'name' => 'Áo Khoác Bomber Ralp Laurent Thêu Logo Basic - Áo Bomber Nam Nữ, Vải Nỉ Chân Cua Dày Mịn THE.LAZ',
            'description' => 'THÔNG TIN SẢN PHẨM:
                ✔️ Tên sản phẩm: Áo phông cổ tròn nam nữ Unisex cotton
                ✔️ Xuất xứ: Việt Nam
                ✔️ Chất liệu: Vải Cotton Premium 100% không nhăn không xù cao cấp siêu dày dặn, mềm mại, co dãn đàn hồi 4 chiều và thấm hút mồ hôi cực tốt
                ✔️ Kích cỡ: S/M/L/XL (45- 75kg)
                ✔️ Màu sắc: Đen, trắng
                ✔️ Hoạ tiết: In chữ hình decal nhiệt chống bể vỡ, bong tróc, độ sắc nét rõ ràng
                ✔️ Phối đồ: Dễ phối với mọi loại quần jean, short, âu và tạo được điểm nhấn nổi bật, cá tính hơn hẳn mà không hề bị “rườm rà” hay “làm quá”
                HƯỚNG DẪN CHỌN SIZE ÁO PHÔNG:
                ✔ Size S: Nặng 45-52kg ~ Cao 1m55-1m65
                ✔ Size M: Nặng 52-58kg ~ Cao 1m60-1m68
                ✔ Size L: Nặng 58-67kg ~ Cao 1m65-1m72
                ✔ Size XL: Nặng 67-75kg ~ Cao 1m68-1m80
                📌 Thông số trên chỉ trang tính chất tham khảo. B muốn mặc form vừa vặn, thoải mái hay ôm người, hãy lên xuống size tuỳ theo sở thích ăn mặc của bạn
                NGỎ Ý: Bạn đang “bất lực” trong công cuộc tìm rước những món hàng xịn xò về tủ đồ vì Shopee tràn lan quá nhiều sp giá rẻ thiết kế tương tự nhưng chất lượng thì … thêm ba chấm:)) Vậy thì ngay tại đây, hãy để shop được phép lấy đi sự “ bất lực” đó và trả lại cho b một chiếc “Wow” cùng nụ cười toả nắng trên môi với trải nghiệm một chiếc áo phông theo đúng nghĩa của tiêu chí NGON- BỔ- RẺ
                CHÍNH SÁCH BÁN HÀNG:
                    ✔️ PB cam kết sản phẩm giống mô tả 100%. Hình ảnh/video sản phẩm được Shop chụp bằng cam thường chân thật nhất
                ✔️ Sản phẩm được kiểm tra kĩ lưỡng, cẩn thận và tư vấn nhiệt tình trước khi gói hàng giao cho quý khách
                ✔️ Hàng luôn sẵn, giao hàng ngay khi nhận được đơn
                ✔️ Hoàn tiền 100% nếu sản phẩm khác hình, mô tả
                ✔️ Hỗ trợ nhận đổi size nếu khách không vừa
                ✔️ Giao hàng toàn quốc, nhận hàng thanh toán tại nhà
                ✔️ Đổi trả miễn phí nếu shop gửi sai hàng hoặc hàng lỗi do nhà sản xuất',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 1,
        ]);
        // product_id: 31
        Product::create([
            'name' => 'Bộ Quần Áo Polo Cho Bé Trai Chất Vải Poly Cao Cấp Phong Cách Tay Ngắn + Quần Short Mùa Hè,Sét Đồ Bé Trai Đủ Size 8-36Kg',
            'description' => 'Bộ Quần Áo Polo Cho Bé Trai Chất Vải Poly Cao Cấp Phong Cách Tay Ngắn + Quần Short Mùa Hè,Sét Đồ Bé Trai Đủ Size 8-36Kg
                SHOP CHÚNG TÔI CAM KẾT :
                 - Sản phẩm giống 100% hình ảnh quảng cáo
                 - Chế độ đổi mới 3 ngày đầu tiên nếu sản phẩm có lỗi nhà sản xuất 
                THÔNG TIN SẢN PHẨM :
                Bộ quần áo hè thể thao bé trai 8-36kg, bộ đồ sát nách bé trai 5-15 tuổi , chất mềm mát, hàng may kĩ
                Sản xuất tại Việt Nam
                ☘️  Thấm hút mồ hôi, thoáng mát.
                ☘️ Sản phẩm phù hợp cho các tất cả các bé và cả người lớn
                ☘️ Hàng chuẩn form,từng đường viền may được thực hiện tỉ mỉ và tinh tế vừa đẹp mắt vừa đảm bảo độ bền hoàn hảo với thời gian. 
                ☘️ Giao hàng nhanh chóng trên toàn quốc. Đội ngũ nhân viên trẻ tư vấn nhiệt tính, nhanh chóng, giá cực kì yêu thương chỉ 
                ☘️Hướng dẫn mua hàng: Bạn chọn màu sắc, kích cỡ và số lượng rồi cho vào giỏ hàng. Sau khi bạn chọn đủ thì vào giỏ hàng để tiến hành mua hàng. Bạn có thể điều chỉnh số lượng trong giỏ hàng trước khi quyết định mua',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 32
        Product::create([
            'name' => 'Đồ bộ ngắn tay quần áo thun cotton mịn mặc nhà mùa hè cho bé trai và bé gái Unifriend Hàn Quốc U2024-4',
            'description' => 'BẢO HÀNH ĐỔI TRẢ 7 NGÀY THEO CHÍNH SÁCH CỦA SHOPEE
                - Khi mẫu lỗi do nhà sản xuất
                - Khi giao sai size/ Sai mẫu khách đã đặt hàng
                - Khi giao thiếu hàng
                - Hỗ Trợ đổi trả nếu sản phẩm không giống hình
                1. Thông tin sản phẩm
                Tên sản phẩm: Đồ bộ ngắn cotton mịn bé trai U2024-4 - Unifriend Hàn Quốc
                Loại sản phẩm: Bộ đồ ngắn cho bé trai và bé gái
                Size: 90-150
                Chất liệu: 100% Cotton Organic
                Xuất xứ vải: Hàn Quốc
                Nước sản xuất: Hàn quốc / Indonesia / Việt Nam
                2. Thông tin về thương hiệu
                UNIFRIEND là một trong hai thương hiệu thời trang trẻ em nổi tiếng của Công ty Gyeongwon FNV Co., Ltd. có trụ sở tại Seoul, Hàn Quốc. Với sứ mệnh tạo ra những sản phẩm thời trang "Organic Cotton" chất lượng và an toàn cho trẻ em tại Hàn Quốc, vào năm 2004, công ty đã chính thức được thành lập. Đến nay, sau hơn 17 năm, UNIFRIEND không chỉ nổi tiếng ở Hàn Quốc với hệ thống hơn 100 cửa hàng offline mà tại các quốc gia như Thái Lan, Malaysia, Indonesia, Nhật Bản, Trung Quốc, Mỹ,...
                       Chất liệu vải 100% Organic Cotton, không dùng chất huỳnh quang. Toàn bộ quy trình sản xuất như kéo sợi, dệt, nhuộm, in ấn,... đều được thực hiện tại Hàn Quốc và đã được tổ chức ECOCERT (Pháp) xác minh, kiểm tra và chứng nhận đạt tiêu chuẩn thành phần hữu cơ OCS 100.
                       Để nâng cao chất lượng sản xuất và tối ưu giá thành sản phẩm, vào tháng 5.2017, công ty đã thành lập nhà máy, chuyển giao công nghệ và thực hiện công đoạn may tại Việt Nam và Indonesia (những quốc gia hàng đầu về ngành dệt may). Vải thành phẩm sau khi hoàn thành tại Hàn Quốc sẽ được xuất sang Việt Nam và Indonesia để may, đóng gói sản phẩm và sau đó tái xuất về Hàn Quốc.
                3. Một số chú ý khi sử dụng sản phẩm
                Chất liệu vải cotton organic sử dụng từ bông trồng theo phương pháp hữu cơ. Vải được hạn chế tối đa sự can thiệp hóa chất để đảm bảo an toàn cho sức khỏe của trẻ nên có thể bị co giãn khi giặt 1 thời gian.
                4. Hướng dẫn giặt ủi
                + Nên giặt bằng tay nhẹ nhàng 
                + Nếu sử dụng máy giặt, phải dùng túi giặt 
                + Không giặt bằng nước nóng
                + Khi ủi nên đặt một mảnh vải lót giữa bàn ủi và quần (áo)
                + Nên sử dụng bột giặt hoặc nước giặt dành cho trẻ em
                + Không dùng chất tẩy trắng vì sẽ gây phai màu
                + Tránh phơi đồ trực tiếp dưới ánh nắng, nên phơi dưới bóng râm
                + Không nên sử dụng máy sấy vì có thể gây co rút
                5. Điều kiện đổi trả theo đúng quy định của Shopee
                + Điều kiện áp dụng (trong vòng 07 ngày kể từ khi nhận sản phẩm): 
                    -Hàng hoá vẫn còn mới, chưa qua sử dụng
                -Hàng hóa hư hỏng do vận chuyển hoặc do nhà sản xuất.
                + Trường hợp được chấp nhận: 
                    -Hàng không đúng chủng loại, mẫu mã như quý khách đặt hàng
                -Không đủ số lượng, không đủ bộ như trong đơn hàng
                -Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ… 
                + Trường hợp không đủ điều kiện áp dụng chính sách: 
                    -Quá 07 ngày kể từ khi Quý khách nhận hàng
                -Gửi lại hàng không đúng mẫu mã, không phải hàng của Unifriend
                -Đặt nhầm sản phẩm, chủng loại.
                ',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 33
        Product::create([
            'name' => 'Bộ quần áo thời trang hè cho bé trai 18-50kg từ 6-14 tuổi mẫu polo B. Đồ bộ bé trai, set quần đùi áo cộc cho trẻ em nam',
            'description' => 'Bộ quần áo thời trang hè cho bé trai 18-50kg từ 6-14 tuổi mẫu polo B. Đồ bộ bé trai, set quần đùi áo cộc cho trẻ em nam
                ❤ SHOP CAM KẾT: 
                ✔Sản phẩm 100% giống mô tả.
                ✔ Bảo hành 1 đổi 1 nếu gặp lỗi do nhà sản xuất 
                ✔ Các sản phẩm trước khi gửi đi đều được kiểm tra cẩn thận, trong quá trình vận chuyển có thể dẫn đến hư hỏng không mong muốn 
                ✔Quý khách vui lòng quay lại video khi nhận hàng và mở gói hàng để được bảo hành.
                Mô tả sản phẩm
                • Với thiết kế thời trang và chất liệu thoáng mát, bộ quần áo này không chỉ mang lại sự thoải mái mà còn tôn lên phong cách của bé. 
                • Màu sắc nam tính, lịch sự lại không kém phần nổi bật của bộ quần áo polo này sẽ là điểm nhấn trong tủ đồ hè của bé.
                • Hình in : in chuẩn hàng xuất khẩu, sử dụng an toàn ko hư vỡ hình khi giặt
                • Quần áo cho bé nhiều size để bạn lựa chọn sản phẩm phù hợp với độ tuổi và cân nặng của bé yêu.
                • Ảnh thật sản phẩm là ảnh trải sàn ở cuối
                • Tuỳ theo độ phân giải mỗi thiết bị khác nhau và do góc chụp, ánh sáng có thể chênh lệch 3-5 phần.
                • Bảng size mang tính chất tham khảo, phụ thuộc vào tuỳ thể trạng từng bé, ba mẹ cân nhắc lựa chọn phù hợp.
                • Quý khách hãy đọc mô tả sản phẩm trước khi mua, trong mô tả có đầy đủ thông tin cần thiết.

                HƯỚNG DẪN BẢO QUẢN VÀ SỬ DỤNG
                Giặt riêng sản phẩm với lần giặt đầu tiên.Khuyến khích giặt tay. Nếu giặt bằng máy thì nên cho vào túi lưới trước khi cho vào máy giặt.Không sử dụng bột giặt có chất tẩy nồng độ cao',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 34
        Product::create([
            'name' => 'Đồ bộ quần áo ba lỗ sát nách cotton cho bé trai, bé gái mặc nhà mùa hè Unifriend Quốc U2022-11. Size đại trẻ em 5, 6, 8,',
            'description' => 'BẢO HÀNH ĐỔI TRẢ 7 NGÀY THEO CHÍNH SÁCH CỦA SHOPEE
                - Khi mẫu lỗi do nhà sản xuất
                - Khi giao sai size/ Sai mẫu khách đã đặt hàng
                - Khi giao thiếu hàng
                - Hỗ Trợ đổi trả nếu sản phẩm không giống hình
                1. Thông tin sản phẩm
                Tên sản phẩm: Đồ bộ quần áo ba lỗ cotton cho bé trai, bé gái mặc nhà mùa hè Unifriend Quốc U2022-11. Size đại trẻ em 5, 6, 8, 10 tuổi
                Loại sản phẩm: Đồ bộ quần áo ba lỗ cotton trẻ em
                Size: 90-160
                Chất liệu: 100% Cotton hữu cơ
                Xuất xứ vải: Hàn Quốc
                Nước sản xuất: Hàn quốc / Indonesia / Việt Nam
                2. Thông tin về thương hiệu
                UNIFRIEND là một trong hai thương hiệu thời trang trẻ em nổi tiếng của Công ty Gyeongwon FNV Co., Ltd. có trụ sở tại Seoul, Hàn Quốc. Với sứ mệnh tạo ra những sản phẩm thời trang "Organic Cotton" chất lượng và an toàn cho trẻ em tại Hàn Quốc, vào năm 2004, công ty đã chính thức được thành lập. Đến nay, sau hơn 17 năm, UNIFRIEND không chỉ nổi tiếng ở Hàn Quốc với hệ thống hơn 100 cửa hàng offline mà tại các quốc gia như Thái Lan, Malaysia, Indonesia, Nhật Bản, Trung Quốc, Mỹ,...
                       Chất liệu vải 100% Organic Cotton, không dùng chất huỳnh quang. Toàn bộ quy trình sản xuất như kéo sợi, dệt, nhuộm, in ấn,... đều được thực hiện tại Hàn Quốc và đã được tổ chức ECOCERT (Pháp) xác minh, kiểm tra và chứng nhận đạt tiêu chuẩn thành phần hữu cơ OCS 100.
                       Để nâng cao chất lượng sản xuất và tối ưu giá thành sản phẩm, vào tháng 5.2017, công ty đã thành lập nhà máy, chuyển giao công nghệ và thực hiện công đoạn may tại Việt Nam và Indonesia (những quốc gia hàng đầu về ngành dệt may). Vải thành phẩm sau khi hoàn thành tại Hàn Quốc sẽ được xuất sang Việt Nam và Indonesia để may, đóng gói sản phẩm và sau đó tái xuất về Hàn Quốc.
                3. Một số chú ý khi sử dụng sản phẩm
                Chất liệu vải cotton organic sử dụng từ bông trồng theo phương pháp hữu cơ. Vải được hạn chế tối đa sự can thiệp hóa chất để đảm bảo an toàn cho sức khỏe của trẻ nên có thể bị co giãn khi giặt 1 thời gian.
                4. Hướng dẫn giặt ủi
                + Nên giặt bằng tay nhẹ nhàng 
                + Nếu sử dụng máy giặt, phải dùng túi giặt 
                + Không giặt bằng nước nóng
                + Khi ủi nên đặt một mảnh vải lót giữa bàn ủi và quần (áo)
                + Nên sử dụng bột giặt hoặc nước giặt dành cho trẻ em
                + Không dùng chất tẩy trắng vì sẽ gây phai màu
                + Tránh phơi đồ trực tiếp dưới ánh nắng, nên phơi dưới bóng râm
                + Không nên sử dụng máy sấy vì có thể gây co rút
                5. Điều kiện đổi trả theo đúng quy định của Shopee
                + Điều kiện áp dụng (trong vòng 07 ngày kể từ khi nhận sản phẩm): 
                    -Hàng hoá vẫn còn mới, chưa qua sử dụng
                -Hàng hóa hư hỏng do vận chuyển hoặc do nhà sản xuất.
                + Trường hợp được chấp nhận: 
                    -Hàng không đúng chủng loại, mẫu mã như quý khách đặt hàng
                -Không đủ số lượng, không đủ bộ như trong đơn hàng
                -Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ… 
                + Trường hợp không đủ điều kiện áp dụng chính sách: 
                    -Quá 07 ngày kể từ khi Quý khách nhận hàng
                -Gửi lại hàng không đúng mẫu mã, không phải hàng của Unifriend
                -Đặt nhầm sản phẩm, chủng loại.
                ',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 35
        Product::create([
            'name' => '[ B01 ] Bộ thun tăm lạnh cộc tay,quần áo trẻ em nhiều hoạ tiết cho bé trai - bé gái từ 4 - 15kg - CÚN BABY',
            'description' => 'THỒNG TIN SẢN PHẨM
                -Bộ cộc tăm trắng , hoạ tiết đơn giản, tinh tế, nổi bật, sang trọng cho từng sản phẩm, làm bé nổi bật, đặc biết tôn sáng da.
                -Bộ cộc đơn giản là sự lựa chọn hoàn hảo cho bé mặc ngày thường, form áo vừa vặn cơ thể, thoải mái cho bé vận động.
                -Chất liệu vải thun tăm lạnh co giãn, ít nhăn, bền đẹp, không co rút sau giặt, tỉ mỉ trong từng đường may.
                HƯỚNG DẪN CHỌN SIZE :
                Size 2: 4 - 6kg
                Size 3: 6 - 8kg
                Size 4: 8 - 10kg
                Size 5: 10 - 12kg
                Size 6: 13 - 15kg
                Cam kết & Ưu Đãi :
                - Hàng đẹp, chất lượng
                -Chất vải mát, mềm, mịn
                - Được kiểm tra hàng trước khi thanh toán
                -Hỗ trợ đổi trả trong vòng 7 ngày kể từ khi nhận hàng',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 36
        Product::create([
            'name' => 'Trẻ Em Quần Áo Trẻ Em Bé Gái Lông Cừu Lót Phù Hợp Với Thu Đông Phong Cách Mới Thời Trang Phong Cách Phương Tây',
            'description' => 'Vải / chất liệu: Bông / Bông
                Nội dung thành phần: 51% (Bao gồm) -70% (Bao gồm)
                Giới tính áp dụng: Nữ
                Các yếu tố phổ biến: Màu đồng nhất, Trang trí ba chiều, Ren
                Số miếng: Bộ hai mảnh
                Chiều dài tay áo: Dài tay
                Chiều dài đáy: Dài
                Mức độ an toàn: Loại B
                Độ dày: Thường xuyên
                Mùa áp dụng: Mùa đông
                Mô hình: Phim hoạt hình
                Phong cách: Phim hoạt hình
                Placket quần áo: Áo chui đầu
                Nhóm tuổi áp dụng: 0-3 tuổi (Không bao gồm), 8 tuổi (Bao gồm) -14 tuổi (Không bao gồm), 6 tuổi (Bao gồm) -8 tuổi (Không bao gồm), 3 tuổi (Bao gồm) -6 tuổi (Không bao gồm)
                Cho dù có mũ trùm đầu: Trùm đầu
                Có thêm nhung hay không: Thêm nhung',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 37
        Product::create([
            'name' => 'Áo Dài Bé Trai Bé Gái Fbaby Thiết Kế Gấm Họa Tiết Cao Cấp Cho Bé Đi Chơi, Lễ Tết Chất Liệu An Toàn Cho Bé',
            'description' => 'Thông tin sản phẩm
                - Màu sắc : Vàng - Xanh Cốm
                Hướng dẫn bảo quản sản phẩm
                - Ưu tiên giặt bằng tay giúp kéo dài vòng đời của sản phẩm.
                - Hạn chế giặt bằng máy để tránh nhăn và bạc màu sản phẩm.
                - Tuyệt đối không sử dụng các loại xà phòng giặt có chất tẩy mạnh.
                - Ủi ở nhiệt độ dưới 110*C để tránh làm giãn vải và làm mất đi form dáng ban đầu.
                Lưu ý khi chọn size:
                    - Fbaby có bảng size mẫu để ba mẹ tham khảo.
                - Ba mẹ nên inbox trực tiếp cho Fbaby chiều cao, cân nặng của bé để được tư vấn size chi tiết nhé!
                - Đây là bảng thông số chọn size cơ bản, tùy thuộc vào mỗi bé mà có thể +/- 1 Size',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 38
        Product::create([
            'name' => 'Nguyên Set Đồ Công An Trẻ Em Đầy Đủ Phụ Kiện Đi Kèm Đủ Size Đủ Màu Giá Rẻ Nhất Thị Trường',
            'description' => '1. Tên Sản Phẩm: Công An Trẻ Em
                     Bộ đồ bao gồm: Áo, quần, mũ, gậy, còi, dây đai, bắn nước.
                2. Tên Sản Phẩm: Đồ Rằn Ri Trẻ Em
                     Bộ đồ bao gồm: Mũ, quần, áo
                3. Tên Sản Phẩm: Hải quân nam
                     Bộ đồ bao gồm: Mũ, quần, áo
                4. Cách chọn size cho bé:
                - Số 1:  8 - 10kg          
                - Số 2:   11 - 12kg      
                - Số 3:   13 - 14kg              
                - Số 4:   15 - 16kg              
                - Số 5:   17 - 18kg               
                - Số 6:   19 - 20kg             
                - Số 7:    21 - 22kg            
                - Số 8:    23 - 24kg              
                - Số 9:    25 - 26kg            
                - Số 10:   27 - 28kg              
                - Số 11:   29 - 30kg             
                - Số 12:   31 - 32kg   ',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 39
        Product::create([
            'name' => 'Bộ Đồ Cộc Tay Bé Trai Labubu Cho Bé Từ 8-36kg chất vải tổ ong Cotton Dày Đẹp. Hoạ tiết labubu hot trend Cho Bé Trai',
            'description' => 'Bộ Đồ Cộc Tay Bé Trai Labubu Cho Bé Từ 8-36kg chất vải tổ ong Cotton Dày Đẹp. Hoạ tiết labubu hot trend Cho Bé Trai
                SHOP CHÚNG TÔI CAM KẾT :
                 - Sản phẩm giống 100% hình ảnh quảng cáo
                 - Chế độ đổi mới 3 ngày đầu tiên nếu sản phẩm có lỗi nhà sản xuất 
                THÔNG TIN SẢN PHẨM :
                Bộ quần áo hè thể thao bé trai 8-36kg, bộ đồ sát nách bé trai 5-15 tuổi , chất mềm mát, hàng may kĩ
                Sản xuất tại Việt Nam
                ☘️  Thấm hút mồ hôi, thoáng mát.
                ☘️ Sản phẩm phù hợp cho các tất cả các bé và cả người lớn
                ☘️ Hàng chuẩn form,từng đường viền may được thực hiện tỉ mỉ và tinh tế vừa đẹp mắt vừa đảm bảo độ bền hoàn hảo với thời gian. 
                ☘️ Giao hàng nhanh chóng trên toàn quốc. Đội ngũ nhân viên trẻ tư vấn nhiệt tính, nhanh chóng, giá cực kì yêu thương chỉ 
                ☘️Hướng dẫn mua hàng: Bạn chọn màu sắc, kích cỡ và số lượng rồi cho vào giỏ hàng. Sau khi bạn chọn đủ thì vào giỏ hàng để tiến hành mua hàng. Bạn có thể điều chỉnh số lượng trong giỏ hàng trước khi quyết định mua',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 40
        Product::create([
            'name' => 'Bộ thun tăm lạnh dài tay chất thun tăm lạnh mềm mịn thoáng mát cho bé trai bé gái',
            'description' => 'THỒNG TIN SẢN PHẨM
                - Bộ tay dài quần dài chất tăm lạnh , hoạ tiết đơn giản, tinh tế, nổi bật, sang trọng cho từng sản phẩm, làm bé nổi bật, đặc biết tôn sáng da.
                - Bộ dài tay đơn giản là sự lựa chọn hoàn hảo cho bé mặc ngày thường, form áo vừa vặn cơ thể, thoải mái cho bé vận động.
                - Chất liệu vải thun tăm lạnh co giãn, ít nhăn, bền đẹp, không co rút sau giặt, tỉ mỉ trong từng đường may.
                HƯỚNG DẪN CHỌN SIZE : 
                Size 2: 6 - 8kg 
                Size 3: 8 - 10kg 
                Size 4: 10 - 12kg 
                Size 5: 12 - 14kg 
                Size 6: 14 - 16kg
                𝐂𝐚𝐦 𝐊ế𝐭 & Ư𝐮 Đã𝐢 :
                - Hàng đẹp, chất lượng
                - Chất vải mát, mềm, mịn
                - Được kiểm tra hàng trước khi thanh toán
                - Hỗ trợ đổi trả trong vòng 7 ngày',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 41
        Product::create([
            'name' => 'Áo nỉ hoodie thu đông dành cho bé trai và bé gái 14-45kg mẫu CAPYBARA. Chất liệu ấm áp, thiết kế mới',
            'description' => 'CHÀO MỪNG CÁC BẠN ĐẾN VỚI SHOP THỜI TRANG EM BÉ SHOP chuyên cung cấp các sản phẩm dành cho các bé :quần áo bé nam, quần áo bé nữ , dép bé nam, nữ với rất nhiều mẫu mã và kiểu dáng và màu sấc ttha hồ để lựa chọn. ngoài ra shop còn có các sản phẩm như dồ chơi trẻ em, phụ kiện kính, túi xách cho bé .
                  Chất liệu vải không quá dày và quá mỏng thích hợp cho tất cả mùa trong năm .
                Chúng tôi cam kết chất lượng sản phẩm là tốt nhất sẽ đem đến cho các bé những trải nghiệm tuyệt vời để thỏa sức vui chơi và học hỏi .
                  Đổi trả hàng cho quý khách khi sản phẩm không đúng chất lượng hoặc đổi lại hàng khi các bạn đặt nhầm size.
                _ Thông số sản phẩm:
                 Size4 : 14-17kg
                Size6 18-23kg
                Size8 24-27kg
                Size10 28-31kg
                Size12 32-37kg
                Size14 38-45kg
                - Hướng dẫn đặt mua nhiều màu, mẫu, kích thước trong 1 đơn hàng: Bạn phải chọn màu, mẫu hoặc kích thước bạn muốn rồi cho vào giỏ hàng. Sau khi chọn đủ thì vào giỏ hàng để tiến hành mua hàng. Có thể điều chỉnh số lượng mua trong giỏ hàng nếu muốn.
                - Đối với những sản phẩm có nhiều mẫu, màu sắc, nhiều kích thước. Quý khách vui lòng đặt mua đúng mẫu, màu, kích thước của sản phẩm trên hệ thống để tránh nhầm lẫn. CẢM ƠN VÀ RẤT HÂN HẠNH ĐƯỢC PHỤC VỤ CHO CÁC BẠN!!!!!!',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 42
        Product::create([
            'name' => 'Bộ quần áo nỉ màu xáM tối lót lụa mềm thêu chữ BABYBUY bên tay áo cho bé trai và bé gái',
            'description' => 'Cảm ơn khách yêu đã tin tưởng và ủng hộ shop ạ ️
                 Bảng Size
                -Size 90 : 10-15kg cao 85-95cm
                -Size 100: 13-18kg cao 90-105cm
                -size 110: 15-20kg cao 105-110cm
                -Size 120: 18-25kg cao 110-120cm
                -Size 130 : 23-28kg cao 120-130cm
                -Size 140: 28-35kg cao 130-140cm 
                -Size 150 : 32-40kg cao 140-148cm 
                KHI CHỌN SIZE KHÁCH HÀNG ƯU TIÊN CHỌN THEO CHIỀU CAO GIÚP SHOP NHÉ Ạ ! VÌ ĐỒ NHÀ SHOP CHIỀU NGANG RẤT TO LÊN KHÔNG SỢ CHẬT ĐỂ PHẢI CHỌN THEO CÂN NẶNG NHÉ Ạ.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 43
        Product::create([
            'name' => 'Bộ Quần Áo Thể Thao Tay Ngắn Cho Bé Trai Kiểu Hoạt Hình Chất Vải Tổ Ong mềm Mịn,Sét Áo Thun Cộc Tay + Quần Short Bé Trai',
            'description' => 'Bộ Quần Áo Thể Thao Tay Ngắn Cho Bé Trai Kiểu Hoạt Hình Chất Vải Tổ Ong mềm Mịn,Sét Áo Thun Cộc Tay + Quần Short Bé Trai
                SHOP CHÚNG TÔI CAM KẾT :
                 - Sản phẩm giống 100% hình ảnh quảng cáo
                 - Chế độ đổi mới 3 ngày đầu tiên nếu sản phẩm có lỗi nhà sản xuất 
                THÔNG TIN SẢN PHẨM :
                Bộ quần áo hè thể thao bé trai 18-50kg, bộ đồ sát nách bé trai 5-15 tuổi , chất mềm mát, hàng may kĩ
                Sản xuất tại Việt Nam
                ☘️  Thấm hút mồ hôi, thoáng mát.
                ☘️ Sản phẩm phù hợp cho các tất cả các bé và cả người lớn
                ☘️ Hàng chuẩn form,từng đường viền may được thực hiện tỉ mỉ và tinh tế vừa đẹp mắt vừa đảm bảo độ bền hoàn hảo với thời gian. 
                ☘️ Giao hàng nhanh chóng trên toàn quốc. Đội ngũ nhân viên trẻ tư vấn nhiệt tính, nhanh chóng, giá cực kì yêu thương chỉ 
                ☘️Hướng dẫn mua hàng: Bạn chọn màu sắc, kích cỡ và số lượng rồi cho vào giỏ hàng. Sau khi bạn chọn đủ thì vào giỏ hàng để tiến hành mua hàng. Bạn có thể điều chỉnh số lượng trong giỏ hàng trước khi quyết định mua',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 44
        Product::create([
            'name' => 'Sét bộ quần áo trẻ em thu đông dành cho bé trai mẫu 3 khoang 5-14 tuổi',
            'description' => 'CHÀO MỪNG CÁC BẠN ĐẾN VỚI SHOP THỜI TRANG EM BÉ
                SHOP chuyên cung cấp các sản phẩm dành cho các bé :quần áo bé nam, quần áo bé nữ , dép bé nam, nữ với rất nhiều mẫu mã và kiểu dáng và màu sấc ttha hồ để lựa chọn. ngoài ra shop còn có các sản phẩm như dồ chơi trẻ em, phụ kiện kính, túi xách cho bé
                . 💯 Chất liệu vải không quá dày và quá mỏng thích hợp cho tất cả mùa trong năm
                . 💯chúng tôi cam kết chất lượng sản phẩm là tốt nhất sẽ đem đến cho các bé những trải nghiệm tuyệt vời để thỏa sức vui chơi và học hỏi
                . 💯đổi trả hàng cho quý khách khi sản phẩm không đúng chất lượng hoặc đổi lại hàng khi các b đặt nhầm size
                - Hướng dẫn đặt mua nhiều màu, mẫu, kích thước trong 1 đơn hàng:
                Bạn phải chọn màu, mẫu hoặc kích thước bạn muốn rồi cho vào giỏ hàng. Sau khi chọn đủ thì vào giỏ hàng để tiến hành mua hàng. Có thể điều chỉnh số lượng mua trong giỏ hàng nếu muốn.
                - Đối với những sản phẩm có nhiều mẫu, màu sắc, nhiều kích thước. Quý khách vui lòng đặt mua đúng mẫu, màu, kích thước của sản phẩm trên hệ thống để tránh nhầm lẫn.
                ∞ Thông số kích cỡ quần áo: 
                + size4 14-18kg
                + SIZE6 18-22KG
                + SIZE8 23-27KG
                + SIZE10 28-31KG
                + SIZE12 32-36KG
                + SIZE14 37-45KG
                ∞Năm sản xuất : 2022
                ∞ Xuất sứ:  Việt Nam
                CẢM ƠN VÀ RẤT HÂN HẠNH ĐƯỢC PHỤC VỤ CHO CÁC BẠN!!!!!!',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 45
        Product::create([
            'name' => 'Set bộ bé trai size đại Magickids đồ bộ mùa hè cho bé từ 18 đến 48kg chất cotton mềm mịn Quần áo trẻ em',
            'description' => 'CHI TIẾT SẢN PHẨM BỘ THUN BÉ TRAI
                - Tên sản phẩm : Set bộ bé trai size đại Magickids đồ bộ mùa hè cho bé từ 18 đến 48kg chất cotton mềm mịn Quần áo trẻ em BD24016
                - Chất liệu : cotton TC
                - Màu : xanh
                - Size : 110-170 (18-48kg)
                - Sản phẩm gồm : 1 áo + 1 quần',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 46
        Product::create([
            'name' => 'Đồ bộ bé gái Tăm phối bèo baby three áo dài quần dài có size đại',
            'description' => 'VỀ SẢN PHẨM 
                • Chất liệu: Thun Len Cotton 4 chiều, thoải mái, màu sắc tươi mới, mang lại cho bé cảm giác cực kỳ dễ chịu, thấm hút mồ hôi tốt
                • Form: dáng suông
                • Size: từ 8-40kg
                BẢNG ĐO SIZE
                • Size 12: nặng 8-11KG, cao 74-79cm
                • Size 16: nặng 12-15KG, cao 80-90cm
                • Size 20: nặng 16-19KG, cao 90-100cm
                • Size 24: nặng 20-23KG, cao 100-110cm
                • Size 28: nặng 24-27KG, cao 110-120cm
                • Size 32: nặng 28-31KG, cao 120-130cm
                • Size 36: nặng 32-35KG, cao 130-140cm
                • Size 40: nặng 36-40KG, cao 140-150cm
                BẢO QUẢN 
                • Giặt tay để tránh bay màu hoặc xù lông, ủi nhiệt độ bình thường. Phơi, ủi mặt trái
                • Không vắt hoặc xoắn mạnh vì điều này có thể gây ra các nếp nhăn và ảnh hưởng đến độ bền, cấu trúc của vải
                SAMKIDS CAM KẾT
                ✔Về sản phẩm: Shop cam kết về chất lượng & hình ảnh chính chủ do THỜI TRANG TRẺ EM SAMKIDS tự chụp. 
                ✔Về giá cả : Sản phẩm do xưởng nhà SAMKIDS tự tay thiết kế và sản xuất trực tiếp nên chi phí sẽ là RẺ NHẤT thị trường.
                ✔Về dịch vụ: Shop sẽ cố gắng trả lời hết những thắc mắc xoay quanh sản phẩm → Ib ngay cho shop nhé
                ✔Thời gian chuẩn bị hàng: Hàng có sẵn, thời gian chuẩn bị tối ưu nhất. 
                CHÍNH SÁCH ĐỔI TRẢ
                ✔Chính sách bao đổi trả hàng miễn phí khi sản phẩm kém chất lượng, nhầm size, số lượng. 
                ✔ Ngoài ra, nếu quý khách hàng có nhu cầu đổi do đặt nhầm, shop vẫn sẽ hỗ trợ tận tình khi sản phẩm còn mới nguyên chưa qua sử dụng.
                Chịu trách nhiệm sản xuất: SAMKIDS Official Store
                Chịu trách nhiệm phân phối: SAMKIDS Official Store
                Xuất xứ: Việt Nam.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 47
        Product::create([
            'name' => 'Bộ cộc tay cài vai BENTY full họa tiết mới bé trai bé gái, bộ đồ trẻ em mặc hè phong cách Hàn',
            'description' => 'Bộ cộc tay cài vai của Benty là sản phẩm quần áo trẻ em được làm từ chất liệu cotton mềm mại, mịn và co giãn 4 chiều, giúp bé luôn cảm thấy thoải mái và tự do vận động. Với thiết kế tay cài vai dễ thương, sản phẩm phù hợp cho bé trai và bé gái, giúp bé tỏa sáng và tự tin hơn trong mọi hoạt động
                1. Hướng dẫn bảo quản quần áo trẻ em bộ BENTY cho bé
                -Không sử dụng chất tẩy trắng để làm sạch quần áo cho bé trai, bé gái
                -Khi giặt bằng máy nên phân loại bộ cộc thẳng cho bé và sử dụng túi giặt
                -Không sử dụng nhiệt độ cao để sấy khô bộ quần áo 
                -Khi quần áo bị dính bẩn hãy làm sạch bằng nước lạnh và chất giặt nhẹ
                -Nên giặt tay để giữ độ mềm mại của quần áo trẻ em
                2. Hướng dẫn chọn size quần áo trẻ em BENTY
                Size 3M-6M (từ 3 đến 6 tháng): cân nặng 5,5-7,5kg, chiều cao 58 đến 66cm
                Size 6M-9M (từ 6 đến 9 tháng): cân nặng 7,5-8,5kg,chiều cao 66 đến 72cm
                Size 9M-12M (từ 9 đến 12 tháng) :cân nặng 8,5-10kg,chiều cao 72 đến78cm
                Size 12M-18M (từ 12 đến 18 tháng):cân nặng 10-12kg, chiều cao 78 đến 85cm
                Size 18M-24M (từ 18 đến 24 tháng): cân nặng 12-14,5kg, chiều cao 85 đến 90cm
                Size 2-3Y (từ 2 đến 3 tuổi): cân nặng 14,5 -16kg, chiều cao 90 đến 95cm
                Size 3-4Y (từ 3 đến 4 tuổi): cân nặng 16 -18.5kg, chiều cao 95 đến 105cm
                Size 4-5Y (từ 4 đến 5 tuổi): cân nặng 18,5 -21kg, chiều cao 105 đến 110cm
                3. Cam kết bộ quần áo BENTY cho bé
                -Tất cả các sản phẩm quần áo trẻ em của thương hiệu Benty đều được sản xuất từ chất liệu cotton cao cấp, đảm bảo độ mềm mại, mịn và thoáng mát cho bé yêu của bạn
                -Shop luôn kiểm tra và đảm bảo rằng sản phẩm của chúng tôi đáp ứng tiêu chuẩn chất lượng cao nhất
                -Nếu quý khách hàng gặp bất kỳ vấn đề gì liên quan đến sản phẩm của shop, hãy liên hệ ngay với shop để được hỗ trợ và giải quyết vấn đề trong thời gian ngắn nhất
                4. Chính sách đổi trả bộ quần áo BENTY
                -Chính sách đổi trả của shop là đảm bảo quyền lợi tối đa cho khách hàng khi mua sản phẩm quần áo trẻ em của thương hiệu Benty.
                -Sản phẩm cần được giữ trong tình trạng mới và chưa qua sử dụng. Quý khách cũng cần đảm bảo sản phẩm trả về đầy đủ phụ kiện và nguyên tem nhãn của sản phẩm
                -Shop sẽ hỗ trợ đổi trả sản phẩm cho quý khách trong vòng 7 ngày kể từ ngày nhận hàng
                5. BẢO HÀNH 1 THÁNG THEO CHÍNH SÁCH CỦA SHOPEE
                - Khi mẫu lỗi do nhà sản xuất
                - Khi giao sai size / Sai mẫu khách đã đặt hàng
                - Khi giao thiếu hàng
                - Hỗ trợ đổi trả nếu sản phẩm không giống hình',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 48
        Product::create([
            'name' => 'Bộ thun cotton ngắn tay cho bé gái 5 màu, 5 hình in cực đáng yêu. Bộ thun gồm Quần và Áo cho bé gái từ 9-52Kg',
            'description' => 'Chào mừng các bạn đã đến với shop thời trang Xưởng May Tuấn Dung.   
                Chúc các bạn một ngày tốt lành và cảm thấy thoải mái khi chọn được những sản phầm phù hợp cho các bé nhà mình.
                + Các Mom dựa vào cân nặng của bé để chọn size phù hợp nhé.
                Đối với bé nào trộm vía bụ bẫm các Mom hãy chọn size nhỉnh hơn một chút so với size thật của bé để bé được mặc thoải mái nhất ạ.
                Lưu ý
                *SHOP KHÔNG NHẬN ĐẶT HÀNG QUA TIN NHẮN và GHI CHÚ. 
                Sản phẩm của shop đã được phân loại hàng rất rõ ràng. Phân loại hàng nào không chọn được có nghĩa là hết hàng. Sản phẩm nào không có phân loại thì sẽ giao ngẫu nhiên như thông báo trong mô tả. Quý khách hãy đọc mô tả sản phẩm trước khi mua, trong mô tả có đầy đủ thông tin cần thiết.
                *Nếu có KHIẾU NẠI đơn hàng (thiếu, nhầm, sai,…) mong bạn GIỮ LẠI PHIẾU IN dán bên ngoài kiện hàng và liên hệ shop để cùng kiểm tra và giải quyết.Cảm ơn và hân hạnh được phục vụ các bạn <3.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 49
        Product::create([
            'name' => 'Set bộ quần áo mùa hè dành cho bé trai và bé gái Choice SO78 15-45kkg mẫu số 78',
            'description' => '✪ THÔNG TIN SẢN PHẨM
                Tên sản phẩm: Set bộ quần áo mùa hè Choice SO78 dành cho bé trai và bé gái 15-45 kg mẫu số 78
                - Chất liệu vải không quá dày và quá mỏng thích hợp cho tất cả mùa trong năm .
                - Chất lượng sản phẩm là tốt nhất sẽ đem đến cho các bé những trải nghiệm tuyệt vời để thỏa sức vui chơi và học hỏi .
                ✪ Lưu ý khi mua hàng: Khách tham khảo kỹ bảng size, mô tả sản phẩm và ảnh cận chất liệu để lựa chọn sản phẩm phù hợp với mình (tránh trường hợp mua sản phẩm không phù hợp với ý thích). Mọi thắc mắc khác vui lòng liên hệ qua Shopee chat để được trả lời nhanh nhất.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 50
        Product::create([
            'name' => 'Set bộ quần áo bé gái mùa hè Choice HE12 18-45kg mẫu HI. Thiết kế mới, chất liệu mát',
            'description' => '✪ THÔNG TIN SẢN PHẨM
                Tên sản phẩm: Set bộ quần áo bé gái mùa hè Choice HE12 18-45kg mẫu HI
                - Thiết kế mới, chất liệu mát
                - Chất liệu vải NỈ không quá dày và quá mỏng thích hợp cho tất cả mùa trong năm
                - Chúng tôi cam kết chất lượng sản phẩm là tốt nhất sẽ đem đến cho các bé những trải nghiệm tuyệt vời để thỏa sức vui chơi và học hỏi 
                - Thông số sản phẩm:
                 + Size6 18-23kg
                + Size8 24-27kg
                + Size10 28-31kg
                + Size12 32-37kg
                + Size14 38-45kg
                - Hướng dẫn đặt mua nhiều màu, mẫu, kích thước trong 1 đơn hàng: Bạn phải chọn màu, mẫu hoặc kích thước bạn muốn rồi cho vào giỏ hàng. Sau khi chọn đủ thì vào giỏ hàng để tiến hành mua hàng. Có thể điều chỉnh số lượng mua trong giỏ hàng nếu muốn. 
                ✪ Lưu ý khi mua hàng: Khách tham khảo kỹ bảng size, mô tả sản phẩm và ảnh cận chất liệu để lựa chọn sản phẩm phù hợp với mình (tránh trường hợp mua sản phẩm không phù hợp với ý thích). Mọi thắc mắc khác vui lòng liên hệ qua Shopee chat để được trả lời nhanh nhất.',
            'status' => 'active',
            'seller_id' => 1,
            'category_id' => 3,
        ]);
        // product_id: 51
        Product::create([
            'name' => 'Đồng hồ nam dây da PABLO RAEZ dạ quang chống nước lịch sự đơn giản U850 CARIENT',
            'description' => 'Đồng hồ nam dây da PABLO RAEZ dạ quang chống nước lịch sự đơn giản U850 CARIENT
                ⚠️ CAM KẾT CHẤT LƯỢNG SẢN PHẨM ĐÚNG NHƯ MÔ TẢ
                ⚠️ ĐỔI TRẢ MIỄN PHÍ 15 NGÀY NẾU DO LỖI CỦA SHOP
                🔸	THÔNG TIN SẢN PHẨM :
                -Thương hiệu: PABLO RAEZ
                - Kiểu máy: Quartz
                - Chất liệu vỏ: Thép Không gỉ 316L
                - Chất liệu dây: Dây da cao cấp
                - Chất liệu mặt trước: Kính cứng Tráng Khoáng chống xước
                - Kích thước mặt: 40 mm 
                - Độ dày đồng hồ: 9,5mm
                - Khả năng chịu nước: 3 ATM rửa tay, đi mưa ( Nên chánh môi trường nước nóng )
                - Phù hợp đeo đi làm, đi học, dạo phố, xem phim, dự tiệc
                - Bảo hành 12 tháng
                - Chiều rộng dây đeo: 22MM
                - Chiều dài dây đeo: 230MM
                - Trọng lượng đồng hồ: 50G
                ✪ Đối với một người đàn ông hiện đại thì vẻ bề ngoài rất quan trọng, Chiếc Đồng Hồ Nam Đẹp được xem là một phụ kiện thời trang không thể thiếu giúp quý ông tăng thêm phần nam tính, lịch lãm
                ✪ Cho dù ở bất kỳ nơi đâu hay sự kiện nào, thì chiếc Đồng Hồ Nam Chính Hãng trên cổ tay cũng luôn làm cho đàn ông thu hút hơn đối với mọi người xung quanh.
                ✪ Một chiếc Đồng Hồ Nam Cao Cấp cho nam tuy là phụ kiện nhỏ hiện hữu trên cổ tay của đàn ông, nhưng đó là điểm nhấn lớn mà đàn ông cho thấy họ là một người có địa vị và đẳng cấp như thế nào trong mắt mọi người.
                ✪ Các Tiêu Trí cho Anh Em Chọn Đồng Hồ Là:
                + Đối với Người có vòng tay nhỏ, cổ tay mỏng nên chọn loại Đồng Hồ Nam Dây Da sẽ tạo cảm giác ôm sát cổ tay, vừa vặn hơn.
                + Đối với người to, khỏe, cá tính mạnh thì nên chọn Đồng Hồ Dây Thép sẽ tạo vẻ nam tính và khỏe khoắn hơn
                ✪ Tại Đây Xin giới thiệu Mẫu Đồng Hồ Nam mang mã hiệụ Cấp Carient Với Thiết kế mạnh mẽ mang dáng vẻ thanh lịch nhẹ nhàng giúp quý ông tăng thêm phần Phong Cách, lịch lãm và sang trọng.
                ✪ Đồng hồ nam tại CARIENT luôn có chất lượng và mẫu mã đa dạng. Đến với CARIENT bạn dễ dàng tìm được những loại đồng hồ phù hợp với nhu cầu của mình
                🔸 LƯU Ý :
                - Vui lòng không va đập và để đồng hồ tiếp xúc với chất ăn mòn, nhiệt độ cao hoặc từ trường mạnh.
                - Vui lòng tránh xa các dung môi, chất tẩy rửa, chất tẩy rửa công nghiệp, keo dán, sơn.
                - Đeo đồng hồ bằng vòng tay rất dễ trầy xước, hãy đeo dây đeo.
                - Không chỉnh nút chỉnh giờ khi đồng hồ bị ướt.
                - Vui lòng không đặt đồng hồ nơi có nhiệt độ thay đổi đột ngột.
                - Vui lòng không nhấn nút và cho vào nước
                THÔNG TIN THƯƠNG HIỆU
                CARIENT - Tổng kho đồng hồ chính hãng uy tín Việt Nam
                Giá cả cạnh tranh - Uy tín - Chất lượng',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);
        // product_id: 52
        Product::create([
            'name' => 'WISHDOIT Đồng hồ nam gốc Chống Nước Kinh Doanh Quartz Ba Mắt Đa Năng Dây Thép Không Gỉ Vàng/Bạc/Đen Thời Trang Thể Thao',
            'description' => 'Chào mừng đến với【WISHDOIT-Official-Store】
                Thương hiệu gốc chính thức: WISHDOIT & ZUNPAI & SENSTONE & DEMPSEY
                ✅Chúng tôi cam kết: Đồng hồ chính hãng 100%！
                ✅Giao hàng: Đơn hàng sẽ được giao trong vòng 12 giờ.
                【Bảo hành】
                1.Chúng tôi cam kết Bảo hành 3 năm.
                2.Nếu đồng hồ của bạn có bất kỳ vấn đề nào về chất lượng hoặc bạn không hài lòng, chúng tôi cung cấp dịch vụ Trả lại đầy đủ.
                3.Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.
                Hoan nghênh các đơn vị liên kết và đại lý bán lại.
                Hy vọng bạn mua sắm vui vẻ.',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);
        // product_id: 53
        Product::create([
            'name' => 'Đồng hồ nam cao cấp DIZIZID chính hãng - Chống nước độ sâu 30m - chạy Full kim và lịch ngày - Dây thép lụa cao cấp',
            'description' => 'THÔNG TIN CHI TIẾT SẢN PHẨM:
                Thương hiệu: DIZIZID
                Mẫu: Original Design
                Dây thép lụa đen không gỉ
                Đường kính mặt: 41mm
                Chiều dày mặt: 11mm
                Mặt kính: Kính khoáng chống trầy xước
                Màu mặt: đen
                Kích thước dây: dài 23cm x rộng 2cm
                Pin tốt
                Chạy 6 kim và lịch ngày
                Đồng hồ chống nước 3ATm (đia mưa, rửa tay, rửa xe thoải mái)
                TẶNG KÈM PIN DỰ PHÒNG
                🅰️  BỘ SẢN PHẨM BAO GỒM 
                ✅ Đồng hồ chính hãng + Hộp
                🅰️ NHỮNG CAM KẾT KHI MUA HÀNG CỦA SHOP 
                ✅ Cam kết về sản phẩm: Sản phẩm này 100% hàng chính hãng và giống y hệt ảnh
                ✅ Đổi trả hàng: sản phẩm còn nguyên vẹn, chưa cắt tháo dây thì shop đều cho đổi trả theo quy định của Shopee nếu sản phẩm lỗi do nhà sản xuất
                🅰️➥ Quy định bảo hành:
                ► Thời gian bảo hành: 12 tháng 
                ► Đổi trả trong 3 ngày nếu hàng bị lỗi do nhà sản xuất như là rớt kim, đồng hồ không chạy
                ► Trường Hợp Không Bảo Hành: 
                   • Các loại dây đeo, khoá, vỏ, màu xi, mặt số, mặt kiếng bị hỏng hóc, vỡ do sử dụng không đúng, tai nạn, lão hóa tự nhiên, va đập, … trong quá trình sử dụng
                   • Hỏng hóc do hậu quả gián tiếp của việc sử dụng sai hướng dẫn của hãng có kèm theo đồng hồ
                   • Không bảo hành đồng hồ bị vào nước do lỗi của khách hàng như làm hở chốt, không đóng chặt trước khi tiếp xúc nước...
                   • Trầy xước về dây hoặc mặt kiếng bị trầy xước, vỡ do va chạm mạnh trong quá trình sử dụng.
                   • Tự ý thay đổi máy móc bên trong, mở ra can thiệp sửa chữa trong thời gian còn bảo hành 
                 ✅Thời gian giao hàng : từ 1-5 ngày tùy tỉnh , huyện hay nội thành Giao nội tỉnh HCM – HN thường nhanh hơn, tỉnh lẻ và huyện thường lâu hơn 1 chút
                ',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);
        // product_id: 54
        Product::create([
            'name' => '[HCM] Đồng hồ Nam SKMEI 1335 điện tử dây thép chạy 2 múi giờ - Tặng Pin và Tháo dây',
            'description' => '▶ Đồng hồ SKMEI 1335 Dual Time đa năng chạy hai chế độ giờ chính và giờ kép (DT), với đầy đủ chức năng Báo thức (AL), Đếm giờ (TR), Bấm giờ (ST) và đèn LED. Skmei 1335 phù hợp cho các bạn nam có chu vi cổ tay từ 16.5cm trở lên
                ⚠️ Shop tạm NGỪNG tặng HỘP GIẤY SKMEI⚠️ 
                      RẤT MONG QUÝ KHÁCH THÔNG CẢM
                • Quý khách có nhu cầu, vui lòng mua kèm trong cửa hàng của shop
                ---------------------------------------------------
                ► THÀNH PHẦN:
                • Dây: Thép cuộn không gỉ
                • Khung vỏ: Nhựa ABS cứng
                • Kính: Nhựa resin
                ---------------------------------------------------
                ► THÔNG SỐ KỸ THUẬT
                • Model: SKMEI 1335 chính hãng (QR code)
                • Kiểu máy: Digital
                • Đường kính: 43mm (cả viền)
                • Đô dày mặt: 13mm
                • Chiều dài dây: 220 mm
                • Độ chịu nước: 5 ATM ở mức sinh hoạt (rửa tay, đi mưa)
                • Cân nặng: ..g
                • Pin: Maxell Lithium CR2025
                • Chức năng: Xem giờ, Lịch Ngày/Tháng/Thứ, Bấm giờ, Đếm giờ, Báo thức, Chế độ 12/24h, Đèn LED
                • THỜI GIAN BẢO HÀNH: 03 tháng bộ máy
                ---------------------------------------------------
                ► HƯỚNG DẪN DẪN SỬ DỤNG:
                • Đối với đồng hồ dây thép luôn thiết kế rộng hơn cổ tay của bạn, bạn có thể dùng dụ cụ cắt dây (shop tặng kèm theo) hoặc đem ra thợ họ cắt ngắn cho vừa nhé.
                • Nên xoay kim theo chiều kim đồng hồ, không nên chỉnh lịch ở vị trị 23h-9h, nên chỉnh ở vị trí 9h-12h
                • Không mang đi tắm, bơi lội, các hoạt động dưới nước
                • Không thao tác chỉnh giờ, các nút bấm khi tiếp xúc với nước
                • Không tiếp xúc với các hóa chất ăn mòn
                ---------------------------------------------------
                ► QUY CÁCH SẢN PHẨM: 01 Đồng hồ + 01 Pin đồng hồ
                ► CHÍNH SÁCH CỦA SHOP: 
                • Đồng hồ SKMEI Shop bán ra kèm:  01 viên pin đồng hồ, cắt mắt (hoặc cây chỉnh dây) đối với dây thép
                • Bao đổi trả nếu hàng không giống hình ảnh, mô tả
                • Hỗ trợ đổi hàng nếu không vừa size (yêu cầu hàng còn mới, chưa qua sử dụng, còn seal (nếu có), phí vận chuyển khách chịu)
                • 01 đổi 01 trong vòng 07 ngày nếu lỗi nhà sản xuất như chết máy, rớt kim, hư khóa
                ------------------------------------------------------------------------
                 ► THỜI GIAN GIAO HÀNG DỰ KIẾN: 
                • TP.HCM: 1-2 ngày đối với khu vực TP.HCM, 
                • Tỉnh lân cận: 2-5 ngày 
                • Miền Trung và Miền Bắc: vì là hàng có pin, nên chỉ vận chuyển bằng đường bộ, thời gian giao hàng dao động từ 4-7 ngày tùy thuộc vào bên vận chuyển.
                • Thời gian thực tế có thể chậm hơn do Chủ Nhật, ngày Lễ, thiên tai, dịch bệnh, yếu tố khách quan,..',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);
        // product_id: 55
        Product::create([
            'name' => 'Đồng Hồ Nam MINI FOCUS MF0399G.04 Dây Silicone Đỏ Viền Đen Thép Không Gỉ Mặt Vuông 48mm',
            'description' => 'Đồng Hồ Nam MINI FOCUS MF0399G.04 Dây Silicone Đỏ Viền Đen Thép Không Gỉ Cao Cấp Mặt Vuông Lộ Máy Kích Thước 48mm Chống Nước
                ✅ Tên sản phẩm: Đồng Hồ Nam MINI FOCUS MF0399G.04 Dây Silicone Đỏ Viền Đen Thép Không Gỉ Cao Cấp Mặt Vuông Lộ Máy Kích Thước 48mm Chống Nước
                ✅ Thương hiệu: MINI FOCUS
                ✅ Mã số: MF0399G
                ✅ Đối tượng sử dụng: Đồng hồ nam
                ✅ Chất liệu:
                ▶️ Viền vỏ và khóa: hợp kim thép không gỉ nguyên khối bền bỉ chắc chắn, có dập chìm chữ viết tắt của tên thương hiệu
                ▶️ Quai đeo: silicone cao cấp, chịu nhiệt tốt, mềm mại dẻo dai, màu sắc đồng đều, bề mặt mịn mướt, đặc biệt không gây bí da khi đeo
                ▶️ Mặt kính vồng: thuỷ tinh pha lê cường lực chống trầy xước, sứt mẻ, nứt vỡ khi bị va đập và có độ trong suốt tuyệt đối
                ✅ Màu sắc:
                1️⃣ ORANGE - Mặt vuông đen viền đen dây silicone cam
                2️⃣ BLUE - Mặt vuông xanh viền vàng dây silicone xanh
                3️⃣ BLACK - Mặt vuông đen viền vàng dây silicone đen
                4️⃣ RED - Mặt vuông đen viền đen dây silicone đỏ
                5️⃣ FULL BLACK - Mặt vuông đen viền đen dây silicone đen
                ✅ Thông số kỹ thuật:
                ▶️ Kích thước mặt: 48mm x 48mm
                ▶️ Độ dày mặt: 15mm
                ▶️ Độ rộng quai đeo: 26mm
                ▶️ Chiều dài quai đeo: 240mm
                ▶️ Trọng lượng: 108g
                ▶️ Tuổi thọ pin: lên đến tận 24 tháng
                ✅ Phong cách thiết kế: mặt vuông lộ máy độc lạ, phóng khoáng, thời trang, thể thao, cá tính, ấn tượng, mạnh mẽ, vạch chia số rõ ràng, có nhiều chức năng của một đồng hồ cao cấp
                ✅ Tính năng nổi bật: 
                ▶️ Chống nước 3ATM (hạn chế rửa tay; không đi mưa, tắm, xông hơi, bơi lội, tiếp xúc với môi trường ẩm ướt, xà bông hoặc hóa chất có tính tẩy rửa mạnh)
                ▶️ Cửa sổ hiển thị ngày tự hoạt động theo kim giờ
                ▶️ Hệ số 06 kim gồm 03 kim thông thường và 03 kim nâng cấp mở rộng của đồng hồ phụ đếm 1/10 giây, đồng hồ phụ đếm giây và đồng hồ phụ đếm phút 
                ✅ Thời gian bảo hành:
                ▶️ Đối với sản phẩm nguyên giá hoặc giảm giá dưới 5%: 6 tháng
                ▶️ Đối với sản phẩm giảm giá từ 5% đến dưới 10%: 3 tháng
                ▶️ Đối với sản phẩm giảm giá từ 10% trở lên: 6 tháng giảm 50% chi phí bảo hành',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);
        // product_id: 56
        Product::create([
            'name' => 'Đồng hồ kim loại nam bán chạy Chính hãng POEDAGAR 615 Đồng hồ dây thép không gỉ nam sang trọng, cao cấp Máy Thụy Sĩ',
            'description' => 'Theo dõi cửa hàng chúng tôi để nhận voucher 10% ❗️❗️❗️
                Theo dõi cửa hàng chúng tôi để nhận voucher 10% ❗️❗️❗️
                Đồng hồ POEDAGAR 615 này có vỏ và dây đeo bằng thép không gỉ, được thiết kế với các chi tiết cắt kim cương tinh xảo, vừa mang lại vẻ sang trọng và cao cấp, vừa lấp lánh nổi bật. Đồng hồ có chức năng phát sáng trong không gian tối, chống nước 30M, hiển thị kép cả ngày và tuần. Sử dụng động cơ nhập khẩu, độ chính xác cao, là lựa chọn hàng đầu cho doanh nhân và quà tặng cho nam giới

                ✈️Đơn đặt hàng này được thực hiện bởi SHOPEE, hàng hóa được vận chuyển nhanh chóng từ kho SHOPEE và có thể đến trong 2-3 ngày làm việc
                Chào mừng bạn đến 【POEDAGAR Official Store】
                Chúng tôi cam kết: Đồng hồ chính hãng 100%! Hàng luôn sẵn kho! Ship hành nhanh chóng! Đóng gói đẹp mắt!

                ✅ Theo dõi cửa hàng chúng tôi để nhận voucher người theo dõi.
                ✅ Viết đánh giá và thêm sản phẩm vào mục yêu thích có cơ hội nhận được thêm nhiều xu Shopee!
                ✅ Ship hàng: Đơn hàng sẽ được phát trong 24h
                ✅ Nhận hàng: Sau 2-3 ngày làm việc kể từ khi phát hàng
                ✅ CSKH: Nếu đồng hồ bạn nhận được có bất kỳ vấn đề gì liên quan đến chất lượng, hoặc khiến bạn không hài lòng, chúng tôi cam kết hoàn tiền.
                ✅ Hi vọng bạn có trải nghiệm tốt khi mua hàng tại cửa hàng chúng tôi

                【Thông Tin sản phẩm】 ↓
                Thương hiệu：POEDAGAR 615 
                Loại hình sản phẩm: Đồng hồ thạch anh（pin）
                Chất liệu vỏ: Thép không gỉ
                Chất liệu dây đeo đồng hồ: Dây đeo bằng thép không gỉ
                Thời gian bảo hành: Không có bảo hành
                Chống thấm nước: 30M
                Chất liệu mặt gương: Kính cường lực khoáng
                Khối lượng：114g
                Đường kính mặt đồng hồ：41mm
                Độ dày mặt đồng hồ：11mm
                Chiều rộng dây đeo đồng hồ：20mm
                Kích thước dây đeo đồng hồ：200mm

                Theo dõi chúng tôi để nhận được các cứu đãi:
                ★ Tặng dụng cụ điều chỉnh dây đeo đồng hồ bằng thép không gỉ, bạn có thể tự điều chỉnh độ dài của dây đeo đồng hồ.
                ★ Tặng hộp tinh tế
                ★Tặng Pin dự phòng
                ★Tặng Khăn lau chuyên dụng
                ★ Ưu tiên vận chuyển nhanh

                Những điều cần lưu ý khi đặt hàng:
                1. Chúng tôi là công ty kinh doanh các thương hiệu đồng hồ chính quy. Nếu có bất kỳ vấn đề gì với sản phẩm bạn nhận được, hãy liên hệ với chúng tôi lập tức. Vui lòng không đánh giá tiêu cực, hãy cho chúng tôi cơ hội để xử lý vấn đề và phục vụ bạn tốt nhất. 
                2. Chúng tôi luôn sẵn hàng trong kho, do đó đảm bảo giao hàng nhanh chóng. Trong trường hợp đặc biệt, chúng tôi cũng sẽ giải quyết lập tức từ gia đoạn đầu. Vì vậy, hãy yên tâm đặt hàng, chúng tôi sẽ phục vụ một cách có trách nhiệm. 
                3. Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ với bộ phận CSKH trực tuyến của chúng tôi, chúng tôi sẽ tận tâm phụ vụ bạn.

                Các biện pháp phòng ngừa❌：
                - Tránh va đập, không tiếp xúc với chất ăn mòn, nhiệt độ cao hoặc điện từ trường mạnh. 
                - Tránh xa các dung môi, chất tẩy rửa, chất sát khuẩn công nghiệp, keo dán và sơn.
                - Không bấm nút hẹn giờ khi đồng hồ bị ướt.
                - Không bấm nút hiệu chỉnh thời gian hoặc hẹn giờ khi đồng hồ đang ngập trong nước, ngoại trừ đồng hồ lặn chuyên nghiệp.
                - Tránh xa nước nóng, hơi nước. Vòng cao su chống nước có thể biến dạng do nhiệt độ, ảnh hưởng đến tuổi thọ của đồng hồ.',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);

        // product_id: 57
        Product::create([
            'name' => 'Đồng hồ nam đẹp Crnaira chính hãng, dây thép nhuyễn mặt vạch đơn giản hiện đại',
            'description' => '🏍MIỄN PHÍ VẬN CHUYỂN ĐƠN HÀNG TỪ 50K🏍
                🚀Sản phẩm có sẵn và được giao trong thời gian nhanh nhất!
                🍀Nếu có vấn đề sau khi nhận hàng, giao hàng thiếu, sản phẩm lổi, vận chuyển chậm,.. xin vui lòng liên hệ với chúng tôi bất cứ lúc nào để được hỗ trợ.
                THÔNG TIN CHUNG:
                TÊN SẢN PHẨM: Đồng hồ nam đẹp Crnaira CR06 chính hãng, dây thép nhuyễn
                THÀNH PHẦN:
                - Dây đeo: Kim loại, da
                - Mặt kính : Mặt kính Mineral crytal chống trầy và va đập tốt
                - Khung: Hợp kim
                - Bộ máy: Time Module quartz movement 
                THÔNG SỐ KỸ THUẬT:
                - Kích thước mặt: 40mm
                - Chiều dài dây: 22 cm 
                - Dày: 8mm
                - Chiều rộng dây: 18mm
                - Chức năng: Xem giờ
                - Chống nước: 3ATM ( chống nước sinh hoạt )
                - Màu sắc: kim vàng viền đen, trắng, dây da đen, dây da nâu, kim vàng viền vàng
                - Xuất xứ: Trung Quốc
                THÔNG TIN CẢNH BÁO:
                Không sử dụng đồng hồ tiếp xúc hóa chất, xà phòng, ngâm nước, bơi lội trong thời gian dài
                HƯỚNG DẨN SỬ DỤNG:
                 Bạn rút nhẹ chốt giữ sau đó xoay chốt chỉnh giờ và ấn chốt sát vào để đồng hồ hoạt động
                THÔNG TIN BẢO HÀNH:
                - Bảo hành 6 tháng về máy và 12 tháng về pin
                - Đổi mới trong 7 ngày:
                + Sản phẩm đổi mới chưa qua sử dụng.
                + Lỗi do vận chuyển, sản xuất.
                THỜI GIAN GIAO HÀNG:
                - Giao hàng nhận hàng mới thanh toán.
                - Nội thành Hồ Chí Minh: 1-2 ngày nhận hàng
                - Ngoại thành:
                + Thị trấn, huyện, thị xã: 2-3 ngày nhận hàng
                + Ấp, thôn, xóm: 3-4 ngày nhận hàng.',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);
        // product_id: 58
        Product::create([
            'name' => 'Đồng hồ kỹ thuật số bơi lội chống thấm nước màn hình kép Sanda 6030-2 dành cho nam giới',
            'description' => 'Thương hiệu: Sanda
                Phong cách: giải trí, thể thao, cá tính, thời trang, đa chức năng, sang trọng
                Chức năng: lịch đầy đủ, chống va đập, đồng hồ bấm giờ, ngày tự động, chống thấm nước, thợ lặn, hẹn giờ, đèn nền, múi giờ đa giờ, bơi lội, đồng hồ báo thức
                Phong trào: Phong trào thạch anh nguyên bản
                Các tính năng chính:
                -100% Xác thực, nhãn và chất lượng cao;
                -5ATM / 50m chống thấm nước (hỗ trợ tắm nước lạnh và bơi lội, không hoạt động đồng hồ dưới nước);
                -Thiết Kế đa chức năng
                - Dây đeo đồng hồ chất lượng cao, bộ máy chất lượng cao, vẻ ngoài sang trọng
                Vật liệu nhà ở: ABS
                Chất liệu dây đeo: cao su
                Dây đeo cao su chất lượng cao
                Đặc điểm kỹ thuật (gần đúng):
                -Đường Kính mặt số: 56 mm
                -Độ Dày vỏ: 18 mm
                -Chiều Dài dây: 260 mm
                -Chiều Rộng băng: 27 mm
                Trọng lượng đồng hồ: 72g
                Hệ số chống thấm nước: 50m
                1 x đồng hồ sandal
                1 x Mô tả',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);
        // product_id: 59
        Product::create([
            'name' => 'Đồng hồ nữ OLEVS 9943 chính hãng dây đeo thép không gỉ có lịch phát sáng chống thấm nước',
            'description' => 'Hy vọng bạn có thể có một trải nghiệm mua sắm thú vị
                Sản phẩm OLEVS chính hãng 100% với giao hàng nhanh chóng.
                Chức năng cơ bản của sản phẩm:
                Chống nước: 30-50M
                Chống rỉ sét: sử dụng hàng ngày lâu dài không phai màu
                đặc điểm kỹ thuật sản phẩm
                - Mã sản phẩm: OLEVS 9943 (nữ)
                - Đường kính quay số: 32MM
                - Độ dày vỏ: 10MM
                - Chiều rộng dải: 14MM
                - Chiều dài dây đeo vai: 19CM
                - Trọng lượng đồng hồ: 64g
                Bạn có thể tự hỏi:

                Thời gian giao hàng trọn gói?
                - Vận chuyển trong vòng 24 giờ và thường đến trong vòng 7-9 ngày
                Lo lắng về việc phá vỡ dây đeo?
                - Dây đeo được làm bằng thép không gỉ cao cấp
                Tôi nên làm gì nếu kích thước không phù hợp?
                - Cửa hàng sẽ tặng dụng cụ thay đổi kích thước
                Là gói an toàn và hợp pháp?
                - Tuyệt đối an toàn và hợp pháp
                Lo lắng về việc đồng hồ bị hư hỏng trong quá trình vận chuyển
                - Có một miếng bọt biển trong hộp

                Gói chứa các mục sau:
                1. Thẻ chứng nhận thương hiệu OLEVS * 1
                2. Hộp đồng hồ gốc chính thức * 1
                3. Hướng dẫn sử dụng * 1
                4. Công cụ thay đổi kích thước
                5. Đồng hồ * 1

                ---------------------------------
                Cam kết với khách hàng: ✔

                Nếu đồng hồ không bị hư hỏng nhân tạo, vui lòng liên hệ với chúng tôi để giải quyết cho bạn
                【Chào mừng bạn liên hệ với quan chức OLEVS để giải quyết những nghi ngờ của bạn, sự hỗ trợ của bạn là động lực của chúng tôi. 】',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);
        // product_id: 60
        Product::create([
            'name' => 'Đồng hồ nữ OLEVS 9971 chính hãng dây đeo bằng thép không gỉ có chức năng phát sáng chống thấm nước',
            'description' => 'Hoan nghênh bạn đã đến OLEVS Chính Thức Lưu Trữ
                100% thiệt
                Tặng kèm hộp đựng đồng hồ
                Thời gian giao hàng: trong vòng 24 giờ sau khi đặt hàng (vận chuyển từ Trung Quốc)
                Thời gian đến: 5-15 ngày làm việc sau khi giao hàng (trừ một số ngày lễ đặc biệt)
                Để cung cấp cho bạn dịch vụ chất lượng, nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi, chúng tôi sẽ giúp bạn
                Mô tả Sản phẩm:
                -Thương hiệu: OLEVS
                -Phong cách: thời trang/bình thường/kinh doanh
                -Mô hình: 9971
                -Chuyển động: thạch anh nhập khẩu
                -Màu sắc: như hình
                - Chất liệu gương: kính tráng men độ cứng cao
                -Chất liệu dây đeo: thép không gỉ
                -Chất liệu vỏ: thép không gỉ
                - Độ sâu chống thấm nước: 3ATM/30 mét (không hỗ trợ bơi lội và tắm vòi sen)
                - Trọng lượng đồng hồ: 43G
                - Đường kính vỏ: 30MM
                - Độ dày vỏ: 8MM
                -Chiều rộng dây đeo: 9.5MM
                - Chiều dài dây đeo vai: 200MM
                Nhắc nhở: Tất cả các kích thước được đo thủ công, có sai số hợp lý, vui lòng tham khảo sản phẩm thực tế.
                tính năng:
                chức năng phát sáng
                vòng đeo tay sang trọng
                Chống nước đến 30 mét
                Có gì trong gói:
                đồng hồ * 1
                hộp quà tặng * 1
                Hướng Dẫn Sử Dụng * 1
                Các biện pháp phòng ngừa
                1. Không nhấn bất kỳ nút nào dưới nước. Cũng tránh sử dụng nó ở nhiệt độ quá nóng hoặc quá lạnh.
                2. Nếu bạn tìm thấy sương mù hoặc giọt nước trên bề mặt, vui lòng liên hệ với chúng tôi ngay lập tức.
                3. Tiếp xúc nhiều với nước sẽ làm giảm tuổi thọ của đồng hồ
                4. Nên dùng khăn mềm lau dây đeo để kéo dài tuổi thọ.
                Phục vụ:
                Chúng tôi là nhà sản xuất ban đầu tại Trung Quốc. Tất cả các sản phẩm là 100%
                Chúng tôi cam kết cung cấp cho bạn những sản phẩm có chất lượng cao và giá cả hợp lý.
                Tất nhiên là dành riêng để cung cấp trải nghiệm khách hàng tuyệt vời! Sự hài lòng của khách hàng là theo đuổi quan trọng của chúng tôi như mọi khi.
                Mọi người có thể tự tin mua hàng và tận hưởng dịch vụ khách hàng tuyệt vời của chúng tôi để có trải nghiệm mua sắm tốt.',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 5,
        ]);
        // product_id: 61
        Product::create([
            'name' => 'Dây chuyền kim cương Moissanite 5 ly kiểm định GRA, bạc xi bạch kim LAVESTA KC42 mặt trăng mang vẻ đẹp cao sang, may mắn',
            'description' => 'THÔNG TIN SẢN PHẨM
                - Xuất xứ dây chuyền bạc nữ: Việt Nam
                - Chất liệu vòng cổ: Bạc xi bạch kim - Bảo hành đánh sáng trọn đời
                - Đá chủ: Kim cương nhân tạo Moissanite 5 ly có kiểu cắt giác sang trọng chuẩn kim cương: 8 trái tim và 8 mũi tên mang đến vẻ đẹp ĐẲNG CẤP và TINH TẾ, rất thích hợp để làm quà tặng cầu hôn, quà tặng bạn gái.
                + Có đặc tính GIỐNG HỆT kim cương thiên nhiên lên đến 90%
                + Có hiệu ứng với bút thử kim cương lên vạch ĐỎ
                + Có độ cứng 9,5 so với kim cương là 10
                + Có chất lượng nước: D
                + Có độ lửa rất mạnh - HƠN cả kim cương thiên nhiên
                - 1 sản phẩm khách nhận được khi mua hàng có đầy đủ : THẺ NHỰA và GIẤY KIỂM ĐỊNH GRA kim cương nhân tạo (Có mã số cạnh trên viên, có thể check mã trên web)
                CHƯƠNG TRÌNH HỖ TRỢ VẬN CHUYỂN
                Shop có chương trình FREESHIP EXTRA, khi đặt hàng quý khách nên ÁP MÃ MIỄN PHÍ VẬN CHUYỂN để được ưu đãi giảm hoặc miễn phí vận chuyển:
                - Giảm 15k phí vận chuyển đối với đơn trên 50k
                - Giảm đến 70k phí vận chuyển cho các đơn hàng từ 300k
                LAVESTA CAM KẾT
                - 100% sản phẩm dây chuyền là bạc nguyên chất, đá chủ là Moissanite - Không đúng ĐỀN gấp 10 lần giá trị
                - Cam kết đá KHÔNG đục mờ theo thời gian
                - Giá bán TỐT NHẤT - Chất lượng CAO NHẤT
                - Sản phẩm được kiểm tra cẩn thận, kĩ càng trước khi được giao cho Quý khách
                - Hoàn tiền nếu sản phẩm không đúng với mô tả
                - Giao hàng toàn quốc, thanh toán khi nhận hàng
                - Hỗ trợ đổi trả hàng 7 ngày theo quy định của Shopee
                - Bảo hành TRỌN ĐỜI
                Ngoài ra, LAVESTA xin chia sẻ một số tips hữu dụng để làm sáng trang sức bạc tại nhà:
                - Chà nhẹ kem đánh răng, nước rửa bát hoặc nước chanh lên sản phẩm bạc, sau đó rửa sạch bằng nước ấm rồi lau khô
                - Dùng khăn lau bạc chuyên dụng lau nhẹ nhàng bề mặt trang sức mỗi ngày
                Lưu ý: Do điều kiện ánh sáng, nên màu sắc sản phẩm có thể chênh lệch ko đáng kể',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);
        // product_id: 62
        Product::create([
            'name' => 'Vòng cổ MAYEBE LAVEND Mạ Bạc Nhiều Lớp unisex y2k Phong Cách hip hop',
            'description' => 'Thương hiệu: Mayebe Lavendar Jewelry 
                Quy trình xử lý: mạ điện
                Loại: Vòng cổ
                Chất liệu: hợp kim / thép titan
                Phong cách: Hip hop
                Danh sách sản phẩm: 1 ” vòng cổ',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);
        // product_id: 63
        Product::create([
            'name' => 'Dây chuyền bạc S925 cỏ 4 lá Asimi, Dây chuyền may mắn dành cho nữ Lucky Leaf DC36',
            'description' => '• Thương hiệu: Asimi Jewelry
                • Chất liệu: Bạc Ý Cao Cấp S925 (92.5% bạc & 7.5% hợp kim làm sáng), không xi mạ pha tạp, không han gỉ, không dị ứng, dễ làm sáng.
                • Kiểu dáng: Loại dây xích mảnh, mặt được thiết kế hình cỏ 4 lá và đính kèm đá Cz nhỏ
                • Kích thước dây: Dây chuyền bạc dài 40+ 5cm 
                • Sản xuất: Trực tiếp tại Việt Nam
                • Quy cách sản phẩm: Đi kèm hộp đựng trang sức cao cấp và khăn lau bạc chuyên dụng.
                Dây chuyền bạc nữ, mang đến những đặc điểm nổi bật sau:
                • Hoàn thiện với chất lượng cao, được sản xuất trực tiếp tại Việt Nam.
                • Chất liệu bạc thật 100%, không chứa tạp chất, đảm bảo độ bền màu và an toàn cho làn da.
                • Được kèm theo bộ quà tặng bao gồm khăn lau bạc và hộp giấy cao cấp khi mua bất kỳ loại dây chuyền nào tại Asimi.',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);
        // product_id: 64
        Product::create([
            'name' => 'Dây chuyền kim cương Moissanite 0,25 Carat Caterina Diamond Sterling silver round simulated DN003',
            'description' => 'I/THÔNG SỐ SẢN PHẨM.
            - Xuất xứ nhẫn bạc nữ: Việt Nam
            - Chất liệu nhẫn: Bạc Ý cao cấp - Bảo hành đánh sáng trọn đời
            - Đá chủ: Kim cương nhân tạo Moissanite có kiểu cắt giác sang trọng chuẩn kim cương:  mang đến vẻ đẹp ĐẲNG CẤP và TINH TẾ.
            + Có đặc tính GIỐNG HỆT kim cương thiên nhiên lên đến 90%
            + Có hiệu ứng với bút thử kim cương lên vạch ĐỎ
            + Có độ cứng 9,5 so với kim cương là 10
            + Có chất lượng nước: D
            + Có độ lửa rất mạnh - HƠN cả kim cương thiên nhiên
            - 1 sản phẩm khách nhận được khi mua hàng có đầy đủ : THẺ NHỰA và GIẤY KIỂM ĐỊNH GRA kim cương nhân tạo
            - SKU:DN003
            - Đá chủ : 4 Ly
            - Chiều dài 40+5cm
            - Thương hiệu: Caterina Diamond
            - Màu sắc: Bạc.
            - Chất liệu: Bạc Ý, Kim cương nhân tạo Moissanite
            II/ Bộ sản phẩm nhẫn Caterina Diamond gồm:
            + Giấy kiểm định GRA
            + Dây chuyền Caterina Diamond
            + Hộp đựng dây chuyền Caterina Diamond
            + Túi in logo Caterina Diamond
            III/ Chính sách bảo hành của Caterina Diamond
            - Caterina Diamond Hỗ trợ đổi size nhẫn trong 3 ngày tính từ ngày nhận hàng (với điều kiện sản phẩm còn mới không bị trầy xước hư hỏng).
            - Caterina Diamond Đổi mới sản phẩm trong 7 ngày tính từ ngày nhận hàng nếu sản phẩm lỗi từ nhà sản xuất. 
            - Caterina Diamond hỗ trợ đổi trả hàng 15 ngày theo quy định của Shopee
            - Caterina Diamond chịu tránh nhiệm bảo hành sản phẩm thương Caterina Diamond TRỌN ĐỜI
            IV/ Hướng dẫn bảo quản
            - Không để sản phẩm tiếp xúc với hóa chất tẩy, rửa qua bằng nước và lau khô nếu có tiếp xúc với hóa chất.
            - Không để các vật nặng đè lên sản phẩm.
            - Làm sạch sản phẩm bằng vải mềm hoặc bàn chải mềm.
            - Dùng cồn 70% để làm sạch và sáng sản phẩm.
            Lưu ý: Do điều kiện ánh sáng, nên màu sắc sản phẩm có thể chênh lệch ko đáng kể
            Cảm ơn quý khách đã tin tưởng và ủng hộ gian hàng Caterina Diamond.',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);
        // product_id: 65
        Product::create([
            'name' => 'Nhẫn đôi bạc nam nữ s925, Quà Valentine ý nghĩa, Nhẫn cặp đôi cánh thiên thần đính đá CZ - ND2915',
            'description' => '1. THÔNG TIN SẢN PHẨM
                - Thương hiệu: Bảo Ngọc Jewelry
                - Chất liệu: Bạc S925
                - Chiều dài: Nhẫn free size nên các bạn không phải chọn size đâu nha
                - Màu sắc: Màu trắng sáng lấp lánh
                - Sản phẩm mới, đảm bảo về chất lượng, độ bóng sáng
                - Kiểu dáng thiết kế tinh tế, sắc sảo, gia công tỉ mỉ, mẫu mới nhất theo Trend
                - Xuất xứ: mẫu được sản xuất tại Việt Nam hoặc Nhập khẩu
                - Tặng hộp đẹp (Có thể làm quà tặng)
                - Giao hàng toàn quốc
                2. HƯỚNG DẪN SỬ DỤNG SẢN PHẨM
                - Không nên đeo trang sức 24/24, HÃY tháo trang sức lúc chơi thể thao, tắm biển, bơi,... để tránh bạc xước và xỉn màu
                - Khi đeo trang sức bạc KHÔNG NÊN tiếp xúc với các chất hóa học tẩy rửa thường xuyên để tránh khó vệ sinh
                - Thường xuyên vệ sinh trang sức bạc bằng khăn làm sáng, que làm sáng (phụ kiện vệ sinh sản phẩm của shop) nên vệ sinh trang sức bạc thường xuyên bằng nước rửa bạc 1-3 tháng/lần để đảm bảo sản phẩm luôn được sáng bóng
                - Khi không đeo NÊN bảo quản nơi khô ráo, tránh ánh nắng trực tiếp, nơi có nhiệt độ cao hoặc ẩm thấp
                - NÊN để trang sức bạc trong túi zip, thêm 1 miếng bông gòn nhỏ để hút ẩm giúp bảo quản bông tai bạc tốt hơn
                3. BẢO NGỌC JEWELRY CAM KẾT
                - Sản phẩm 100% giống mô tả
                - Đảm bảo chất lượng và chất liệu bạc 100%
                - Sản phẩm được kiểm tra cẩn thận, kĩ càng trước khi được giao cho Quý khách
                - Sản phẩm có sẵn, giao ngay sau khi nhận đơn
                - Hoàn tiền nếu sản phẩm không đúng với mô tả
                - Giao hàng toàn quốc, thanh toán khi nhận hàng
                - Hỗ trợ đổi trả theo quy định của Shopee
                4. CHÍNH SÁCH BẢO HÀNH
                - Bảo hành làm sáng đánh bóng trọn đời sản phẩm
                - Sản phẩm Quý khách nhận sau khi mua sắm nếu có bất cứ vấn đề gì cần giải đáp, hỗ trợ hãy chat ngay cho shop để được nhân viên chăm sóc nhanh nhất
                - Hỗ trợ đổi trả miễn phí trong vòng 07 ngày (theo chính sách của Shopee)
                a. Điều kiện áp dụng:
                + Trang sức bạc vẫn còn mới, chưa qua sử dụng 
                + Trang sức bị lỗi hoặc hư hỏng do vận chuyển hoặc do nhà sản xuất 
                b. Trường hợp được chấp nhận: 
                + Trang sức bạc không đúng size, kiểu dáng như quý khách đặt hàng 
                + Không đủ số lượng trang sức như trong đơn hàng 
                c. Trường hợp không đủ điều kiện áp dụng chính sách: 
                + Quá 07 ngày kể từ khi quý khách nhận trang sức bạc
                + Gửi lại hàng không đúng mẫu, không phải trang sức bạc của Bảo Ngọc Jewelry
                + Không thích, không hợp, đặt nhầm trang sức bạc, nhầm màu trang sức bạc
                Do màn hình và điều kiện ánh sáng khác nhau, màu sắc thực tế của trang sức có thể chênh lệch khoảng 3-5%
                *Lưu ý: Quý khách vui lòng quay lại video mở sản phẩm để làm cơ sở giải quyết khiếu nại đổi/trả khi có vấn đề phát sinh liên quan đến sản phẩm
                ',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);

        // product_id: 66
        Product::create([
            'name' => 'Nhẫn đôi nam nữ freesize bạc Ý 925 nhẫn cặp Solie tự chỉnh cỡ-Aura Silver-ND11',
            'description' => '',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);
        // product_id: 67
        Product::create([
            'name' => 'Lắc tay bạc mặt đá cỏ 4 lá Asimi, Dây chuyền bạc ta S925 sáng bền màu xi bạch kim đơn giản Lucky Line LT17',
            'description' => 'Lắc tay bạc mặt đá cỏ 4 lá Asimi, Dây chuyền bạc ta S925 sáng bền màu xi bạch kim đơn giản Lucky Line LT17:
                 • Thương hiệu: Asimi Jewelry
                 • Chất liệu: Bạc Ta Cao Cấp (92.5% bạc & 7.5% hợp kim làm sáng), xi mạ bạc kim sáng bền, không xi mạ pha tạp, không han gỉ, không dị ứng, dễ làm sáng.
                 • Kiểu dáng: lắc tay mặt cỏ 4 lá màu đen - đính kèm 5 chiếc lá màu đen
                 • Kích thước dây: Có thể điều chỉnh từ 15,5 + 2,5cm
                 • Sản xuất: Trực tiếp tại Việt Nam
                 • Quy cách sản phẩm: Đi kèm hộp trang sức sang trọng bằng giấy & khăn lau bạc Asimi đơn giản (miễn phí). Quý khách hàng có thể đặt mua thêm hộp trang sức cao cấp hơn.
                Lắc chân bạc nữ, mang đến những đặc điểm nổi bật sau:
                 • Hoàn thiện với chất lượng cao, được sản xuất trực tiếp tại Việt Nam.
                 • Chất liệu bạc thật 100%, không chứa tạp chất, đảm bảo độ bền màu và an toàn cho làn da.
                 • Được kèm theo bộ quà tặng bao gồm khăn lau bạc và hộp da cao cấp khi mua bất kỳ loại dây chuyền nào tại Asimi.
                Hướng dẫn sử dụng và bảo quản lắc chân ASIMI như sau:
                 • Tránh tiếp xúc trang sức với hoá chất, chất tẩy rửa mạnh. Để làm sáng trang sức, bạn có thể sử dụng kem đánh răng, nước rửa bát, hoặc nước chanh.
                 • Thường xuyên vệ sinh trang sức bằng cách sử dụng khăn làm sáng mà Asimi tặng kèm. Có thể vệ sinh dây chuyền bạc bằng nước rửa bạc 1-3 tháng/lần để bảo đảm trang sức luôn giữ được độ sáng bóng.
                 • Khi không đeo, lưu trữ trang sức ở nơi khô ráo, tránh ánh nắng trực tiếp, và tránh môi trường có nhiệt độ cao hoặc ẩm.
                 • Để tăng cường bảo quản, nên đặt trang sức vào túi zip và thêm một miếng bông gòn nhỏ để hút ẩm. Điều này giúp bảo quản sản phẩm một cách tốt nhất.
                Asimi Jewelry cam kết và đảm bảo đối với bạn:
                 • Sản phẩm đảm bảo đúng 100% so với mô tả.
                 • 1 đổi 1 ttrong vòng 30 ngày nếu sản phẩm bị lỗi
                 • Chất lượng và chất liệu bạc được cam kết đạt 100%.
                 • Sản phẩm trải qua quá trình kiểm tra cẩn thận và chặt chẽ trước khi giao đến Quý khách.
                 • Hàng luôn sẵn có, giao hàng ngay sau khi nhận đơn đặt hàng.
                 • Đảm bảo hoàn tiền nếu sản phẩm không khớp với mô tả.
                 • Dịch vụ giao hàng toàn quốc, thanh toán khi nhận hàng.
                ',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);
        // product_id: 68
        Product::create([
            'name' => 'Lắc tay bạc S925 mặt trăng đá moonstone Asimi, Lắc tay bạc S925 nữ cao cấp nữ tính MoonLine LT18',
            'description' => 'Lắc tay bạc S925 mặt trăng đá moonstone Asimi, Lắc tay bạc S925 nữ cao cấp nữ tính MoonLine LT18:.
                • Thương hiệu: Asimi Jewelr.
                • Chất liệu: Bạc Ý Cao Cấp S925 (92.5% bạc & 7.5% hợp k.m làm sáng), không xi mạ pha tạp, không han gỉ, không dị ứng, dễ làm sáng..
                • Kiểu dáng: lắc tay hình mặt trăng đính kèm đá moonsto.e.
                • Kích thước vòng tay: lắc tay bạc dài 15,5 + 2,5cm, có.thể điều chỉnh..
                • Sản xuất: Trực tiếp tại Việt Na.
                • Quy cách sản phẩm: Đi kèm hộp trang sức sang trọng bằ.g giấy & khăn lau bạc Asimi đơn giản (miễn phí). Quý khách hàng có thể đặt mua thêm hộp trang sức cao cấp hơn..
                Lắc tay bạc nữ, mang đến những đặc điểm nổi bật sau.
                • Hoàn thiện với chất lượng cao, được sản xuất trực tiế. tại Việt Nam..
                • Chất liệu bạc thật 100%, không chứa tạp chất, đảm bảo.độ bền màu và an toàn cho làn da..
                • Được kèm theo bộ quà tặng bao gồm khăn lau bạc và hộp.da cao cấp khi mua bất kỳ loại dây chuyền nào tại Asimi..
                Hướng dẫn sử dụng và bảo quản lắc tay ASIMI như sau.
                • Tránh tiếp xúc trang sức với hoá chất, chất tẩy rửa m.nh. Để làm sáng trang sức, bạn có thể sử dụng kem đánh răng, nước rửa bát, hoặc nước chanh..
                • Thường xuyên vệ sinh trang sức bằng cách sử dụng khăn.làm sáng mà Asimi tặng kèm. Có thể vệ sinh dây chuyền bạc bằng nước rửa bạc 1-3 tháng/lần để bảo đảm trang sức luôn giữ được độ sáng bóng..
                • Khi không đeo, lưu trữ trang sức ở nơi khô ráo, tránh.ánh nắng trực tiếp, và tránh môi trường có nhiệt độ cao hoặc ẩm..
                • Để tăng cường bảo quản, nên đặt trang sức vào túi zip.và thêm một miếng bông gòn nhỏ để hút ẩm. Điều này giúp bảo quản sản phẩm một cách tốt nhất..
                Asimi Jewelry cam kết và đảm bảo đối với bạn.
                • Sản phẩm đảm bảo đúng 100% so với mô tả.
                • 1 đổi 1 ttrong vòng 30 ngày nếu sản phẩm bị lỗ.
                • Chất lượng và chất liệu bạc được cam kết đạt 100%.
                • Sản phẩm trải qua quá trình kiểm tra cẩn thận và chặt.chẽ trước khi giao đến Quý khách..
                • Hàng luôn sẵn có, giao hàng ngay sau khi nhận đơn đặt.hàng..
                • Đảm bảo hoàn tiền nếu sản phẩm không khớp với mô tả.
                • Dịch vụ giao hàng toàn quốc, thanh toán khi nhận hàng.',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);
        // product_id: 69
        Product::create([
            'name' => 'Vòng tay MAYEBE LAVEND mạ bạc phong cách Hàn Quốc đơn giản thời trang nhiều mẫu tùy chọn',
            'description' => 'Thương hiệu: Mayebe Lavendar Jewelry 
                Loại: Vòng đeo tay
                Phong cách: Unisex
                Chất liệu: Hợp kim / Titan
                Phong cách: Hàn Quốc
                Danh sách sản phẩm: 1 ” Vòng đeo tay
                ',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);
        // product_id: 70
        Product::create([
            'name' => 'Khuyên tai nữ kim cương Moissanite 4mm Caterina Diamond Series Romantic Hall Earrings DE001',
            'description' => 'I/THÔNG SỐ SẢN PHẨM.
                - Xuất xứ nhẫn bạc nữ: Việt Nam
                - Chất liệu nhẫn: Bạc Ý cao cấp - Bảo hành đánh sáng trọn đời
                - Đá chủ: Kim cương nhân tạo Moissanite có kiểu cắt giác sang trọng chuẩn kim cương:  mang đến vẻ đẹp ĐẲNG CẤP và TINH TẾ.
                + Có đặc tính GIỐNG HỆT kim cương thiên nhiên lên đến 90%
                + Có hiệu ứng với bút thử kim cương lên vạch ĐỎ
                + Có độ cứng 9,5 so với kim cương là 10
                + Có chất lượng nước: D
                + Có độ lửa rất mạnh - HƠN cả kim cương thiên nhiên
                - 1 sản phẩm khách nhận được khi mua hàng có đầy đủ : THẺ NHỰA và GIẤY KIỂM ĐỊNH GRA kim cương nhân tạo
                - SKU:DE001
                - Đá chủ : 4 Ly
                - Thương hiệu: Caterina Diamond
                - Màu sắc: Bạc.
                - Chất liệu: Bạc Ý, Kim cương nhân tạo Moissanite
                II/ Bộ sản phẩm nhẫn Caterina Diamond gồm:
                + Giấy kiểm định GRA
                + Nhẫn Caterina Diamond
                + Hộp đựng Caterina Diamond
                + Túi in logo Caterina Diamond
                III/ Chính sách bảo hành của Caterina Diamond
                - Caterina Diamond Hỗ trợ đổi size nhẫn trong 3 ngày tính từ ngày nhận hàng (với điều kiện sản phẩm còn mới không bị trầy xước hư hỏng).
                - Caterina Diamond Đổi mới sản phẩm trong 7 ngày tính từ ngày nhận hàng nếu sản phẩm lỗi từ nhà sản xuất. 
                - Caterina Diamond hỗ trợ đổi trả hàng 15 ngày theo quy định của Shopee
                - Caterina Diamond chịu tránh nhiệm bảo hành sản phẩm thương Caterina Diamond TRỌN ĐỜI
                IV/ Hướng dẫn bảo quản
                - Không để sản phẩm tiếp xúc với hóa chất tẩy, rửa qua bằng nước và lau khô nếu có tiếp xúc với hóa chất.
                - Không để các vật nặng đè lên sản phẩm.
                - Làm sạch sản phẩm bằng vải mềm hoặc bàn chải mềm.
                - Dùng cồn 70% để làm sạch và sáng sản phẩm.
                Lưu ý: Do điều kiện ánh sáng, nên màu sắc sản phẩm có thể chênh lệch ko đáng kể',
            'status' => 'active',
            'seller_id' => 2,
            'category_id' => 9,
        ]);
        // product_id: 71
        Product::create([
            'name' => 'Dán ppf IP chống vân tay IP 15 pro max 16 15 plus 14 pro max 13 12 promax',
            'description' => 'HÀNG TỐT GIÁ CẠNH TRANH NÊN KHÔNG DÁN VIỀN LOA  BẠN NHÉ, CHỈ CÓ DÁN MẶT LƯNG Ạ
                Dán ppf chống vân tay 16 pro max 15 pro max 14 pro max 13 12 promax 11 promax xs xr max 7 8 plus 6 6s Plus Xsmax Dán Lưng IP
                ✅✅: Lưu ý: Mẫu mã từng đợt hàng sẽ khác nhau, nhưng chất lượng sản phẩm như nhau nha các bạn!!!
                (Tùy đợt nhập hàng mà sản phẩm sẽ có logo và hình dạng khác nhau, nên mong quý khách thông cảm bỏ qua ạ)
                Dán PPF có khả năng chống trầy xước, khả năng tự phục hồi vết xước nhẹ (dùng bật lửa hơ xung quanh chỗ xước thì vết xước sẽ tự phục hồi lại), làm giảm khả năng trơn trượt, chống oxy hóa vỏ máy và cạnh viền.
                - Skin có cấu tạo 4 lớp: 2 Lớp đế dán bên dưới, lớp skin trong suốt ở giữa và lớp nilông mỏng bảo vệ bên ngoài. Đảm bảo sản phẩm đến tay khách hàng sẽ còn nguyên mới, không bị trầy xước trong quá trình vận chuyển. Quý khách khi dán đừng quên lột bỏ miếng ni lông trên cùng đi nhé.
                - Skin PPF được thiết kế thông minh để bất cứ một khách hàng nào cũng có thể dán được. Những khách hàng chưa có tay nghề vẫn có thể dán được. Skin sẽ có phần hở đối với một số vị trí trên máy. Lí do là vì các nút và dãy loa thường là các vị trí khách hàng dán khó chính xác nên sản phẩm được thiết kế để bất cứ khách hàng nào cũng có thể dán được.
                - Skin PPF trong suốt 7 màu hoặc Chống vân tay Nhám có cấu tạo 3 lớp: Lớp đế, lớp skin trong suốt ở giữa và lớp nilông mỏng bảo vệ bên ngoài. Đảm bảo sản phẩm đến tay khách hàng sẽ còn nguyên mới, không bị trầy xước trong quá trình vận chuyển. Quý khách khi dán nhớ lột bỏ miếng ni lông đi nhé.
                - Skin trong suốt là skin dán có độ khó nhất định. Đối với bạn nào có tay nghề, khéo tay thì có thể mua về tự dán, có sẵn 1 máy sấy càng tốt. Còn đối với những bạn không khéo tay thì nên đem ra thợ nhờ họ dán giúp shop nhé. Shop bán với uy tín đi đầu nên sẽ tư vấn thật tình và khuyên chân thành. Bạn nào không dán khéo cũng đừng buồn và cố gắng nhen!
                👉HƯỚNG DẪN DÁN:
                ✅Bước 1: lau sạch lưng máy và viền máy
                ✅Bước 2: đặt miếng dán vào lưng máy, so cân đít máy và camera.
                ✅Bước 3: bóc miếng dán số 1. Vừa bóc vừa lấy tấm card visit hoặc thẻ ATM miết theo
                ✅Bước 3: bóc tiếp miếng số 2, rồi đến miếng số 3.
                ✅ Bước 4: bóc tiếp lớp nilong mỏng trên bề mặt lưng máy( còn 1 lớp nilong mỏng nữa không đánh số )
                ✅Bước 5: vuốt 4 mép viền máy vào, bạn có thể dùng máy sấy hoặc bật lửa hơ quanh các mép viền cho thêm độ dính chắc.',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 4,
        ]);
        // product_id: 72
        Product::create([
            'name' => 'Ốp lưng labubu siêu cute phù hợp cho các dòng iphone 16, 15, 14, 13, 12',
            'description' => '💕Chào mừng đến với cửa hàng 💕
                Cod Avalibale, tất cả hàng tồn kho 🤗
                Loại: Vỏ điện thoại
                Chất liệu: Silicone
                Màu sắc: Như PIC
                ⭐ Chức năng: Chống bụi bẩn
                ⭐ Chức năng: Chống nổ
                ⭐ Chức năng: Ngăn ngừa rơi
                🤗 Dịch vụ
                Sau khi nhận được sản phẩm, vui lòng thể hiện khí chất thanh lịch, xinh đẹp và đẹp trai của bạn bên dưới sản phẩm và đánh giá năm sao cho chúng tôi. Chúng tôi dựa vào sự hài lòng của khách hàng để đạt được thành công. Do đó, phản hồi tích cực của bạn và DSR 5 điểm là rất quan trọng đối với chúng tôi. Nếu bạn hài lòng với dự án của chúng tôi, vui lòng dành một phút để lại đánh giá năm sao của bạn. Cảm ơn bạn.
                ',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 4,
        ]);
        // product_id: 73
        Product::create([
            'name' => 'giá đỡ điện thoại YF-285 chống rung có mái che,khoá chống trộm siêu chắc',
            'description' => 'Thiết kế bóng xoay 360° u00b0: Giá đỡ điện thoại này có thiết kế bóng sáng tạo cho phép xoay 360° u00b0 hoàn toàn theo chiều ngang. Điều chỉnh góc để xem tối ưu thật dễ dàng, đảm bảo hoạt động nhanh chóng và liền mạch.
                Đệm bảo vệ nâng cao: Được trang bị các miếng bảo vệ dày để ngăn chặn sự can thiệp cho máy ảnh, giá đỡ này bao gồm các phần nâng cao để vừa vặn an toàn. Lớp cao su mềm bên ngoài đệm hiệu quả các cú sốc và rung động.
                Tùy chọn khả năng tương thích rộng: Sản phẩm này được thiết kế để hoạt động với nhiều loại máy ảnh nhỏ và giá đỡ điện thoại có đầu bị, cung cấp khả năng tương thích trên phạm vi rộng khiến nó trở thành một lựa chọn tuyệt vời.
                Tính năng Chìa khóa Chống Trộm Đặc biệt: Chân đế này được
                trang bị chìa khóa chống trộm độc đáo. Sau khi cố định các vít, bạn có thể điều chỉnh góc độ khi cần thiết, đảm bảo chân đế được giữ cố định chắc chắn và không dễ dàng tháo rời. Quy trình lắp đặt đơn giản: Việc lắp đặt giá đỡ điện thoại này cực kỳ đơn giản - u2014 chỉ cần vặn chặt các vít để thiết lập. Không cần lắp ráp phức tạp, cho phép bạn bắt đầu ngay lập
                tức.
                Mô tả: Tên: Giá đỡ điện thoại xe máy Chất liệu: PA6 + GF +
                SiliconeMàu sắc: Đen Cách sử dụng: Thích hợp cho điện thoại thông minh và máy ảnh nhỏ; giá đỡ đi xe đạp Phạm vi ứng dụng: Xe máy và xe đạp Danh sách đóng gói: 1 x giá đỡ điện thoại',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 4,
        ]);
        // product_id: 74
        Product::create([
            'name' => 'Ốp Lưng iPhone Laser Mạ Điện In Hình Bé Ba Baby Three Hot Trend Cho Iphone',
            'description' => 'Thông tin sản phẩm: 
                ▶️ Ốp lưng được đóng gói bằng túi nilon thiết kế đẹp.
                ▶️ Mực in chất lượng cao,sắc nét, không phai màu, không gây hại cho da,
                ▶️ Hình ảnh thiết kế đẹp, phong cách, trẻ trung.
                ▶️ Công dụng: thay đổi màu sắc cho điện thoại, giữ điện thoại chắc chắn trên tay, an toàn chống trầy xước,  bảo vệ chiếc ốp khỏi va đập.
                
                Hướng dẫn sử dụng sản phẩm Ốp Lưng iPhone Laser Mạ Điện In Hình Bé Ba Baby Three Hot Trend Cho Iphone XS Max 11 12 13 14 15 16 Pro Max Plus
                ▶️ Không nên để ốp lưng, bao da dưới sàn nhà. 
                ▶️ Để nơi thoáng mát sẽ giúp bảo quản.
                ▶️ Để xa tầm tay trẻ em.
                
                💟ArsCStore Xin Đảm Bảo : 
                ▶️ Hàng đảm bảo y hình, có thể chênh lệch màu đôi chút do ánh sáng
                ▶️ Hàng luôn sẵn kho.
                ▶️ Giá luôn tốt tuyệt đối
                ▶️ FreeShip toàn quốc cho đơn hàng từ 50k ( Tối Đa 30K ) - nhập mã Freeship của shopee vào nhé 
                ▶️ Mang lại cho quý khách những sản phẩm tốt nhất, đẹp nhất.
                ▶️ Nếu hàng bị lỗi do sản xuất. ArsC Store cam đoan sẽ Hoàn tiền 100% hoặc gửi lại sản mới thay thế cho quý khách.
                ▶️Thương hiệu tạo niềm tin !
                
                💟Phản hồi :
                1 Xin vui lòng để lại cho chúng tôi một phản hồi tích cực (5 sao), nếu bạn hài lòng với các mặt hàng của chúng tôi. 
                2 Vui lòng liên hệ với chúng tôi trước khi để lại bất kỳ phản hồi tiêu cực hoặc mở một tranh chấp trên Shopee. 
                3 Xin vui lòng cho chúng tôi cơ hội để giải quyết bất kỳ vấn đề.
                ',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 4,
        ]);
        // product_id: 75
        Product::create([
            'name' => 'Ốp lưng samsung S23 Ultra s23 S22 S20+ S20 Fe S21 S21+ S21 Fe Note 9 S9+ S10 5G S10+ 10 10+ Note 20 trong suốt [Ốp-CS]',
            'description' => '>>> PKCT CAM KẾT:
                + Sản phẩm luôn có sẵn tại shop, không để cho các bạn chờ đợi lâu.
                + Bảo hành vận chuyển toàn diện để đảm bảo sản phẩm đến tay các bạn luôn nguyên vẹn. Trường hợp phát sinh bể vỡ hay lỗi trong QUÁ TRÌNH VẬN CHUYỂN, shop sẽ gửi lại sản phẩm khác Free và hỗ trợ phí vận chuyển 100% (Nếu quý khách cung cấp video mở hàng).
                + Luôn luôn giải đáp các thắc mắc cho Quý khách kịp thời, chính xác, nhiệt tình và vui vẻ.
                >>> Mô tả sản phẩm:
                Ốp chống sốc không chỉ bảo vệ điện thoại khỏi trầy xước mặt lưng mà còn bảo vệ máy bạn khỏi móp viền, cong vênh, hạn chế lực sốc khi va đập gây chập máy.
                Bạn thích công dụng chống sốc, nhưng lại không thích những mẫu quá hầm hố hay bít bùng thì ốp này sẽ là lựa chọn tuyệt vời cho bạn.
                – Mặt lưng mỏng và trong suốt tuyệt đối không nổi các chấm dot như ốp dẻo trong bình thường khác, không ố vàng – Chất liệu kết hợp vừa nhựa cứng vừa nhựa dẻo nên viền khá mềm dễ tháo lắp, không trầy máy, nhưng cũng đủ độ cứng để bảo vệ máy khỏi móp méo
                – 4 góc thiết kế bong bóng bo thông minh, giúp giảm sốc hiệu quả – Hàng chính hãng bảo đảm sự hài lòng tuyệt đối 
                - Bảo vệ điện thoại siêu dẻo và cực mỏng
                - Ốp lưng ôm sát máy dễ dàng thao tác các nút nguồn và tăng giảm âm lượng nhẹ nhàng.
                - Bảo vệ máy khỏi bụi bần và trầy xước
                - Sản phẩm được thiết kế đơn giản, mỏng gọn là sự lựa chọn của mọi lứa tuổi.
                Dòng máy tương thích: samsung s8, samsung s9, samsung s8+, samsung s9+ , note 10, note 10plus, note 20, note 20 ultra, S20, S20 Ultra',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 4,
        ]);
        // product_id: 76
        Product::create([
            'name' => 'Laptop Asus Vivobook 14 OLED A1405VA-KM095W i5-13500H | 16GB | 512GB | Intel Iris Xe | 14 inch 2.8K OLED | Win 11 | Bạc',
            'description' => 'THÔNG SỐ KỸ THUẬT CHÍNH
                CPU Intel Core i5-13500H 2.6GHz up to 4.7GHz 18MB
                •	RAM  16GB (8GB Onboard + 8GB) DDR4 3200MHz (1x SO-DIMM socket, up to 16GB SDRAM)
                •	Ổ cứng   512GB M.2 NVMe™ PCIe® 3.0 SSD (1 slot, support M.2 2280 PCIe 3.0x4)
                •	Card đồ họa  Intel® Iris Xe Graphics
                •	Màn hình	14" 2.8K (2880 x 1800) OLED 16:10 aspect ratio, 90Hz
                •   Hệ điều hành Window 11
                •   Cảm biến vân tay
                •   Trọng lượng 1.6kg
                •   Cổng kết nối: USB Type-C, Type-A,HDMI, 3.5mm
                Tuyên ngôn sức mạnh. Sống động thị giác
                Tỏa sáng với cả thế giới cùng ASUS Vivobook 14/15 OLED mạnh mẽ, chiếc laptop tích hợp nhiều tính năng với màn hình OLED rực rỡ, gam màu DCI-P3 đẳng cấp điện ảnh. Mọi thứ trở nên dễ dàng hơn nhờ những tiện ích thân thiện với người dùng bao gồm bản lề mở phẳng 180°, nắp che webcam vật lý và các phím chức năng chuyên dụng. Bảo vệ sức khỏe an toàn với ASUS kháng khuẩn Guard Plus trên các bề mặt thường xuyên chạm vào. Bắt đầu ngày mới đầy hứng khởi với ASUS Vivobook 14/15 OLED!
                Tăng tốc sức mạnh với chế độ Dynamic Performance nhanh chóng nhằm tận dụng tối đa sức mạnh từ bộ vi xử lý Intel® thế hệ 13. Chế độ Dynamic Performance cho phép chuyển đổi hiệu suất bất cứ khi nào bạn muốn. Thao tác đơn giản với tổ hợp phím FN+F để giải phóng 40W sức mạnh CPU vượt qua mọi tác vụ, tăng tốc mọi thứ từ chơi game nhẹ đến đa nhiệm. 

                Khám phá màn hình OLED chân thực, rực rỡ
                Trải nghiệm hình ảnh hoàn toàn mới với màn hình ba cạnh NanoEdge viền mỏng trên ASUS Vivobook 14/15 OLED với tỷ lệ 16:10, dải màu 100% DCI-P3 đẳng cấp điện ảnh cho màu sắc cực kỳ sống động, đạt chuẩn PANTONE® về độ chính xác màu và được TÜV Rheinland chứng nhận về lượng phát xạ ánh sáng xanh thấp, bảo vệ mắt. ASUS Vivobook 14/15 OLED mang đến trải nghiệm giải trí và làm việc hoàn hảo trên màn hình OLED rực rỡ.
                Kháng khuẩn 99% với ASUS Antimicrobial Guard Plus
                ASUS Antimicrobial Guard Plus được áp dụng cho các khu vực thường xuyên chạm vào trên bề mặt laptop giúp giữ vệ sinh. Công nghệ này sử dụng phương pháp xử lý chuyên sâu để ức chế vi-rút và vi khuẩn. Và nó đã được chứng minh một cách khoa học — sử dụng các tiêu chuẩn ISO 2170214 và 2219615 — để ức chế hơn 99% sự phát triển của vi-rút và vi khuẩn trong khoảng thời gian 24 giờ. Các chủng được sử dụng cho các xét nghiệm bao gồm SARS-CoV-2 (COVID-19), H3N2 (Cúm A) và vi khuẩn E. coli.
                *Các xét nghiệm ISO 21702 đối với các Biến thể SARS-CoV-2 (Omicron, BA.5), H3N2, H1N1 và các xét nghiệm ISO 22196 đối với Staphylococcus và E. coli.
                *Phương pháp điều trị17 được FIFRA18 của Hoa Kỳ & EU BPR19 phê duyệt.
                Thiết kế đem lại nhiều tiện ích cho người dùng
                Bản lề 1800 mở phẳng dễ dàng chia sẻ nội dung đến những người xung quanh dù bạn là GenZ cần thảo luận nhóm hay nhân viên văn phòng trong các buổi họp, ASUS Vivobook 14/15 OLED đều có thể đáp ứng tiện lợi. Ngoài ra, nắp che webcam vật lý trên chiếc laptop này còn giúp nâng cao tính riêng tư cho người dùng, đăng nhập nhanh chóng với vân tay một chạm được tích hợp ngay trên touchpad tăng cường bảo mật an toàn.',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 6,
        ]);
        // product_id: 77
        Product::create([
            'name' => 'Laptop Gaming/Đồ Họa Intel i7-8750H GTX 1050 4G RAM 16GB SSD 512GB - Hiệu Năng Vượt Trội - Bảo Hành Chính Hãng',
            'description' => 'Laptop Gaming/Đồ Họa Intel i7-8750H GTX 1050 4G RAM 16GB SSD 512GB - Hiệu Năng Vượt Trội - Bảo Hành Chính Hãng 2 Năm
                ✅ THÔNG TIN SẢN PHẨM
                Chiếc laptop này là sự lựa chọn hoàn hảo cho cả nhu cầu làm việc và giải trí. Với sức mạnh từ vi xử lý Intel i7- 8750H cùng card đồ họa GTX 1050 4GB, máy không chỉ đảm bảo hiệu năng cao khi chơi game mà còn hỗ trợ tốt các phần mềm đồ họa và xử lý video. Bên cạnh đó, RAM 16GB DDR4 và ổ cứng SSD 512GB mang đến trải nghiệm mượt mà và khởi động nhanh chóng, giúp bạn tiết kiệm thời gian và nâng cao hiệu quả công việc.
                
                ✅ THÔNG SỐ KỸ THUẬT
                CPU: Intel i7-8750H
                Card đồ họa: GTX 1050 4GB
                RAM: 16GB DDR4 2666MHz
                Ổ cứng: SSD 512GB M.2 SATA
                Màn hình: 16 inch, độ phân giải 1920x1200, tần số quét 60Hz, IPS 16:10
                Pin: 5000mAh
                Hệ điều hành: Windows 11 Pro
                Màu sắc: Xám
                Bàn phím: Có đèn LED
                
                ✅ ĐẶC ĐIỂM NỔI BẬT
                Hiệu năng mạnh mẽ: Intel i7- 8750H kết hợp GTX 1050 4GB giúp xử lý mượt các tác vụ đồ họa, chơi game và công việc nặng.
                Hình ảnh sắc nét, sống động: Màn hình 16 inch Full HD IPS với tỷ lệ 16:10 cho góc nhìn rộng, màu sắc chân thực, tối ưu cho các tác vụ đồ họa và giải trí.
                Thiết kế sang trọng, bền bỉ: Laptop có màu xám hiện đại, thiết kế mỏng nhẹ, dễ dàng mang theo mọi nơi.
                Bàn phím có đèn LED: Dễ dàng sử dụng trong điều kiện thiếu sáng, hỗ trợ tốt khi làm việc vào ban đêm.
                Âm thanh chất lượng cao: Hệ thống loa 2.0 cho âm thanh nổi rõ ràng, mang lại trải nghiệm giải trí ấn tượng.
                
                ✅ THIẾT BỊ KẾT NỐI
                Cổng kết nối đa dạng: Được trang bị các cổng USB 3.0 x3, USB 2.0 x2, Type-C, HDMI và RJ45, giúp kết nối dễ dàng với nhiều thiết bị ngoại vi.
                Kết nối mạng mạnh mẽ: Hỗ trợ Wi-Fi 2.4G/5G và Bluetooth 4.2 cho tốc độ kết nối nhanh chóng, ổn định.
                Tích hợp cổng mạng RJ45: Đảm bảo tốc độ mạng có dây lên đến 1000Mbps, hỗ trợ tối đa cho công việc yêu cầu kết nối ổn định.
                
                ✅ BẢO HÀNH SẢN PHẨM
                - Sản phẩm được bảo hành 2 năm
                - Lỗi 1 đổi 1 trong vòng 7 ngày nếu lỗi phát sinh từ nhà sản xuất
                - Cam kết sản phẩm 100% đúng mô tả
                - Đổi trả theo quy định của shopee
                - Được kiểm tra khi nhận hàng trên toàn quốc
                
                ✅ THÔNG TIN THƯƠNG HIỆU
                Viamei là thương hiệu chất lượng cao, tự hào mang đến cho bạn những giải pháp hiển thị tiên tiến, giúp bạn tận hưởng sự linh hoạt và tiện lợi trong công việc và giải trí. Sứ mệnh của nhãn hàng là tối ưu hóa không gian và nâng cao hiệu suất làm việc và giải trí.
                Xuất xứ thương hiệu: Đài Loan',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 6,
        ]);
        // product_id: 78
        Product::create([
            'name' => 'Máy tính xách tay Apple MacBook Air (2020) M1 Chip, 13.3-inch, 8GB, 256GB SSD',
            'description' => 'Máy tính xách tay mỏng và nhẹ nhất của Apple, nay siêu mạnh mẽ với chip Apple M1. Xử lý công việc giúp bạn với CPU 8 lõi nhanh như chớp. Đưa các ứng dụng và game có đồ họa khủng lên một tầm cao mới với GPU 7 lõi. Đồng thời, tăng tốc các tác vụ máy học với Neural Engine 16 lõi. Tất cả gói gọn trong một thiết kế không quạt, giảm thiểu tiếng ồn, thời lượng pin dài nhất từ trước đến nay lên đến 18 giờ (1) MacBook Air. Vẫn cực kỳ cơ động. Mà mạnh mẽ hơn nhiều.             
                Tính năng nổi bật 
                •       Chip M1 do Apple thiết kế tạo ra một cú nhảy vọt về hiệu năng máy học, CPU và GPU 
                •       Tăng thời gian sử dụng với thời lượng pin lên đến 18 giờ (1) 
                •       CPU 8 lõi cho tốc độ nhanh hơn đến 3.5x, xử lý công việc nhanh chóng hơn bao giờ hết (2)  
                •       GPU lên đến 7 lõi với tốc độ xử lý đồ họa nhanh hơn đến 5x cho các ứng dụng và game đồ họa khủng (2)  
                •       Neural Engine 16 lõi cho công nghệ máy học hiện đại 
                •       Bộ nhớ thống nhất 8GB giúp bạn làm việc gì cũng nhanh chóng và trôi chảy  
                •       Ổ lưu trữ SSD siêu nhanh giúp mở các ứng dụng và tập tin chỉ trong tích tắc 
                •       Thiết kế không quạt giảm tối đa tiếng ồn khi sử dụng  
                •       Màn hình Retina 13.3 inch với dải màu rộng P3 cho hình ảnh sống động và chi tiết ấn tượng (3)
                •       Camera FaceTime HD với bộ xử lý tín hiệu hình ảnh tiên tiến cho các cuộc gọi video đẹp hình, rõ tiếng hơn 
                •       Bộ ba micro phối hợp tập trung thu giọng nói của bạn, không thu tạp âm môi trường 
                •       Wi_Fi 6 thế hệ mới giúp kết nối nhanh hơn 
                •       Hai cổng Thunderbolt / USB 4 để sạc và kết nối phụ kiện 
                •       Bàn phím Magic Keyboard có đèn nền và Touch ID giúp mở khóa và thanh toán an toàn hơn 
                •       macOS Big Sur với thiết kế mới đầy táo bạo cùng nhiều cập nhật quan trọng cho các ứng dụng Safari, Messages và Maps 
                •       Hiện có màu vàng kim, xám bạc và bạc 
                Pháp lý 
                Hiện có sẵn các lựa chọn để nâng cấp. 
                (1) Thời lượng pin khác nhau tùy theo cách sử dụng và cấu hình. Truy cập apple.com/batteries để biết thêm thông tin. 
                (2) So với thế hệ máy trước. 
                (3) Kích thước màn hình tính theo đường chéo. 
                Thông tin bảo hành:
                Bảo hành: 12 tháng kể từ ngày kích hoạt sản phẩm.
                Kích hoạt bảo hành tại: 
                Hướng dẫn kiểm tra địa điểm bảo hành gần nhất:
                Bước 1: Truy cập vào đường link  
                Bước 2: Chọn sản phẩm.
                Bước 3: Điền Apple ID, nhập mật khẩu.
                Sau khi hoàn tất, hệ thống sẽ gợi ý những trung tâm bảo hành gần nhất.
                Tại Việt Nam, về chính sách bảo hành và đổi trả của Apple, "sẽ được áp dụng chung" theo các điều khoản được liệt kê dưới đây:
                1) Chính sách chung: 
                2) Chính sách cho phụ kiện: 
                3) Các trung tâm bảo hành Apple ủy quyền tại Việt Nam: 
                Qúy khách vui lòng đọc kỹ hướng dẫn và quy định trên các trang được Apple công bố công khai, Shop chỉ có thể hỗ trợ theo đúng chính sách được đăng công khai của thương hiệu Apple tại Việt Nam,
                Bài viết tham khảo chính sách hỗ trợ của nhà phân phối tiêu biểu:
                Để thuận tiện hơn trong việc xử lý khiếu nại, đơn hàng của Brand Apple thường có giá trị cao, Qúy khách mua hàng vui lòng quay lại Clip khui mở kiện hàng (khách quan nhất có thể, đủ 6 mặt) giúp Shopee có thêm căn cứ để làm việc với các bên và đẩy nhanh tiến độ xử lý giúp Qúy khách mua hàng.',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 6,
        ]);
        // product_id: 79
        Product::create([
            'name' => 'Máy tính bảng Huawei Matepad Pro 12.2" Màn Hình Tandem OLED PaperMatte 12.2" | Bàn Phím Trượt HUAWEI Glide',
            'description' => 'Chiều cao
                182.53 mm*
                Chiều rộng
                271.25 mm*
                Độ mỏng
                5.5 mm*
                Trọng lượng
                Khoảng 508 g (bao gồm pin)**
                Kích thước
                12.2 inch*
                Bộ nhớ
                RAM
                12 GB
                ROM
                256 GB / 512 GB*
                Loại
                Màn hình Tandem OLED PaperMatte**
                Độ phân giải
                2800 × 1840, 274 ppi
                Gram màu
                1.07 tỷ màu, gam màu rộng P3
                Tỷ lệ màn hình so với thân máy
                92%***
                Độ tương phản
                2000000:1
                Độ sáng
                2000 nits****
                *Màn hình có các góc bo tròn và khi đo theo hình chữ nhật tiêu chuẩn, màn hình có kích thước đường chéo là 12.2 inch (diện tích xem được thực tế nhỏ hơn một chút).
                **Chỉ có HUAWEI MatePad Pro 12.2-inch phiên bản PaperMatte mới được trang bị màn hình Tandem OLED PaperMatte và HUAWEI MatePad Pro 12.2-inch được trang bị màn hình Tandem OLED FullView.',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 6,
        ]);
        // product_id: 80
        Product::create([
            'name' => 'Laptop Lenovo LOQ 15IAX9 - 83GS004BVN - 83GS001RVN (i5-12450HX) (Xám)',
            'description' => 'Thông tin bảo hành: 
                Laptop gaming Lenovo LOQ 15IAX9 - 83GS004BVN (i5-12450HX/RAM 12GB/GeForce RTX 3050/512GB SSD/ Windows 11): Bảo hành 36 tháng
                Laptop gaming Lenovo LOQ 15IAX9 - 83GS001RVN (i5-12450HX/RAM 12GB/GeForce RTX 3050/512GB SSD/ Windows 11) : Bảo hành 24 tháng
                Laptop Lenovo LOQ 15IAX9 - 83GS001RVN: Chiến binh mạnh mẽ, chinh phục mọi cuộc chơi
                Laptop Gaming Lenovo LOQ 15IAX9 83GS001RVN là một mẫu laptop gaming tầm trung mạnh mẽ, với bộ vi xử lý Intel Core i5-12450HX và card đồ họa NVIDIA GeForce RTX 3050. Màn hình 15.6 inch Full HD 144Hz mang lại trải nghiệm game mượt mà. Với khả năng xử lý đồ họa xuất sắc và chất lượng hình ảnh vượt trội, nó phục vụ cả game thủ và những người sáng tạo. Ngoài ra thiết kế thân thiện với người dùng, cũng giúp Lenovo LOQ 15IAX9 83GS001RVN phù hợp với người dùng phổ thông.
                Lenovo LOQ 15IAX9 - 83GS004BVN sở hữu ngoại hình ấn tượng
                Màn hình với những thông số chuẩn gaming
                Màn hình của Lenovo LOQ 15IAX9 có kích thước 15.6 inch, độ phân giải WUXGA (1920 x 1200), sử dụng tấm nền IPS mang lại góc nhìn rộng và màu sắc chính xác. Tần số quét 144Hz giúp trải nghiệm hình ảnh mượt mà, phù hợp cho cả chơi game lẫn công việc đồ họa. Khả năng chống lóa cũng là một điểm cộng, giúp người dùng thoải mái làm việc trong nhiều điều kiện ánh sáng khác nhau mà không bị mỏi mắt.
                CPU Intel Core i5-12450HX đủ sức chơi mượt nhiều tựa game hiện nay
                Được trang bị CPU Intel Core i5-12450HX thế hệ thứ 12 với 8 nhân và 12 luồng, xung nhịp từ 2.4 GHz đến 4.4 GHz, Lenovo LOQ 15IAX9 đảm bảo hiệu năng mạnh mẽ, đáp ứng tốt các nhu cầu từ cơ bản đến nâng cao. Vi xử lý này không chỉ giúp xử lý mượt mà các tác vụ đa nhiệm mà còn mang lại khả năng tiết kiệm năng lượng hiệu quả, tối ưu hóa trải nghiệm người dùng.
                Lenovo LOQ 15IAX9 đảm bảo hiệu năng mạnh mẽ
                Bên cạnh đó, chiếc Lenovo LOQ 15IAX9 - 83GS004BVN cũng được trang bị card đồ họa rời NVIDIA GeForce RTX 3050 với 6GB GDDR6 VRAM, kết hợp cùng đồ họa tích hợp Intel UHD Graphics 710. Với GPU này, người dùng có thể chơi các tựa game nặng với thiết lập đồ họa cao, cũng như xử lý các công việc liên quan đến đồ họa, chỉnh sửa video, và các ứng dụng đòi hỏi hiệu năng cao khác một cách mượt mà.
                Khả năng chơi game và làm việc đa nhiệm
                Với cấu hình mạnh mẽ, Lenovo LOQ 15IAX9 không chỉ chơi game tốt mà còn đáp ứng được nhiều tác vụ khác nhau như làm việc với các ứng dụng văn phòng, lập trình, thiết kế đồ họa, và xử lý video. Khả năng đa nhiệm vượt trội giúp người dùng chuyển đổi giữa các ứng dụng một cách nhanh chóng và hiệu quả.
                Dung lượng RAM 12GB RAM DDR5 4800MHz độc đáo
                Máy được trang bị 12GB RAM DDR5 4800MHz, cho phép xử lý thông tin nhanh chóng và mượt mà. Với khả năng nâng cấp lên đến 32GB, người dùng có thể dễ dàng nâng cấp khi cần thiết, đảm bảo khả năng hoạt động mượt mà trong tương lai.
                Laptop thời thượng với thiết kế kim loại nguyên khối và màn hình viền mỏng
                Khám phá vẻ đẹp tinh tế và độ bền bỉ của Lenovo LOQ 15IAX9 83GS001RVN
                Lenovo LOQ 15IAX9 83GS001RVN sử dụng kim loại cao cấp, tạo vẻ đẹp thẩm mỹ và độ bền cao, hạn chế trầy xước và bụi bẩn. Thiết kế góc cạnh bo tròn tỉ mỉ tạo vẻ ngoài đẹp mắt và sang trọng, với mặt A phủ lớp sơn màu Storm Grey độc đáo. Logo mới được đặt ở góc cạnh, làm tăng tính nhận diện thương hiệu và tạo điểm nhấn độc đáo. Với kích thước 359.6 x 264.8 x 22.1mm và trọng lượng 2.4kg, laptop này phù hợp với laptop gaming hiện đại và dễ dàng mang theo bên mình.
                Hình ảnh mượt mà với màn hình 144Hz
                Laptop sở hữu màn hình 15.6 inch Full HD (1920 x 1080) với tấm nền IPS cho chất lượng hình ảnh sắc nét và sống động. Độ sáng màn hình 250 nits giúp bạn sử dụng máy thoải mái trong mọi môi trường ánh sáng. Viền bezel mỏng mang đến trải nghiệm hình ảnh đắm chìm hơn. Đặc biệt, tần số quét 144Hz giúp hình ảnh chuyển động mượt mà, không bị xé hình, mang đến trải nghiệm chơi game tuyệt vời.
                Hiệu năng và phần cứng của Lenovo LOQ 15IAX9 83GS001RVN
                Hiệu năng mạnh mẽ
                Lenovo LOQ 15IAX9 83GS001RVN được trang bị CPU Intel Core i5-12450HX mạnh mẽ với 8 nhân 12 luồng, xung nhịp cơ bản 2.4 GHz và tối đa lên đến 4.4 GHz. Nhờ vậy, máy có thể xử lý mượt mà các tác vụ nặng như chơi game, chỉnh sửa video, đồ họa,...
                Đồ họa ấn tượng
                Card đồ họa NVIDIA GeForce RTX 3050 6GB GDDR6 mang đến hiệu năng đồ họa mạnh mẽ, cho phép bạn chơi game mượt mà ở cài đặt cao và thực hiện các tác vụ sáng tạo như chỉnh sửa video, ảnh một cách hiệu quả.',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 6,
        ]);
        // product_id: 81
        Product::create([
            'name' => 'Cân điện tử sức khỏe cao cấp, máy inbody 8 điện cực chuẩn Âu Mỹ chính hãng SAILAZA SA-2312',
            'description' => 'Cân điện tử sức khỏe cao cấp, máy inbody 8 điện cực chuẩn Âu Mỹ chính hãng SAILAZA SA-2312
                Cân điện tử sức khỏe Sailaza phân tích 32 chỉ số cơ thể
                SAILAZA tự hào với giải pháp đo lường thông minh hàng đầu tại Việt Nam -  chuyên cung cấp các thiết bị đo lường thông minh giúp khách hàng hiểu về cơ thể và sức khoẻ bản thân. Nổi bật nhất là dòng cân điện tử sức khỏe SA2312 tiên tiến nhất hiện nay. Khác biệt với các loại cân thông thường chỉ có thể đo phần dưới của cơ thể, Cân inBody SA2312 của SAILAZA được trang bị 8 điện cực, giúp đo lường toàn diện cả cơ thể với độ chính xác lên tới 99,86%. Kết nối Bluetooth đo và báo cáo phân tích 32 dữ liệu cơ thể chuyên nghiệp từ tổng quan đến chi tiết từng bộ phận, giúp bạn hiểu rõ tình trạng sức khỏe của mình hơn bao giờ hết.
                Công nghệ tiên tiến, sản phẩm chất lượng cao, thiết kế đẹp, sang trọng và tinh tế, đạt đầy đủ các tiêu chuẩn của Châu Âu và châu Mỹ như FCC, CE, RoHS, FDA. Cân inBody SA2312 là công cụ hỗ trợ tuyệt vời trong việc theo dõi sức khỏe và quản lý cân nặng hiệu quả. Bạn có thể dễ dàng kiểm tra sức khỏe định kỳ, điều chỉnh chế độ dinh dưỡng và luyện tập sao cho phù hợp, góp phần nâng cao chất lượng cuộc sống.
                Với cân SAILAZA inBody SA2312, bạn không chỉ theo dõi sức khỏe hàng ngày mà còn bắt đầu một hành trình mới trong việc quản lý và cải thiện sức khỏe toàn diện, đồng hành cùng bạn và gia đình trên con đường hướng tới một cuộc sống chất lượng hơn, khỏe mạnh và hạnh phúc hơn.
                Tính năng nổi bật của Cân điện tử sức khỏe Sailaza SA-2312:
                - Thay vì sử dụng kỹ thuật 4 điện cực chỉ đo được nửa người bên dưới, cân sử dụng công nghệ đo 8 điện cực đo toàn thân cho độ chính xác cao hơn và dữ liệu phân tích nhiều hơn với 32 dữ liệu
                - Công nghệ phân tích trở kháng điện sinh học BIA (Body Impedance Analysis) - phương pháp phân tích thành phần cơ thể được các nhà khoa học công nhận cho kết quả với độ chính xác cao nhất trên thế giới hiện nay.
                - Công nghệ nhận diện người dùng thông minh: Nhận diện người dùng mà không cần kết nối App, từ lần sử dụng thứ 2, cân hỗ trợ chế độ ngoại tuyến xem 8 kết quả đo trực tiếp trên màn hình mà không cần kết nối Bluetooth rất tiện lợi.
                - Màn hình 8-IN-1: Màn hình màu 4.8 inch cực lớn hiển thị trực tiếp 8 chỉ số
                - Độ chính xác cao: được trang bị 4 cảm biến ZeroVar G-Shape® siêu nhạy cho độ chính xác cao với sai số chỉ ≤0.05%
                - Dễ dàng kết nối và tự đồng bộ, in báo cáo dữ liệu trên app: Kết nối Smartphone thông qua Bluetooth với ứng dụng Fitdays, hiển thị kết quả đo trực tiếp ngay khi bạn đứng lên cân. Ngoài ra cân còn có chức năng kết nối với máy in để xuất văn bản dữ liệu sức khỏe cơ thể của bạn một cách chuyên nghiệp.
                - 24 người dùng trên 1 tài khoản: Tự động lưu trữ và nhận diện nhiều người dùng 1 cách thông minh
                - Nguồn: Pin sạc Lithium mỗi lần sạc dùng được khoảng 3 tháng và sử dụng ít nhất 300 lần sạc (trên 10 năm)
                Thông số kỹ thuật Cân sức khỏe SA-2312:
                - Kích thước sản phẩm: 300x300x26mm
                - Màn hình LCD hiển thị: Kích thước 108x62mm
                - Đơn vị trọng lượng: Kg/lb/th
                - Giới hạn trọng lượng: 5kg-180kg
                - Phân chia trọng lượng: 0,1kg/ 0,216 lb
                - Nguồn điện: Pin sạc Lithium 300mAH
                - Nhiệt độ hoạt động: 10-40 độ C
                - Độ ẩm hoạt động: 40%-80% RH
                LƯU Ý KHI sử dụng Cân điện tử sức khỏe SA-2312
                - Đọc kỹ HDSD trước dùng 
                - Bỏ qua 5 lần đo đầu tiên khi nhận cân hoặc sau khi di chuyển cân đi xa để cân ổn định cho kết quả chính xác 
                - Đứng chân trần khi đo và đảm chân không bị ướt, giữ thẳng thân người
                - Đám bảo cân được đặt trên bề mặt cứng và phẳng 
                - Không nên dùng với phụ nữ mang thai với mục đích đo chỉ số, chỉ đo cân nặng  
                - KHÔNG sử dụng cân khi đang đeo các thiết bị cấy ghép y tế như máy tạo nhịp tim 
                - Cân nặng cơ thể LUÔN THAY ĐỔI trong ngày, hãy sử dụng cân vào lúc sáng sớm mới ngủ dậy để có kết quả chính xác 
                CHÍNH SÁCH BẢO HÀNH - ĐỔI TRẢ
                1. SAILAZA cam kết sẽ luôn mang đến sự tin tưởng và hài lòng tuyệt đối từ chất lượng sản phẩm cho đến dịch vụ khách hàng 
                - Bảo hành: 12 tháng
                2. Điều kiện đổi trả: 
                - Đổi trả sản phẩm trong vòng 15 ngày kể từ ngày nhận hàng 
                - Shop giao hàng không đúng mẫu sản phẩm
                - Giao không đúng số lượng hàng đã đặt
                3. Điều kiện KHÔNG được đổi trả:
                - Đổi trả sản phẩm sau thời gian quy định (sau 15 ngày kể từ khi nhận hàng)
                - Sản phẩm không còn đầy đủ phụ kiện ban đầu
                - Sản phẩm không còn nguyên vẹn, bị rơi vỡ trong quá trình sử dụng',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 11,
        ]);
        // product_id: 82
        Product::create([
            'name' => '(Bảo Hàng 1 Năm)HABOTEST HT208 Đồng hồ vạn năng kỹ thuật số 1000V/1000A AC/DC NCV True-RMS dùng đo dòng điện điện áp',
            'description' => 'Thông số kỹ thuật:
                & & & Thông số kỹ thuật hàng hóa HT208A / HT208D
                Thương hiệu: HABOTEST
                Điện áp DC: 600mV / 6V / 60V / 600V / 1000V
                Điện áp AC: 600mV / 6V / 60V / 600V / 750V
                Dòng điện DC: 60A / 600A / 1000A (Không hỗ trợ HT208A) / (Hỗ trợ HT208D)
                Dòng điện AC: 60A / 600A / 1000A
                Dca Zero: (Không hỗ trợ HT208A) / (Hỗ trợ HT208D) 
                Điện trở: 600Ω / 6kΩ / 60kΩ / 600kΩ / 6MΩ / 60MΩ
                Điện dung: 10nF / 100nF / 1μF / 10μF / 100μF / 1mF / 10mF / 100mF
                Tần số: 10Hz / 100Hz / 1kHz / 10kHz / 100kHz / 1MHz / 10MHz
                Nhiệm vụ: 1% ~ 99%
                Nhiệt độ (°C /°F): -40°C ~ 1000°C (-40°F ~ 1832°F)
                Đếm: 6000 Đếm
                Phạm vi tự động / thủ công: Hỗ trợ
                Tính liên tục: có
                Diode: có
                Giữ dữ liệu: Có
                Ncv: Có
                Tự động tắt nguồn: Có
                True RMS: Có
                Vfd: CÓ
                Khởi động: CÓ
                Đèn nền: Có
                Đèn pin: Có	
                Chỉ báo pin yếu: có
                Pin AAA 3x1.5V: (KHÔNG bao gồm)
                Đo giá trị tối đa / nhỏ nhất: CÓ
                Đo lường giá trị tương đối: CÓ
                Đầu vào trở kháng thấp: CÓ
                Va ” LED: CÓ
                Đánh giá an toàn: EN61010-1, -2-030; EN61010-2-033; EN61326-1 CAT III 1000V, CAT IV 600V
                Danh sách gói: 1 * Đồng hồ kẹp kỹ thuật số, 1 * Cặp nhiệt điện, 2 * Chì thử nghiệm, 1 * Hướng dẫn sử dụng (tiếng Anh)
                1.Đây là đồng hồ vạn năng kỹ thuật số RMS thực trở kháng kép tích hợp nhiều phép đo như AC / DC, dòng AC / DC, tần số, tỷ lệ nhiệm vụ, điện trở, điện dung, nhiệt độ, diode, tính liên tục, NCV, VFD, dòng khởi động, v.v. Và có nhiều ftion hơn như giữ dữ liệu cuối cùng, đèn pin, Max./ Phút./ Giá trị tương đối, độ C / độ F và phím không.
                Các tính năng:
                2.Clamp MULTIMETER: Đo dòng điện khởi động, dòng điện VFD /, dòng AC / DC, AC / DC, tần số, tỷ lệ nhiệm vụ, điện trở, tính liên tục, diode, điện dung, nhiệt độ, phát hiện AC (NCV) không tiếp xúc và phát hiện trực tiếp.
                3.Rộng MỞ RỘNG: Công suất hàm mở là 40mm, đủ rộng để đo mà không làm ảnh hưởng đến mạch.
                4.Loud BEEP: Cảm biến NCV gửi cảnh báo bằng âm thanh và hình ảnh sau khi nhận được tín hiệu điện từ.
                5.Các CÂU HỎI THÊM: Có tính năng giữ dữ liệu, đèn pin, màn hình thấp, độ C / độ F, Max./ Phút./ Giá trị tương đối và phím Zero (đặt lại).
                6.An TOÀN KHI SỬ DỤNG: Được thiết kế và phù hợp với IEC61010-1, CAT III 1000V, an toàn và đáng tin cậy.
                7.Tự ĐỘNG TẮT: Tự động tắt nguồn trong vòng 15 phút nếu không có hoạt động, giúp bảo toàn.
                8.Máy KIỂM TRA ĐA NĂNG: Đi kèm với 2 dây dẫn thử nghiệm và một cặp nhiệt điện được sử dụng như một bộ đa năng.',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 11,
        ]);
        // product_id: 83
        Product::create([
            'name' => 'Ổ Cắm Điện 3250W-2500W Tích Hợp Cổng USB TypeC Đa Năng DELI, 2-6 Lỗ Cắm Đầu 3, Dây 2-5M Tiện Dụng, An Toàn,Chống Cháy Nổ',
            'description' => 'THÔNG TIN SẢN PHẨM
                Ổ CẮM ĐIỆN DELI TÍCH HỢP Ổ USB VÀ TYPE-C SẠC PD20W
                👉ĐẶC ĐIỂM SẢN PHẨM:
                ✅Công Suất Tối Đa: 3250W (đối với ổ điện tích hợp cả ổ USB và type C thì công suất tối đa là 2500W)
                ✅Chịu Nhiệt Lên Tới 750°C
                ✅Tích hợp cổng sạc USB-A và TypeC sạc nhanh PD20W cho các thiết bị điện thoại lPhone, Samsung, Oppo,.... (Lưu ý: Cổng USB sẽ không sạc được với các dòng máy sạc nhanh trên 12W và cổng USB công suất tổng 12W - 3 dây sạc điện thoại công suất cao sẽ không sạc được cùng 1 lúc) -> Cổng USB: 12W - 5V - 2,4A
                ✅Cắm được hầu hết các loại ổ cắm trên thị trường: UK, EU, USA, Universal,....
                ✅Số lượng ổ cắm 2-12 ổ thoải mái cắm các thiết bị điện
                ✅Các loại ổ cắm vuông được tích hợp cầu chì tự động ngắt nguồn điện khi quá áp
                ✅Thiết kế tích hợp Lõi Cái Đồng tiết diện 1.25mm2 dẫn điện tốt, độ bền cao và ít bị ăn mòn
                ✅Tất cả ổ cắm được trang bị cổng bảo vệ an toàn cho trẻ em
                ✅Nút nguồn giúp tiết kiệm điện khi không sử dụng
                👉CHI TIẾT SẢN PHẨM:+ Kích thước ổ cắm dẹt điện (dài x rộng x cao) (mm)
                - ET401 - 3 ổ, 1 nguồn, dây 3m: 200 x 55 x 28
                - ET402 - 3 ổ, 1 nguồn, dây 5m: 200 x 55 x 28
                - ET403 - 4 ổ, 1 nguồn, dây 3m: 255 x 55 x 28
                - ET404 - 4 ổ, 1 nguồn, dây 5m: 255 x 55 x 28
                - ET405 - 6 ổ, 1 nguồn, dây 3m: 355 x 55 x 28
                - ET406 - 6 ổ, 1 nguồn, dây 5m: 355 x 55 x 28
                - ET407 - 2 ổ, 3 USB, dây 2m: 255 x 55 x 28
                - ET408 - 3 ổ, 3 USB, dây 2m: 273 x 55 x 28
                - ET409 - 2 ổ 3 USB 3 nguồn 2m: 185 x 80 x 28
                - ET410 - 3 ổ 3 USB 4 nguồn 2m: 235 x 80 x 28
                - ET411 - 4 ổ 3 USB 5 nguồn 2m: 285 x 80 x 28
                - E18337(03) - 4 ổ 3 chân, dây 3m: 260 x 60 x 30
                - E18338(03) - 3 ổ 3 chân, dây 3m: 210 x 60 x 30
                - E18339(02) - 3 ổ 3+3 ổ 2 chân, 2m: 215 x 85 x 30
                - E18339(03) - 3 ổ 3+3 ổ 2 chân, 3m: 215 x 85 x 30
                - E18339(05) - 3 ổ 3+3 ổ 2 chân, 5m: 215 x 85 x 30
                - E18340(02) - 4 ổ, 1 nguồn, dây 2m: 260 x 60 x 30
                - E18340(03) - 4 ổ, 1 nguồn dây 3m: 260 x 60 x 30
                - E18340(05) - 4 ổ, 1 nguồn dây 5m: 260 x 60 x 30
                - CT412 - CT413 - CT414: Vuông 4 ổ, 2 USB & 1 Type C: 90 x 80 x 80
                - CT415: Tháp - 8 ổ, 2 USB & 2 Type C: 170 x 100 x 70
                - CT416: Tháp - 12 ổ, 2 USB & 2 Type C: 250 x 100 x 70
                + Các mã ổ cắm vuông và hình tháp:
                ✅Ổ điện vuông - tích hợp 2 USB + 1 Type C sạc thường: CT412 (1.6m) | CT413 (2.4m)
                ✅Ổ điện vuông - tích hợp 2 USB + 1 Type C sạc nhanh PD20W: CT414 (2.4m) sạc được cho các thiết bị hỗ trợ sạc nhanh trên 15W Như lPHONE, SAMSUNG NOTE, OPPO, XlAOMl,....
                ✅Ổ điện hình tháp: tích hợp 2 USB + 2 Type C sạc thường: CT415 (8 ổ, 3m) | CT416 (12 ổ, 4m)
                ✅ Ổ cắm vuông ET417: 2 ổ cắm, 3250W, dây 1,8m, 1 nút nguồn, 3 USB max 18W, bảo vệ quá áp: không, tiết diện lõi đồng 3x1.25mm2, kích thước: 20x5.5x2.8cm.
                ✅ Ổ cắm vuông ET418: 2 ổ cắm, công suất 3250W, 1 nút nguồn, cổng sạc 3 USB 18W, bảo vệ quá áp: không, tiết diện lõi đồng 3x1.25mm2.
                ✅ Ổ cắm vuông ET419: 3 ổ cắm, 1 nút công tắc nguồn, dây 1.8m, tiết diện lõi đồng 3x1.25mm2.
                ✅ Ổ cắm vuông ET420: 3 ổ cắm, dây 3m, kích thước 20x5.5x2.8cm, 1 nút nguồn công suất 3250W, tiết diện lõi đồng 3x1.25mm2, cổng sạc USB/typeC: không, bảo vệ quá áp: không
                ✅ Ổ cắm vuông ET424: 6 ổ cắm, dây 2m, công suất 2500W, 2USB max 18W, 2 type C max 20 W, thiết diện lõi đồng: 3x0.75mm2, có bảo vệ quá áp, kích thước: 28.5x10x2.8cm.
                👉CHÍNH SÁCH HẬU MÃI:
                ✅BẢO HÀNH 12 THÁNG, 1 ĐỔI 1 MIỄN PHÍ TRONG 30 NGÀY ĐẦU TIÊN KỂ TỪ KHI NHẬN HÀNG NẾU LỖI DO NHÀ SẢN XUẤT
                ------------------------------------------------------------------------------------------------------------------------------------------------------------
                Deli Tools Official Store - Cửa hàng độc quyền sản phẩm tại Việt Nam
                ​​​​​​​Ngoài cung cấp các sản phẩm văn phòng phẩm, Deli còn cung cấp các sản phẩm thiết bị, máy móc hỗ trợ cho việc tối ưu hóa hiệu quả làm việc cho doanh nghiệp. Với phương châm luôn luôn thấu hiểu khách hàng và cung cấp các giải pháp hoàn thiện hóa và trải nghiệm mới thông qua sự đổi mới không ngừng, do đó giúp khách hàng doanh nghiệp của Deli gia tăng năng suất và hiệu quả chính xác hơn. Khách hàng lựa chọn các sản phẩm của Deli Tools Official Store sẽ được cam kết:
                ✅Sản phẩm chính hãng từ nhà máy Deli, nguồn gốc rõ ràng và chất lượng đạt tiêu chuẩn.
                ✅Các sản phẩm được nghiên cứu, trải qua quá trình thử nghiệm nghiêm ngặt tại nhà máy Deli.
                ✅Bảo hành theo quy định của nhà sản xuất.
                ✅Giá cả hợp lý, cạnh tranh
                ✅Hỗ trợ đổi trả hàng cho những sản phẩm bị thiếu.',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 11,
        ]);
        // product_id: 84
        Product::create([
            'name' => 'Nhiệt Kế Điện Tử, Nhiệt Kế Hồng Ngoại MALOBY Đo Trán Cảm Biến An Toàn Nhỏ Gọn Tiện Lợi',
            'description' => 'Nhiệt Kế Điện Tử, Nhiệt Kế Hồng Ngoại MALOBY Đo Trán Cảm Biến An Toàn Nhỏ Gọn, Tiện Lợi
                NHIỆT KẾ HỒNG NGOẠI ĐO TRÁN
                - Sử dụng cảm biến hồng ngoại rất an toàn, không như nhiệt kế thuỷ ngân
                - Đo đơn giản, chính xác trong 0,5s chỉ sau khi ấn biểu tượng Nhiệt kế
                 + Đo dễ dàng trên trán, tai, nách của bé + Màn hình hiển thị điện tử, hiển thị rất rõ ràng dễ hiểu
                 + Đo nhiệt độ môi trường như : Nhiệt độ phòng, nước tắm, nước pha sữa cho bé... 
                THÔNG SỐ KỸ THUẬT
                + Model : HG-02
                + Vị trí đo nhiệt độ cơ thể : trán, tai hoặc nách 
                + Đo nhiệt độ môi trường : nhiệt độ phòng, nước tắm, nước pha sữa... 
                + Ấn biểu tượng dấu “-“ để chuyển đổi qua lại giữa 2 chế độ đo
                + Độ phân giải : 0,1°C 
                + Thời gian đo : 0.5 giây ( có thể đo liên tục rất nhanh )
                + Khoảng cách đo hiệu quả : 3-5 cm + Bộ nhớ : lưu 32 lần đo khi đo cơ thể , 12 lần đo khi đo môi trường. 
                + Nguồn : 2 Pin đũa AAA , pin yếu máy sẽ báo LO + Tự động tắt sau 15 giây, Có âm thanh báo mỗi lần đo

                HƯỚNG DẪN SỬ DỤNG
                 + Lắp pin vào máy sao cho đúng cực pin, ấn biểu tượng nhiệt kế để bật máy lên
                 + Nhấn nút  “-“  để chọn chế độ đo : Cơ thể hoặc môi trường
                 • Đo nhiệt độ cơ thể : Màn hình hiển thị chữ BODY
                • Đo nhiệt môi trường : Màn hình hiển thị chữ SURFACE TEMP 
                + Đo nhiệt độ cơ thể : Đặt nhiệt kế cách vị trí cần đo 2-3cm, rồi ấn biểu tượng nhiệt kế để đo, nhìn màn hình sẽ hiện kế quả đo. 
                Dấu + - trên nhiệt kế để kiểm tra kết quả các lần đo trước đó ( lưu 32 lần đo ) 
                + Đo nhiệt độ môi trường : nhiệt độ phòng hoặc nhiệt độ nước tắm, nước pha sữa, chọn biểu tượng dấu “-“ sau đó ấn biểu tượng nhiệt kế để đo.
                 Ấn +- để xem các kết quả đo trước đó ( lưu 12 lần đo )
                QUYỀN LỢI KHÁCH HÀNG KHI MUA HÀNG:
                - Hoàn tiền 100% đối với các sản phẩm không giống hình
                - Miễn phí 1 đổi 1 trong 07 ngày với lỗi nhà sản xuất
                - Bảo hành trong 24 tháng
                - Miễn phí ship toàn quốc với mọi đơn hàng trên 50K.
                - Tư vấn nhiệt tình chu đáo 24/7, giải đáp mọi thắc mắc của khách hàng.
                - Đổi trả hàng miễn phí theo đúng quy định của Shopee
                CẢM ƠN QUÝ KHÁCH ĐÃ TIN TƯỞNG VÀ ỦNG HỘ',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 11,
        ]);
        // product_id: 85
        Product::create([
            'name' => 'Bộ Sạc Pin AA/AAA Beston C8001 Cho Micro Karaoke loa, đồ chơi trẻ em, đồng hồ, thiết bị điện tử, đèn flash',
            'description' => 'Bộ sạc pin BESTON BST-C8001 là thiết bị để sạc các loại pin khác nhau, nhằm hỗ trợ cho việc nạp nhiên liệu điện cho các dòng pin sạc sử dụng cho các loại thiết bị điện tử, máy ảnh, camera, đồ chơi công nghệ, đèn pin vv…
                Thường dùng cho các loại thiết bị có dung lượng lớn, các loại máy bộ sạc pin AA thường được đánh giá cao về chất lượng cũng như khả năng lưu trữ năng lượng.
                 Dòng sản phẩm pin sạc BESTON được đánh giá rất cao trên thị trường. Với độ bền, chế độ bảo hành tốt. sản phẩm được người dùng phổ biến.
                Với mức giá thành trung bình, với 2 cổng sạc pin nhanh. Chế độ bảo hành dài hạn cũng là một trong những đánh giá quan trọng cho dòng sạc BESTON hiện nay
                Thông số kỹ thuật
                •	Sạc pin BESTON cho pin AA và AAA có khả năng sạc cả 02 loại pin AA và AAA cùng lúc
                •	Thiết kế nhỏ gọn, thông minh, ban có thể dễ dàng để ở nhà hay mang đi du lịch
                •	Có nắp đậy an toàn khi sử dụng
                •	Có đèn báo khi đang sạc
                •	Sạc cùng lúc 2 viên pin sạc AA – AAA
                •	Đèn LED báo quá trình sạc. Báo lỗi khi sử dụng pin sạc 1 lần.
                •	Nguồn điện Autovolt 100V-250V thích hợp sử dụng cho mọi nơi.
                •	Không thay đổi dòng điện trong quá trình sạc giúp kéo dài tuổi tuổi thọ pin làm việc.
                •	Sạc cho tất cả các loại pin 1.2 V AA/AAA.
                Bộ 4 Viên Pin Tiểu Sạc AA Cao Cấp 1200mAh Doublepow
                Kiểu pin: AA
                Điện áp 1.2V
                Số lần sạc: 1000 lần
                Dung lượng: 1200mAh
                Bộ: 4 viên pin sạc
                Loại pin: Ni-MH
                Hiệu năng cao, an toàn, dễ sử dụng
                Sử dụng cho pin máy ảnh, xe điều khiển từ xa ...
                Kích thước pin: AA 49x14mm, AAA 44x11mm',
            'status' => 'active',
            'seller_id' => 3,
            'category_id' => 11,
        ]);
        // product_id: 86
        Product::create([
            'name' => 'Khăn giấy cao cấp treo tường Top Gia sắc hạ 6 bịch, Giấy vệ sinh 4 lớp dày dặn an toàn, mềm mịn',
            'description' => 'Khăn giấy cao cấp treo tường Top Gia 6 bịch dùng cho mọi không gian được làm từ bột gỗ nguyên chất, an toàn, mềm mịn',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 7,
        ]);
        // product_id: 87
        Product::create([
            'name' => 'YANYANGTIAN màn chống muỗi riêng tư 1m5/1m8/2m Lắp đặt không cần khoan',
            'description' => 'Thương hiệu: YANYANGTIAN
                Phong cách: Mông Cổ yurt
                Phương pháp cài đặt: cài đặt miễn phí
                Chức năng: che nắng
                Đối tượng áp dụng: Chung
                Các tình huống áp dụng: sử dụng tại nhà
                Số lượng cửa: 3 cửa
                🌈//Có tổng cộng 3 kích cỡ.
                Màn chống muỗi vuông, màn chống muỗi (5/6/6.6 feet)
                150*200cm (5 feet): rộng 150 x dài 200 x cao 170 cm.
                180*200cm (6 feet): rộng 180 x dài 200 x cao 170 cm.
                200*230cm (6,6 feet): rộng 200 x dài 220 x cao 170 cm.
                Chất liệu vải lưới chống muỗi dai và bền, có tác dụng cản gió tốt, không gây khó chịu cho bạn.
                Thích hợp để đuổi muỗi. và côn trùng nhỏ
                Dễ sử dụng, dễ bảo quản, tiết kiệm không gian chị em có thể tự trải ra.
                🚚 [Giao hàng tận nơi]
                Chúng tôi có đủ nguồn cung. Xin vui lòng mua. Chúng tôi sẽ giao hàng cho bạn trong thời gian sớm nhất sau khi nhận được đơn hàng!
                🛒 [Xin lưu ý trước khi mua hàng]
                Cửa hàng chúng tôi không chấp nhận thay đổi tên địa chỉ giao hàng mỗi khi quý khách gửi hàng.
                Cửa hàng không thể chỉnh sửa, thay đổi thông tin của khách hàng nếu nhập sai địa chỉ.
                 Nếu nhập sai địa chỉ và số điện thoại vui lòng nhấn "Hủy" và đặt hàng lại.
                ❤ [Gợi ý]
                Trước khi mở gói sản phẩm, vui lòng làm phiền khách hàng thân yêu của bạn. Trước khi mở gói sản phẩm, hãy chụp ảnh mặt trước của gói.
                Nếu phát hiện sản phẩm bị lỗi hoặc hư hỏng, vui lòng thông báo ngay cho cửa hàng để bạn có thể yêu cầu bồi thường sản phẩm hoặc được hoàn tiền.
                Vui lòng kiểm tra xem tên, địa chỉ, số điện thoại và thông tin sản phẩm của bạn có chính xác hay không trước khi đặt hàng.
                Nếu bạn hài lòng, vui lòng cho chúng tôi phản hồi 5 sao.
                Nếu bạn không hài lòng theo bất kỳ cách nào, chúng tôi yêu cầu bạn liên hệ với chúng tôi ngay lập tức trước khi cung cấp cho chúng tôi bất kỳ phản hồi hoặc tranh chấp tiêu cực nào.
                Cảm ơn tất cả khách hàng của chúng tôi. Ai sẽ ủng hộ cửa hàng của chúng tôi.
                ✨[Nhắc nhở ấm áp]
                Do sự khác biệt về hiệu ứng ánh sáng và màn hình, màu sắc thực tế của sản phẩm có thể hơi khác so với hình ảnh hiển thị. Vui lòng cho phép sai số đo 5-10% cho sản phẩm.',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 7,
        ]);
        // product_id: 88
        Product::create([
            'name' => 'CHẢO INOX ĐA LỚP SUNHOUSE IN16/IN18M6/IN20M6,/N24M6/IN26M6/IN28M6',
            'description' => 'Chảo inox đa lớp Sunhouse
                Model: IN20M6 - IN24M6 - IN26M6
                Chảo inox đa lớp Sunhouse đạt các tiêu chuẩn quốc tế về sức
                khỏe và chất lượng. Chảo được thiết kế 3 lớp nguyên khối chắc chắn, bền bỉ, có
                nhiều kích cỡ khác nhau hỗ trợ người dùng chế biến đa dạng các món ăn và có thể
                sử dụng trên mọi loại bếp.
                Thông số kỹ thuật
                Chảo inox 304 Sunhouse IN20M6,/N24M6/26M6
                Loại  Chảo chiên
                Đường kính chảo   20cm
                Độ cao của chảo   5.5cm
                Độ dày thành chảo   2.0mm
                Chất liệu chảo    Inox 304 - Nhôm - Inox 430
                Chất liệu lòng chảo   Inox 430
                Nắp vung kính   Không có
                Chất liệu đáy chảo   Đáy từ
                Tương thích với    Tất cả các loại bếp
                Tính năng nổi bật   Dùng được trong máy rửa chén
                Thương hiệu   Sunhouse
                Xuất xứ    Việt Nam',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 7,
        ]);
        // product_id: 89
        Product::create([
            'name' => 'Thang ghế tay vịn gia đình xếp gọn, bậc thang to kèm tay vịn đảm bảo an toàn - Hàng chính hãng NIKITA',
            'description' => 'Thang ghế tay vịn gia đình xếp gọn, bậc thang to kèm tay vịn đảm bảo an toàn - Hàng chính hãng NIKITA
                - Là dòng thang sử dụng trong gia đình, quán tạp hóa, siêu thị công ty .v.v. nhờ đặc tính xếp gọn tiết kiệm không gian, trọng lượng nhẹ, bậc thang lớn kèm tay vịn đảm bảo an toàn, an tâm cho người sử dụng. 
                - Thang có nhiều mẫu mã khác nhau từ chất liệu, cho đến thiết kế phù hợp với thiết kế không gian người sử dụng 
                🏅CHI TIẾT CÁC MẪU THANG
                ✅ THANG IN
                - Tải trọng 150kg
                - Là mẫu thang được thiết kế với các chất liệu sau:
                - Các bậc thang nôm phay xước vân nổi, tạo độ bám chân, tính thẩm mỹ cao
                - Bốn thanh dọc Inox sáng bóng, chống gỉ chịu lực tốt
                - Các chi tiết nhựa màu cam, phù hợp với không gian có tông màu ấm...
                - Phần đệm tay vịn mút cao su non, cho cảm giác êm tay khi sử dụng
                ✅ Thang BT
                - Được thiết kế với các chất liệu sau
                - Bậc thang nhôm được phay xước vân nổi tạo cảm giác bám chân
                - Bốn thanh dọc nhôm nhám, độ dầy lớn cho tải trọng cao, hình thức sang trọng
                - Các chi tiết nhựa màu đen trên tông màu nhôm trắng, phù hợp với những người thích thiết kế đen - trắng
                - Phần tay vịn không có mút nhằm tối giãn thiết kế, tạo sự tinh tế giãn đơn
                🔐 PHƯƠNG CHÂM VÀ CAM KẾT CỦA SHOP : 
                ✔️ Luôn bán hàng uy tín chất lượng
                ✔️ Chính sách bảo hành Sản phẩm 12 tháng
                ✔️ Hàng cam kết đúng trọng lượng của từng sản phẩm 
                ✔️ Hoàn hàng 3 ngày theo quy định của Shopee
                ✔️ Cam kết giống y như hình 100%
                ✔️ Cung cấp các sản phẩm theo đúng tiêu chuẩn với chất lượng tốt nhất,cam kết hàng giống hình 100%.
                ✔️ Giá cả hợp lý, cạnh tranh.
                ✔️ Đảm bảo về số lượng và đúng chủng loại khách đặt
                ✔️ Shop chỉ cung cấp những sản phẩm có chất lượng tốt nhất tới tay khách hàng.
                ✔️ QUÝ KHÁCH LƯU Ý: Khi nhận hàng nếu không hài lòng về chất lượng sản phẩm xin đừng vội đánh giá, hãy liên hệ ngay với SHOP để được hỗ trợ. 
                💎💎💎SỰ HÀI LÒNG CỦA KHÁCH HÀNG LUÔN LÀ MỤC TIÊU HƯỚNG ĐẾN CỦA SHOP 💎💎💎
                ⚠️ Lưu ý :  
                📌 Hàng đổi trả phải còn nguyên tem mác và không có dấu hiệu sử dụng
                📌 Khi shop nhận được hàng đổi trả sẽ chuyển ngay sản phẩm khác cho quý khách hoặc hoàn tiền theo hình thức chuyển khoản. 
                📌 Quý khách nên mua tổng lượng hàng phù hợp để được hưởng ưu đãi phí vận chuyển từ Shopee
                📌 Quý khách vui lòng chú ý điện thoại khi đặt hàng tránh trường hợp không liên lạc được để xác nhận đặt hàng và giao hàng.',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 7,
        ]);
        // product_id: 90
        Product::create([
            'name' => 'Giá treo quần áo gỗ chữ A Behomes 2 tầng - Nội thất phòng ngủ lắp ráp',
            'description' => '💥 LIÊN HỆ SHOP ĐỂ ĐƯỢC HỖ TRỢ PHÍ SHIP💥
                ➤➤ GIAO HÀNG HỎA TỐC TRONG NGÀY ➤➤ NHẮN TIN CHO SHOP ĐỂ LẤY LINK HỎA TỐC
                Chỉ áp dụng cho đơn hàng trong nội ô TP.HCM, hàng hỏa tốc được giao trong các khung giờ 9h – 14h – 17h mỗi ngày
                ➤➤ THÔNG TIN CHI TIẾT ➤➤ 
                •	Kích thước sản phẩm: 91 x 32 x 148 cm (Dài x Rộng x Cao) - Khoảng cách tầng 25cm 
                •	Kích thước đóng gói: 150 x 35 x 5 cm (Dài x Rộng x Cao)
                •	Cân nặng: 6.5kg 
                •	Chất liệu: Gỗ thông tự nhiên 100%
                •	Màu Sắc: 
                	Hàng không sơn (Mộc) 
                	Hàng có sơn (màu tự nhiên, trắng, đen)
                •	Xuất xứ: Việt Nam
                •	Chất lượng:Hàng Việt Nam xuất khẩu
                •	Sản xuất tại: Hung Tai Phat Audio Co,. Ltd
                ➤➤ HƯỚNG DẪN SỬ DỤNG VÀ BẢO QUẢN ➤➤
                Sản phẩm TỰ LẮP RÁP, sản phẩm được gửi kèm nguyên bộ dụng cụ lắp ráp bao gồm đinh vít, lục giác và giấy hướng dẫn 
                Bảo quản sản phẩm ở nơi khô ráo, thoáng mát; tránh tiếp xúc trực tiếp với nước hoặc môi trường ẩm ướt
                Khi gặp vấn đề trong quá trình sử dụng, quý khách vui lòng liên hệ shop để được hỗ trợ tốt nhất
                ➤➤ BẢO HÀNH / ĐỔI TRẢ ➤➤
                Đổi trả 1 đổi 1 miễn phí trong vòng 7 ngày
                Bào hành lên đến 12 tháng trong các trường hợp sau:
                •	Sản phẩm bị hư hỏng trong quá trình vận chuyển
                •	Sản phẩm có lỗi từ nhà sản xuất
                •	Sản phẩm nhận được khác với sản phẩm đã đặt (màu sắc, kích thước, mã sản phẩm,…)
                •	Lỗi kĨ thuật hoặc lỗi từ chất liệu của sản phẩm
                ',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 7,
        ]);
        // product_id: 91
        Product::create([
            'name' => 'Máy hút bụi cầm tay dodoto, máy hút bụi giường nệm mini không dây lực hút 20.000 Pa công suất 120w',
            'description' => 'Giới thiệu Máy hút bụi cầm tay dodoto
                Thông tin sản phẩm Máy hút bụi cầm tay dodoto
                Tên sản phẩm: Máy hút bụi cầm tay dodoto Premium
                Thương hiệu: dodoto
                Phân phối: dodoto shop
                Logo sản phẩm rõ nét in nổi sang trọng
                Nhựa máy là nhựa ABS cao cấp sang trọng
                Chắc năng: Hút bụi giường nệm, ô tô, sàn nhà, lông chó mèo, tóc...
                Khối lượng: 0.4 kg
                Lức hút: 25.000 Pa
                Công suất: 120w
                Củ sạc: 5V-2A
                Cách bảo hành: Liên hệ dodoto để được bảo hành
                Sử dụng 20-30 phút
                Thời gian sạc: 3-3.5h
                Đèn báo khi sạc: Màu xanh là đầy, màu đỏ là đang sạc
                * Đặc tính sản phẩm Máy hút bụi cầm tay dodoto Premium 2024
                Máy hút bụi cầm tay dodoto chính hãng nhựa ABS đẹp, sang trọng.
                Máy hút bụi cầm tay mini công suất cao hút bụi tốt
                Hút bụi đa năng, các bụi hạt to trên ô tô, ga giường, sofa...
                Thiết kế nhỏ ngọn hút bụi nhanh mọi ngóc ngách
                Miệng hút rộng lực hút mạnh giúp sạch gấp 3 lần máy thông thường
                Nhiều đầu hút đa năng giúp hút bụi sạch mọi ngóc ngách
                Máy hút bụi có thêm đầu hút ống mềm dài tiện lợi
                3 lớp lọc bụi dễ dàng tháo lắp và vệ sinh
                Là sản phẩm không thể thiếu cho mọi nhà
                Lọc hepa có thể rửa nước ( Lưu ý cần phơi khô lọc hepa trước khi sử dụng vì lọc hepa ẩm hoặc ướt máy không có lực hút)
                dodoto luôn đặt mục tiêu chất lượng dịch vụ lên hàng để để mang tới trải nghiệm mua hàng tốt nhất cho khách hàng. Chính sách bảo hành và bảo trì tốt và luôn lắng nghe để cải tiến chất lượng để phục vụ khách hàng tốt nhất.
                - Sản phẩm chất lượng chính hãng dodoto
                - Có tem và nhãn dãn dodoto trên sản phẩm
                - Tận tình tư vấn cũng như hỗ trợ khi khách hàng cần
                - Sản phẩm được kiểm tra kỹ trước khi giao cho bên vận chuyển
                - Sẵn hàng giao ngay khi nhận được đơn hàng
                - Giao hàng toàn quốc,  nhận hàng kiểm tra trước khi thanh toán',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 12,
        ]);
        // product_id: 92
        Product::create([
            'name' => 'Máy làm sữa hạt Gilux 15 chức năng + TẶNG Sách Công Thức, Độ Ồn Thấp-Nắp Inox (PHIÊN BẢN NÂNG CẤP)',
            'description' => 'Thông tin chi tiết
                Máy làm sữa hạt Gilux GLP18 -15 Chức năng, Máy xay  Độ Ồn thấp - Nắp Inox  (PHIÊN BẢN NÂNG CẤP) - GLP18 - Bảo hành 12 tháng - TẶNG  Sách Công Thức Sữa Hạt 
                💟 Thông tin sản phẩm: Máy làm sữa hạt Gilux 15 chức năng
                Sữa hạt chứa dồi dào dưỡng chất có lợi như: chất đạm, magie, kali, vitamin, chất chống oxy hóa... Và hầu hết các loại hạt đều chứa axit béo omega-6 - Một loại axit béo thiết yếu cần cho cơ thể. Chính vì vậy, sử dụng sữa hạt mỗi ngày giúp duy trì dưỡng chất cần thiết cho cơ thể.
                - Làm sữa hạt tại nhà đang là xu hướng trong hội chị em yêu bếp núc. Vì vậy, máy làm sữa hạt là sản phẩm bán chạy được “săn lùng” rất nhiều trong thời gian gần đây.
                - Máy xay sữa hạt  GILUX với thiết kế chuyên dụng
                   + có thể xay
                   + Nấu
                   +Làm sinh tố
                Xay nghiền các loại hạt ngũ cốc như: đậu nành, ngô, hạnh nhân, óc chó...và có chế độ nấu để làm sữa. Ngoài chức năng chính, chiếc máy này hoàn toàn có thể sử dụng để làm sinh tố hoa quả, nấu cháo hoặc súp.
                THÔNG SỐ KỸ THUẬT
                + Nhãn hiệu: GILUX
                + Chất liệu: Thủy tinh borosilicate, thép không gỉ 304
                + Công suất: xay 1100W, nấu 800W
                + Điện áp: 220V – 50Hz
                + Dung tích: 1.75l
                + Kích thước : 415*245*315mm
                *Máy bảo hành đổi mới 1 đổi 1 nếu có lỗi kỹ thuật trong vòng 15 ngày
                *Bảo hành 12 tháng.
                - HỖ TRỢ BẢO HÀNH ĐỔI HÀNG 15 NGÀY THEO CHÍNH SÁCH CỦA SHOPEE
                - Khi  lỗi do nhà sản xuất.
                - Khi giao sai màu/ Sai mẫu khách đã đặt hàng.
                - Khi giao thiếu hàng.
                - Hỗ Trợ đổi trả nếu sản phẩm KHÔNG đúng hình.',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 12,
        ]);
        // product_id: 93
        Product::create([
            'name' => 'Máy Đánh Trứng Cầm Tay 7 Tốc Độ Công Suất 180W Tặng 4 Đầu Khuấy Êm Ái, Máy Đánh Bơ Kem Đa Năng Tiện Dụng',
            'description' => '👋👋👋Chào mừng bạn đến với KANIC OFFICIAL – Shop MALL trênshopee bán các sản phẩm gia dụng với mức giá ưu đãi nhất 😍😍😍
                ✅ MÔ TẢSẢN PHẨM: Máy Đánh Trứng Cầm Tay KANIC 7 Tốc Độ Công Suất 180W Tặng 4 Đầu Khuấy Êm Ái, Máy Đánh Bơ Kem Đa Năng Tiện Dụng
                Máy Đánh Trứng Cầm Tay 7 Tốc Độ 180W + Tặng 4 Đầu Khuấy Chắc Chắn - Tiện Dụng
                Thông tin sản phẩm Máy Đánh Trứng Cầm Tay 7 Tốc Độ 180W + Tặng 4 Đầu Khuấy Chắc Chắn - Tiện Dụng
                - Tên sản phẩm: Máy Đánh Trứng Cầm Tay
                - Công nghệ: Nhật Bản 
                - Sản Xuất : Trung Quốc
                - Kích thước: 17x13x7cm (dài x rộng x cao)
                - Trọng lượng: 600gram
                - Công suất: 180W
                - Điện áp: 220–240V
                - Màu sắc: Trắng
                - Cuộc sống bận rộn, dành thời gian bên gia đình với các món ăn khoái khẩu góp phần làm ấm thêm tình cảm mọi người thân. Đối với người Việt Nam chúng ta những món trứng chiên, bánh Plan, bánh kem hay món bánh truyền thông làm từ bột luôn có mặt trong các bữa ăn, buổi tiệc sinh nhật, tiệc họp mặt. Công việc chuẩn bị nguyên liệu chế biến món ăn đó giờ đây vô cùng tiện dụng, dễ dàng và nhanh chóng với Máy Đánh Trứng 7 Tốc Độ, Thiết kế nhỏ gọn bạn không phải vất vả nhào bột, trộn trứng, rất tiết kiệm thời gian và điện năng.
                Máy Đánh Trứng Cầm Tay với 7 tốc độ đánh với công suất cực mạnh lên đến 180W
                - Máy có công suất cực mạnh 180W, Trên máy có 07 tốc độ đánh khác nhau, giúp bạn dễ dàng điều chỉnh mức độ đánh thích hợp trong quá trình sử dụng. Trong đó chức năng gia tốc nhanh và an toàn cho phép tốc độ tăng tối đa tùy ý.
                - Mức 1 & 2: Dùng cho thực phẩm cỡ lớn và đánh khô như bột mỳ, bơ, khoai tây…
                - Mức 3 & 4: Dùng để trộn hỗn hợp lõng như salad…
                - Mức 5: Dùng để trộn hỗn hợp để làm bánh, đồ ăn nhanh như bánh mỳ, bánh Flan..
                - Mức 6: Dùng để trộn bơ với đường, thực phẩm còn sống, đường miến…
                - Mức 7: Dùng đánh trứng, thực phẩm ở dạng lạnh như khoai tây, kem… Máy vận hành êm ái và ổn định cao.
                - Hoạt động êm ái và ổn định, không bị rung khi chạy với tốc độ manh, hỗ trợ tốt nhất cho chức năng đánh trứng, nhào bột và các loại thực phẩm khác.
                - Kiểu dáng sang trọng và hiện đại.
                🔄 CHÍNH SÁCH ĐỔI TRẢ
                Được chấp nhận đổi trả hoặc hoàn tiền khi đạt điều kiện:
                • Trong vòng 07 ngày kể từ thời điểm nhận hàng
                • Hàng hoá bị lỗi hoặc hư hỏng do vận chuyển hoặc do nhà sản xuất 
                • Hàng không giống như hình ảnh và video',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 12,
        ]);
        // product_id: 94
        Product::create([
            'name' => 'Dụng Cụ Bơm Hút Chất Lỏng LIGHTBULB Cầm Tay Tiện Lợi Thông Minh Dễ Sử Dụng',
            'description' => 'Dụng Cụ Bơm Hút Chất Lỏng LIGHTBULB Cầm Tay Tiện Lợi Thông Minh Dễ Sử Dụng
                ==================================
                🔐Chế độ bảo hành, đổi trả sản phẩm.
                ✅ Đổi trả sản phẩm trong vòng 7 ngày không cần lý do.
                ✅ Đổi mới sản phẩm trong vòng 30 ngày do lỗi của nhà sản xuất.
                ✅ Cam kết về chất lượng sản phẩm, hoàn tiền 💯% nếu hàng không đạt yêu cầu, kém chất lượng, sai mẫu mã.
                ✅ Quy trình làm việc chuyên nghiệp 
                ✅ Đội ngũ Support chuyên nghiệp 24/24 
                ==================================
                💔 Thông Tin Sản Phẩm
                » Màu Sắc: Đen
                » Chất liệu: nhựa PVC
                » Ống dài 1 mét . đường kính trong 14mm, tay bóp dài 20 cm
                » Bộ sản phẩm đầy đủ: 1 tay bóp dài 20cm, 1 ống PVC mềm trong suốt dài 1 mét và  1 khóa
                » Lưu ý khi sử dụng: quý khách nhớ lắp cho đúng chiều mũi tên được in nổi trên tay bóp
                ==================================
                💔 Đặc Điểm Nổi Bật:
                » Giờ đây bạn không cần lo lắng khi phải đổ chất lỏng từ can vào bình ô tô hay hút từ bình ra. Sản phẩm dụng cụ hút chất lỏng bóp tay sẽ giúp bạn làm việc đó một cách dễ dàng, đơn giản. Ngoài ra có thể ứng dụng để hút các chất lỏng khác như hút
                nước bể cá…
                » Sử dụng để chuyển nước, dầu hoặc các chất lỏng khác một cách nhanh chóng và một cách dễ dàng.
                » Cách sử dụng đơn giản, chỉ cần cắm ống hút và bóp tay để hút nước lên.',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 12,
        ]);
        // product_id: 95
        Product::create([
            'name' => 'Nồi điện đa năng Gaabor GR-N15A lẩu điện 1.5L chống dính công suất 600W ăn mì nấu lẩu kèm xửng hấp',
            'description' => 'NỒI ĐIỆN ĐA NĂNG DUNG TÍCH 1,5L GAABOR GR-N15A LÒNG NỒI 1L PHỦ LỚP CHỐNG DÍNH, CÔNG SUẤT 600W, ĐIỀU KHIỂN 2 MỨC NHIỆT - HÀNG CHÍNH HÃNG
                Bếp gọn gàng vẫn đầy đủ tiện nghi nhờ có nồi điện đa năng GAABOR GR-N15A. Cần nồi hấp, nồi ăn lẩu, nấu mì, nồi nấu cơm, nồi hầm canh, kho cá hay chiên thực phẩm,.. tất cả đều sẵn có chỉ với một chiếc nồi điện. 
                ĐẶC ĐIỂM SẢN PHẨM
                - Nồi điện đa năng Gaabor GR-N15A có dung tích 1,5L, thích hợp dùng cho 1-2 người ăn.
                - Lòng nồi chống dính tiện lợi, sử dụng ít dầu vẫn hạn chế thức ăn bị cháy khét khi nấu, dễ dàng vệ sinh, 
                - Trang bị xửng hấp kèm theo, có thể hấp trên nấu dưới, công suất 600W làm sôi nhanh chóng giúp bạn tiết kiệm thời gian tối đa. 
                - Thiết kế 2 lớp cho hiệu quả cách nhiệt tối đa, tay cầm chống trượt tiện lợi, hạn chế bỏng khi vô ý chạm vào.
                - Trang bị cơ chế tự ngắt điện khi nhiệt độ quá cao, chống đoản mạch, đảm bảo sự an toàn tuyệt đối. 
                2 mức nhiệt điều chỉnh bằng núm vặn dễ dàng sử dụng. Chỉ cần cắm điện để sử dụng, vô cùng tiện lợi khi nấu nướng các món chiên, xào, luộc, hấp, nấu canh,...
                - Tận dụng nồi điện đa năng như nồi lẩu điện mini cho những bữa tiệc nhỏ tại gia cũng vô cùng tiện lợi, nhanh gọn hoặc có thể sử dụng nồi như một chiếc nồi cơm điện mini. 
                Cùng Gaabor nuôi dưỡng niềm cảm hứng nấu ăn thơm ngon mỗi ngày ngày hôm nay!
                THÔNG SỐ KỸ THUẬT 
                - Thương hiệu: Gaabor
                - Model:  GR-N15A
                - Kích thước:  22x19x20 cm
                - Khối lượng: 959g
                - Dung tích: 1,5L
                - Dung tích lòng nồi: 1L
                - Công suất:: 600W
                - Màu sắc: Trắng 
                - Điện áp: 220-240V
                - Xuất xứ: Trung Quốc
                - Bảo hành: 12 tháng
                HƯỚNG DẪN SỬ DỤNG:
                - Bước 1: Đặt nồi điện đa năng lên mặt phẳng chịu nhiệt, cắm điện cho nồi
                - Bước 2: Lựa chọn mức nhiệt phù hợp và tiến hành chế biến món ăn.
                - Bước 3: Vệ sinh bên trong lòng nồi bằng xà phòng và nước ấm sau khi sử dụng
                KHUYẾN CÁO:
                - Khi vệ sinh nồi, chỉ vệ sinh bên trong lòng nồi, không đặt toàn bộ thân nồi vào chậu nước hay xả trực tiếp dưới nước.
                - Không để dây điện tiếp xúc với nước.
                THÔNG TIN CHĂM SÓC KHÁCH HÀNG
                Khi nhận được hàng hoặc trong quá trình sử dụng nếu gặp phải bất cứ vấn đề gì, quý khách hàng vui lòng liên hệ qua hộp chat (8:30 - 17:30, từ thứ 2 đến thứ 6) để được hỗ trợ sớm nhất có thể.
                CHÍNH SÁCH BẢO HÀNH
                - Bảo hành 1 đổi 1 trong 12 tháng với các lỗi phát sinh từ nhà sản xuất. 
                - Điều kiện bảo hành: sản phẩm còn đủ hộp và phụ kiện kèm theo. 
                - Áp dụng bảo hành đối với các trường hợp sản phẩm chính hay sản phẩm quà tặng rơi vỡ trong quá trình vận chuyển. Quý khách vui lòng quay video nhận hàng để được hỗ trợ nhanh nhất 
                - Không áp dụng bảo hành cho các trường hợp:
                + Sản phẩm là quà tặng kèm theo phát sinh lỗi do nhà sản xuất
                + Sản phẩm sử dụng pin bị chai sau thời gian dài sử dụng
                THÔNG TIN THƯƠNG HIỆU
                Gaabor - Nâng cao chất lượng cuộc sống với công nghệ tiên tiến và thiết kế Đức hiện đại!
                Gaabor là thương hiệu hàng đầu, kết hợp công nghệ tiên tiến và phong cách thiết kế Đức hiện đại, mang đến sự tiện lợi và thoải mái tối đa cho khách hàng. Cam kết của Gaabor về chất lượng và sự sáng tạo luôn không ngừng tiến bộ, không ngừng phát triển những sản phẩm mới trong lĩnh vực nhà bếp, thiết bị làm sạch, thiết bị gia đình và chăm sóc cá nhân.
                Với hơn mười năm kinh nghiệm chuyên sâu về công nghệ và tâm huyết với khách hàng, Gaabor đã nhanh chóng trở thành thương hiệu thiết bị gia dụng nhỏ được ưa chuộng nhất tại khu vực Đông Nam Á từ năm 2021.
                Hãy kỳ vọng Gaabor mang đến sự kết hợp hoàn hảo giữa tính năng, phong cách và công nghệ tiên tiến. Sự xuất hiện của Gaabor đại diện cho một thời đại mới của tiện nghi, nơi mọi gia đình có thể dễ dàng trải nghiệm cuộc sống tối ưu. Chúng tôi sử dụng các tính năng thông minh và tính ứng dụng cao, tạo ra những trải nghiệm đột phá, giúp gia đình bạn trở nên hiện đại và tiện nghi hơn bao giờ hết.',
            'status' => 'active',
            'seller_id' => 4,
            'category_id' => 12,
        ]);
        // product_id: 96
        Product::create([
            'name' => 'Sách - Bộ 2 Cuốn Bí Quyết Làm Chủ Photoshop Ứng Dụng Thực Tế - Tặng Video Hướng Dẫn + Sách Sổ Tay + Kho Tài Liệu',
            'description' => 'THÔNG TIN SẢN PHẨM QUYỂN 1
                - Sách Bí Quyết Làm Chủ Photoshop Ứng Dụng Thực Tế Thành Thạo Sau 21 Ngày sẽ giúp bạn:
                + Nắm được các nguyên lý về cách chỉnh sửa ảnh và tối ưu việc sử dụng Photoshop
                + Có thể chỉnh sửa ảnh phong cảnh theo ý muốn
                + Có thể tạo ra những bức ảnh động
                + Có thể làm được banner quảng cáo đa nền tảng
                - MỘT SỐ ĐIỀU NỔI BẬT CỦA SẢN PHẨM:
                + Sách có video hướng dẫn đi kèm
                + Có nhóm hỗ trợ giải đáp thắc mắc 24/24
                + Tặng kèm kho tài nguyên chỉnh sửa ảnh
                - Ngày xuất bản: 14/05/2024
                - Số trang: 212
                - Tác giả: Nguyễn Vũ Hoàng Hiệp
                - Nhà xuất bản: Nhà xuất bản Thanh Niên
                - Nhà phát hành: ANTBOOK
                - ISBN: 978-604-41-3448-2
                THÔNG TIN SẢN PHẨM QUYỂN 2
                - Sách Bí Quyết Làm Chủ Photoshop Ứng Dụng Thực Tế Thành Thạo Sau 21 Ngày (Quyển 2) sẽ giúp bạn:
                + Nắm được các nguyên lý về cách chỉnh sửa ảnh và tối ưu việc sử dụng Photoshop
                + Có thể chỉnh sửa ảnh phong cảnh theo ý muốn
                + Có thể tạo ra những bức ảnh động
                + Có thể làm được banner quảng cáo "độc" và "lạ"
                - MỘT SỐ ĐIỀU NỔI BẬT CỦA SẢN PHẨM:
                + Sách có video hướng dẫn đi kèm
                + Có nhóm hỗ trợ giải đáp thắc mắc 24/24
                + Tặng kèm kho tài nguyên chỉnh sửa ảnh dùng miễn phí
                - Ngày xuất bản: 14/05/2024
                - Số trang: 196
                - Tác giả: Nguyễn Vũ Hoàng Hiệp
                - Nhà xuất bản: Nhà xuất bản Thanh Niên
                - Nhà phát hành: ANTBOOK
                - ISBN: 978-604-41-3449-9',
            'status' => 'active',
            'seller_id' => 5,
            'category_id' => 8,
        ]);
        // product_id: 97
        Product::create([
            'name' => 'Combo 4 Cuốn: Tư Duy Mở + Tư Duy Ngược + Thao Túng Tâm Lý + Lý Thuyết Trò Chơi',
            'description' => 'Chào các bạn đọc giả yêu mến Thích Đọc Sách.
                Khách nhận hàng quay video bóc hàng giúp shop, bên shop chỉ hỗ trợ khiếu nại khi có video bóc hàng quay bill dán rõ ràng ạ   
                 Chúng tớ rất vui mừng và hân hoan thông báo đến các bạn về sự ra mắt của Cửa Hàng Mới Của Chúng Tớ, nơi mà chúng tớ cam kết mang đến cho bạn những cuốn sách tuyệt vời nhất. Để đánh dấu bước khởi đầu này, chúng tớ xin gửi tặng đến các bạn mã sale trực tiếp, giúp bạn tiết kiệm hơn khi mua.   
                 Tất cả các sản phẩm tại cửa hàng đều được đảm bảo là hàng mới 100%, đáp ứng tiêu chuẩn chất lượng cao nhất. Để chắc chắn rằng bạn luôn hài lòng với mỗi lần mua sắm tại shop, chúng tớ còn cam kết hoàn tiền nếu sản phẩm không đạt yêu cầu.   
                 Chúng tớ sẽ không ngừng cập nhật các sản phẩm mới nhất và những chương trình khuyến mãi hấp dẫn để mang đến cho bạn trải nghiệm mua sắm thú vị và tiết kiệm nhất.   
                 Shop mới thành lập sẽ không tránh được sai sót, mong nhận được góp ý của các bạn để chúng tớ ngày càng hoàn thiện hơn.   
                Cảm ơn bạn đã dành thời gian đọc tin này. Chúng tớ mong muốn được đồng hành cùng bạn trên hành trình mua sắm đầy sự tin tưởng và hài lòng.   
                Trân trọng,   
                 Đội ngũ của chúng tớ chúc bạn 1 ngày tốt lành, mãi yêu!!!!',
            'status' => 'active',
            'seller_id' => 5,
            'category_id' => 8,
        ]);
        // product_id: 98
        Product::create([
            'name' => 'Sách - Combo 2 Cuốn Biến Mọi Thứ Thành Tiền (Quyển 1+2) - SBOOKS',
            'description' => 'Tên sản phẩm: Combo 2 Cuốn Biến Mọi Thứ Thành Tiền 
                Tác giả/Dịch giả: Nguyễn Anh Dũng
                Nhà xuất bản: NXB Thế Giới
                Năm xuất bản: 2022 + 2023
                Nhà phát hành: Công ty CP Sbooks
                Kích thước sản phẩm: 20x13x2 (cm)
                Số trang: 548
                Hình thức bìa: Bìa mềm
                _____________________
                BIẾN MỌI THỨ THÀNH TIỀN
                - Quyển 1 và 2 của tác giả Nguyễn Anh Dũng là những chia sẻ rất sâu sắc của tác giả về tư duy để tạo ra dòng tiền lâu dài và bền vững dựa trên nền tảng của việc tạo ra giá trị.
                Cuốn sách thứ nhất giúp bạn nhận ra khát vọng để biến mọi nguồn lực xung quanh thành những thứ có giá trị để tạo ra tiền, cho bạn khát vọng và lý tưởng - điều quan trọng nhất tạo ra động lực thúc đẩy hành động và sáng tạo. Cuốn sách cũng giúp bạn trả lời được những câu hỏi lớn: Tại sao phải biến mọi nguồn lực thành tiền và tài sản, tại sao bạn chưa thể làm được điều này từ trước đến nay và bạn đã thực sự hiểu rõ về bản chất của tiền hay chưa.
                Cuốn sách thứ hai chính là cụ thể hóa việc ứng dụng tư duy vào thực tiễn cuộc sống để biến mọi thứ thành tiền. Ở cuốn sách này bạn sẽ nhận diện một cách chính xác và rõ ràng những nguồn lực xung quanh để tạo ra tiền và tài sản, đồng thời giúp bạn có động lực để ứng dụng.               
                Thông qua hai cuốn sách, tác giả giúp người đọc có thể hiểu thấu hơn về cách vận dụng các quy luật tự nhiên và xã hội vào sản xuất, kinh doanh, sáng tạo hay cung cấp dịch vụ, trong đó điều cốt lõi là tạo ra các giải pháp để giải quyết những vấn đề của xã hội, của nhân loại, giúp xã hội ngày càng phát triển, văn minh và phồn thịnh hơn.
                Và bởi vận dụng các quy luật tự nhiên, xã hội - là quy luật phổ quát và bao trùm nên tư duy và giải pháp có thể ứng dụng trên mọi mặt của đời sống, mọi ngành nghề, mọi lĩnh vực từ vi mô đến vĩ mô và từ cá nhân tới tập thể. Có thể nói đây giống như một công thức bất biến, chỉ cần đưa giá trị bất kỳ vào và tạo ra kết quả. Kết quả chắc chắn sẽ có nhưng đạt được ở mức độ nào sẽ tùy thuộc vào giá trị mà bạn "lắp" vào công thức đó mà thôi.
                ______________________
                SBOOKS CAM KẾT:
                - Mọi đơn hàng đều được đóng gói tỉ mỉ và cẩn thận.
                - Sbooks luôn có chương trình tốt cho mọi đơn hàng.
                - Đổi trả sản phẩm trong vòng 7 ngày nếu lỗi từ nhà sản xuất.
                ______________________
                SỨ MỆNH:
                - Sbooks được hình thành bởi sứ mệnh lan tỏa trí tuệ đến với mọi người.
                - Sbooks luôn hi vọng mỗi sản phẩm được quý khách hàng lựa chọn sẽ mang lại nhiều giá trị cho bản thân.',
            'status' => 'active',
            'seller_id' => 5,
            'category_id' => 8,
        ]);
        // product_id: 99
        Product::create([
            'name' => 'Sách - Khéo Ăn Nói Được Thiên Hạ - SBOOKS',
            'description' => 'THÔNG TIN TÁC PHẨM
                Tên tác phẩm: Khéo Ăn Nói Được Thiên Hạ - SBOOKS
                Tác giả: Mỹ Thuận
                Thể loại: Tâm Lý Hoc & Mối Quan Hệ
                Nhà xuất bản: NXB Văn Học
                Năm xuất bản: 2023
                Loại bìa: Bìa mềm
                Khổ: 13x20,5 (cm)
                Số trang: 248
                KHÉO ĂN NÓI, ĐƯỢC THIÊN HẠ: NGHỆ THUẬT NÓI CHUYỆN VÀ CHIẾN LƯỢC GIAO TIẾP GIÚP THẾ GIỚI VẬN HÀNH THEO Ý BẠN
                Có người cho rằng ngôn ngữ là cầu nối giao tiếp giữa người với người, là một phương thức để “chào hàng” bản thân, những cuộc trò chuyện vui vẻ dễ tạo ra cơ hội, người biết ăn nói dễ nắm bắt cơ hội hơn. Cũng có người cho rằng, việc im lặng, giữ mồm giữ miệng có thể ngăn chặn họa từ miệng mà ra, và rất nhiều người trải đời luôn khuyên người khác hãy nghe nhiều hơn và nói ít lại. Những người ít nói thường tạo cho người khác cảm giác bí hiểm và khó hiểu; còn với người ăn nói bộc tuệch, chỉ sau dăm ba câu đã bị người khác nhìn thấu tâm can.
                Không biết giao tiếp sẽ khiến bạn bỏ lỡ rất nhiều cơ hội trong công việc, đồng thời cũng khiến bạn thường xuyên xảy ra bất hòa với người yêu, bạn bè, thậm chí dẫn đến việc chấm dứt mối quan hệ. Khi thế giới ngày càng rộng mở, con người cũng ngày càng năng động hơn. Nếu một người thậm chí không có can đảm và khả năng nói ra suy nghĩ của mình thì thần may mắn sẽ không bao giờ mỉm cười với anh ta.
                Cuốn sách KHÉO ĂN NÓI, ĐƯỢC THIÊN HẠ gồm nhiều tình huống thực tế trong cuộc sống như sự nghiệp, gia đình và tình yêu, sử dụng một lượng lớn các tình huống, câu chuyện thú vị để trình bày cho người đọc từng kỹ năng diễn đạt. Các câu chuyện không chỉ sống động và thú vị, hấp dẫn mà đồng thời còn kích thích tư duy của người đọc. Cuốn sách cũng cung cấp cho người đọc một số lượng lớn kỹ năng diễn đạt thực tế, giúp người đọc biến việc diễn đạt thành một bộ môn nghệ thuật và một dạng năng lực. Mục đích của chúng tôi là để những người không dám nói không còn im lặng và để những người dám nói trau dồi một “cái lưỡi hoàn hảo” để mối quan hệ cá nhân của bạn không bị xáo trộn hay rối tung lên chỉ vì không biết bày tỏ hay diễn đạt như thế nào.
                ______________________
                SBOOKS CAM KẾT:
                - Mọi đơn hàng đều được đóng gói tỉ mỉ và cẩn thận.
                - Sbooks luôn có chương trình tốt cho mọi đơn hàng.
                - Đổi trả sản phẩm trong vòng 7 ngày nếu lỗi từ nhà sản xuất.
                ______________________
                SỨ MỆNH:
                - Sbooks được hình thành bởi sứ mệnh lan tỏa trí tuệ đến với mọi người.
                - Sbooks luôn hi vọng mỗi sản phẩm được quý khách hàng lựa chọn sẽ mang lại nhiều giá trị cho bản thân.
                *****************
                Sbooks biết rằng người đọc có rất nhiều sự lựa chọn nhưng lại dành sự lựa chọn đó cho Sbooks, Sbooks xin chân thành cảm ơn sâu sắc đến người đọc. Chúc Quý Khách Hàng có 1 ngày mua sắm vui vẻ ^^!!!',
            'status' => 'active',
            'seller_id' => 5,
            'category_id' => 8,
        ]);
        // product_id: 100
        Product::create([
            'name' => 'Sách - Khéo Léo Bắt Chuyện + Biến Giao Tiếp Thành Thế Mạnh + Từ Chiến Thuật Tới Chiến Thắng { Combo & Có Lẻ }',
            'description' => 'Sách KHÉO LÉO BẮT CHUYỆN - GIẢM 45% + MIỄN PHÍ VẬN CHUYỂN + TẶNG QUÀ ĐẶC BIỆT
                ❓BẠN CÓ PHẢI LÀ NGƯỜI GIAO TIẾP TỐT?
                ♻️Ai cũng biết giao tiếp tốt là chìa khóa số 1 để thành công. Ai cũng đã từng tìm cách để cải thiện kỹ năng giao tiếp của mình. Nhưng, 80% chúng ta đều thất bại trong việc phát triển kỹ năng giao tiếp. Lý do vì sao lại như vậy? Thực ra, chúng ta bị rơi vào trạng thái "bội thực" kiến thức, vì có quá nhiều sách phát triển kỹ năng trên thị trường; đồng thời cũng có quá nhiều chuyên gia ngôn ngữ khiến bạn rơi vào trạng thái "loạn". Bởi vậy, việc chọn sách nào cho đúng, cho phù hợp với bản thân là điều khó khăn nhất.
                ✅Đây chính là cuốn sách giúp bạn giải đáp những vấn đề trên:
                🌟Cuốn sách “KHÉO LÉO BẮT CHUYỆN” sẽ cho bạn:
                - Giành được lợi thế trong mọi tình huống giao tiếp
                - Bạn sẽ biết cách xử lý tính huống khéo léo mà không làm mất lòng đối phương
                - Bạn sẽ nhận được sự tôn trọng, yêu quý đền từ mọi người
                - Bạn sẽ biết phân biệt được thế nào là "lời nói chân thành", thế nào là lời nói nịnh nọt.
                - Bạn sẽ biết cách giành thắng lợi bằng "ngôn ngữ cơ thể" chứ không phải bằng lời nói
                💝Mồm miệng đỡ chân tay! KỸ NĂNG QUAN TRỌNG NHẤT LÀ KỸ NĂNG NGÔN NGỮ.
                ĐỪNG TỪ CHỐI ĐẦU TƯ CHO CHÍNH CUỘC ĐỜI CỦA MÌNH!
                Giảm 45% - Sách Từ Chiến Thuật đến Chiến Thắng - Miễn phí vận chuyển
                GIỎI LẬP CHIẾN LƯỢC SẼ CHIẾN THẮNG THIÊN HẠ
                🚫 Bạn đang gặp những vấn đề sau:
                - Thật thà, có năng lực lại thua thiệt với những kẻ thảo mai
                khéo nói
                - Cảm thấy suy nghĩ nông cạn, hạn hẹp, làm việc theo bản năng
                - Gặp bất bình là nóng giận ra mặt khiến thua cuộc ngay lập tức
                - Tâm lý sợ hãi trước những người tự tin hoặc cấp trên,..
                👉 Đây chính là giải pháp cho bạn:
                ✅ Với 3 PHẦN, 8 CHƯƠNG, 30 BÀI HỌC, 60 VÍ DỤ cụ thể sẽ dạy bạn biết cách thao túng tâm lý, dùng mưu lược thông minh để ứng phó với từng tình huống cụ thể giúp bạn đạt được mục tiêu để thăng tiến dễ dàng.
                ✅ Điểm nổi bật của cuốn sách này:
                1. Biến phản ứng tự nhiên thành tư duy chiến lược
                2. Phân tích nguyên lý vận hành chiến thuật
                3. Minh họa chi tiết qua các ví dụ thực tế từ nhiều lĩnh vực
                4. Đi từ lý thuyết đến thực hành
                ✅Thành công không có từ một công thức chung cho tất cả. Mỗi người cần có phương pháp và công cụ phù hợp để khai thác tiềm năng cá nhân và nắm bắt cơ hội. Điều cốt lõi là bạn phải hiểu chính mình – đó mới chính là chìa khóa
                ❤️‍🩹Đừng để sự thiếu hiểu biết, suy nghĩ nông cạn nhấn chìm, đẩy bạn xuống cái hố của xã hội.
                📚 Sách "Biến Giao Tiếp Thành Thế Mạnh" – Chìa Khóa Để Bạn Thành Công Trong Mọi Cuộc Giao Tiếp!
                Bạn cảm thấy khó khăn trong việc thể hiện quan điểm? Hay đôi khi không thể kết nối với người khác một cách hiệu quả? Sách "Biến Giao Tiếp Thành Thế Mạnh" là cuốn sách dành cho những ai muốn nâng cao kỹ năng giao tiếp của mình, giúp bạn dễ dàng tạo ấn tượng và xây dựng các mối quan hệ bền chặt, từ công việc đến cuộc sống cá nhân.
                💡 Ưu Điểm Nổi Bật Của Sách:
                Phương pháp tiếp cận khoa học: Cuốn sách cung cấp những nguyên lý đơn giản nhưng mạnh mẽ để cải thiện khả năng giao tiếp của bạn.
                Công cụ thực hành: Bạn sẽ được hướng dẫn cách áp dụng ngay lập tức vào các tình huống giao tiếp thực tế.
                Kỹ thuật giao tiếp tự tin và thuyết phục: Học cách làm chủ lời nói và hành động để tạo ra ảnh hưởng tích cực lên người khác.
                🔥 Tại Sao Bạn Cần Cuốn Sách Này?
                - Khả năng giao tiếp quyết định thành công: Bất kể bạn là ai, trong môi trường công sở hay cuộc sống cá nhân, giao tiếp luôn là yếu tố then chốt để xây dựng sự nghiệp và các mối quan hệ.
                - Giải pháp cho những người thiếu tự tin: Nếu bạn không thể diễn đạt rõ ràng ý tưởng của mình, cuốn sách này sẽ giúp bạn cải thiện khả năng nói trước đám đông và tăng sự tự tin trong mọi tình huống.
                - Đối tượng đọc: mọi lứa tuổi và nghề nghiệp: Dù bạn là sinh viên, người đi làm hay người quản lý, cuốn sách này đều có thể giúp bạn nâng cao kỹ năng giao tiếp một cách nhanh chóng và hiệu quả.',
            'status' => 'active',
            'seller_id' => 5,
            'category_id' => 8,
        ]);
        // product_id: 101
        // Product::create([
        //     'name' => '',
        //     'description' => '',
        //     'status' => 'active',
        //     'seller_id' => 5,
        //     'category_id' => 10,
        // ]);
        // // product_id: 102
        // Product::create([
        //     'name' => '',
        //     'description' => '',
        //     'status' => 'active',
        //     'seller_id' => 5,
        //     'category_id' => 10,
        // ]);
        // // product_id: 103
        // Product::create([
        //     'name' => '',
        //     'description' => '',
        //     'status' => 'active',
        //     'seller_id' => 5,
        //     'category_id' => 10,
        // ]);
        // // product_id: 104
        // Product::create([
        //     'name' => '',
        //     'description' => '',
        //     'status' => 'active',
        //     'seller_id' => 5,
        //     'category_id' => 10,
        // ]);
        // // product_id: 105
        // Product::create([
        //     'name' => '',
        //     'description' => '',
        //     'status' => 'active',
        //     'seller_id' => 5,
        //     'category_id' => 10,
        // ]);
    }
}
