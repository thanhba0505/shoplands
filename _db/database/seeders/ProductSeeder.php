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
    }
}
