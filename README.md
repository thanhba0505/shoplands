<!-- Improved compatibility of Về đầu trang link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->

<a id="readme-top"></a>

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://shoplands.store/">
    <img src="https://backend.shoplands.store/src/Storage/public/app/logo-1.png" alt="Logo" width="200" style="object-fit: cover;">
  </a>

<h3 align="center" id="san-thuong-mai-dien-tu-shoplands">Sàn thương mại điện tử Shoplands</h3>

  <p align="center">
    Đồ án tốt nghiệp
    <br />
    <!-- <a href="https://github.com/github_username/repo_name"><strong>Explore the docs »</strong></a>
    <br /> -->
    <br />
    <a href="https://shoplands.store/">Truy cập website</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Mục lục</summary>
  <ol>
    <li>
      <a href="#ve-du-an">Về dự án</a>
      <ul>
        <li><a href="#thanh-vien">Thành viên</a></li>
        <li><a href="#cong-nghe-su-dung">Công nghệ sử dụng</a></li>
      </ul>
    </li>
    <li>
      <a href="#huong-dan-su-dung">Hướng dẫn sử dụng</a>
      <ul>
        <li><a href="#doi-voi-nguoi-mua">1. Đối với người mua</a></li>
        <li><a href="#doi-voi-nguoi-ban">2. Đối với người bán</a></li>
        <li><a href="#doi-voi-quan-tri-vien">3. Đối với quản trị viên</a></li>
      </ul>
    </li>
    <li>
      <a href="#mo-ta-code-du-an">Mô tả code dự án</a>
      <ul>
        <li><a href="#cau-truc-thu-muc">Cấu trúc thư mục</a></li>
        <li><a href="#phuong-phap-bao-mat">Phương pháp bảo mật</a></li>
      </ul>
    </li>
  </ol>
</details>

<!-- VỀ DỰ ÁN -->

<h2 id="ve-du-an">I. Về dự án</h2>

`Shoplands` là dự án xây dựng hệ thống sàn thương mại điện tử đa người dùng, cho phép người bán đăng sản phẩm, quản lý đơn hàng và tương tác với khách hàng trên một giao diện hiện đại, thân thiện.

Dự án được phát triển với mục tiêu mô phỏng quy trình kinh doanh trực tuyến thực tế, hỗ trợ các chức năng như tìm kiếm sản phẩm, giỏ hàng, thanh toán, đánh giá và quản lý tài khoản. `Shoplands` hướng đến việc tạo ra một môi trường mua sắm số tiện lợi, an toàn và dễ mở rộng trong tương lai.

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<a id="thanh-vien"></a>

<h3 id="thanh-vien">1. Thành viên</h3>

- `Lê Thanh Bá` - Sinh viên năm 4 (2021-2025) ngành Hệ thống thông tin Trường Đại học Công nghiệp Thành phố Hồ Chí Minh
- `Phạm Ngọc Tuấn` - Sinh viên năm 4 (2021-2025) ngành Hệ thống thông tin Trường Đại học Công nghiệp Thành phố Hồ Chí Minh

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<h3 id="cong-nghe-su-dung">2. Công nghệ sử dụng</h3>

- [![React][React.js]][React-url]
- [![Laravel][Laravel.com]][Laravel-url]
- [![MUI][MUI.com]][MUI-url]

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<!-- GETTING STARTED -->

<h2 id="huong-dan-su-dung">II. Hướng dẫn sử dụng</h2>

> ⚠️ **Quan trọng:** Nên đọc trước khi sử dụng trang web.

> ℹ️ **Ghi chú 1:** Mỗi tài khoản chỉ có thể đăng nhập trên 1 thiết bị, nên khi đăng nhập trên thiết bị khác thì bên đây sẽ đăng xuất.

> ℹ️ **Ghi chú 2:** Do trang web sử dụng nền tảng Twilio miễn phí nên không thể gửi tin nhắn cho nhiều số điện thoại nên người dùng cần truy cập vào <a href="https://backend.shoplands.store/view/message">đây</a> để xem tin nhắn.

> ℹ️ **Ghi chú 3:** Khi đặt hàng, vào <a href="https://sandbox.vnpayment.vn/apis/vnpay-demo">đây</a> để lấy thông tin thẻ test của VNPAY.

> ℹ️ **Ghi chú 4:** Sau khi đặt hàng, vào <a href="https://giaohangnhanh.shoplands.store/update-status">đây</a> để điều chỉnh trạng thái đơn hàng.

> ℹ️ **Ghi chú 5:** Để tra cứu thông tin vận chuyển của đơn hàng, vào <a href="https://giaohangnhanh.shoplands.store/order-detail">đây</a> và nhập mã vận chuyển.

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<!-- Đối với người mua -->

<h3 id="doi-voi-nguoi-mua">1. Đối với người mua</h3>

Đăng ký tài khoản tại: <a href="https://shoplands.store/register">https://shoplands.store/register</a>

Hoặc đăng nhập tại: <a href="https://shoplands.store/login">https://shoplands.store/login</a>

Một số tài khoản người mua:

| ------ Tên người mua ------ | ------ Số điện thoại ------ | ------ Mật khẩu ------ |
| :-------------------------: | :-------------------------: | :--------------------: |
|         Ngô Thị Hai         |         0811138364          |       763gdu3ew5       |
|         Lê Văn Tâm          |         0887373235          |       koiwer9823       |
|        Phạm Thị Ngọc        |         0866445533          |      12sf234sdf3       |
|       Hoàng Văn Bình        |         0839444478          |       09jif8jr43       |

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<!-- Đối với người bán -->

<h3 id="doi-voi-nguoi-ban">2. Đối với người bán</h3>

Đăng ký tài khoản tại: <a href="https://shoplands.store/register-seller">https://shoplands.store/register-seller</a>

Hoặc đăng nhập tại: <a href="https://shoplands.store/login">https://shoplands.store/login</a>

Một số tài khoản người bán:

| ------ Tên người bán ------ | ------ Số điện thoại ------ | ------ Mật khẩu ------ |
| :-------------------------: | :-------------------------: | :--------------------: |
|     Phụ Kiện Sành Điệu      |         0883468773          |       fet3sd45w        |
|        Công Nghệ Số         |         0824666345          |      sdfh356edrt       |
|       Nhà Cửa Online        |         0822646477          |      s723fkrsdfa       |
|      Thể Thao và Sách       |         0829088908          |       24dfuyu63u       |

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<!-- Đối với quản trị viên -->

<h3 id="doi-voi-quan-tri-vien">3. Đối với quản trị viên</h3>

> ℹ️ **Ghi chú:** Tài khoản quản trị viên chỉ có 1 nên không thể đăng ký.

Hoặc đăng nhập tại: <a href="https://shoplands.store/login">https://shoplands.store/login</a>

Tài khoản quản trị viên:

| ------ Số điện thoại ------ | ------ Mật khẩu ------ |
| :-------------------------: | :--------------------: |
|         0833333333          |          123           |

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<h2 id="mo-ta-code-du-an">III. Mô tả code dự án</h2>

<h3 id="cau-truc-thu-muc">1. Cấu trúc thư mục</h3>

- `$document`: chứa tài liệu của dự án
- `BACKEND`: sử dụng PHP thuần xây dựng api cho trang web
- `FRONTEND`: sử dụng React kết hợp Material UI xây dựng giao diện
- `DATABASE`: sử dụng Laravel lưu cấu trúc và tạo dữ liệu cho database
- `APIGHN`: ban đầu sử dụng api của GiaoHangNhanh cho việc giao hàng nhưng api đó thường xuyên lỗi nên phải tạo thư mục này mô phỏng lại api của GiaoHangNhanh

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<h3 id="phuong-phap-bao-mat">2. Phương pháp bảo mật</h3>

<h4 id="ma-hoa-du-lieu-nhay-cam">a. Mã hóa dữ liệu nhạy cảm</h4>

- Mã hóa 1 chiều: Dùng cho các dữ liệu không thể khôi phục lại như mật khẩu người dùng, mã xác nhận. Trang web sử dụng thuật toán ARGON2I kết hợp khóa bí giúp bảo vệ mật khẩu ngay cả khi cơ sở dữ liệu bị xâm nhập.

- Mã hóa 2 chiều: Dùng cho các dữ liệu có thể cần phải giải mã để sử dụng sau này như số điện thoại, thông tin thẻ ngân hàng. Dự án sử dụng thật toán AES-256-CBC kết hợp khóa bí mật để bảo vệ các dữ liệu này.

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<h4 id="xac-thuc-nguoi-dung">b. Xác thực người dùng</h4>

- Khi đăng nhập, backend sẽ dùng JWT trả về access-token và refresh-token, sau đó frontend lưu vào redux. Với mỗi yêu cầu gửi lên backend sẽ phải kèm theo access-token trong header để xác thực người dùng và vai trò của họ qua middleware.

- Access-token có thời gian ngắn nên khi hết thời gian, frontend sẽ phải gửi refresh-token để lấy lại access-token và refresh token mới và lưu lại vào redux.

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<h4 id="xac-thuc-sms">c. Xác thực SMS</h4>

- Để chống tấn công brute-force khi đăng nhập, đăng ký, người dùng phải xác thực thông qua mã OTP gửi về điện thoại. Hệ thống cũng lưu REMOTE_ADDR và HTTP_USER_AGENT của trình duyệt vừa mới đăng nhập và khi đăng nhập lại 1 trình duyệt khác cũng sẽ yêu cầu nhập mã OTP.

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<h4 id="chong-tan-cong-csrf">d. Chống tấn công CSRF</h4>

<!-- - Hệ thống chống tấn công CSRF bằng cách sử dụng CSRF Tokens trong tất cả các yêu cầu gửi từ phía -->

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<h4 id="ghi-du-lieu">e. Ghi dữ liệu</h4>

- Hệ thống ghi lại một số dữ liệu như các lần đăng nhập của người dùng gồm địa chỉ IP, thời gian để nhanh chóng phát hiện các hành vi đáng ngờ.

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<h4 id="cau-hinh-cors">f. Cấu hình CORS</h4>

- Hệ thống backend được cấu hình CORS chỉ cho phép duy nhất địa chỉ của frontend được phép truy cập api. Việc này hạn chế các mối đe dọa từ các tấn công cross-origin.

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<h4 id="cau-hinh-cors">g. Chống SQL Injection</h4>

- Để bảo vệ hệ thống khỏi SQL Injection, hệ thống sử dụng PDO (PHP Data Objects). PDO cung cấp một cách an toàn và chuẩn mực để tương tác với cơ sở dữ liệu, thông qua các câu truy vấn chuẩn bị (prepared statements). Điều này giúp ngăn chặn SQL Injection vì tất cả các tham số truyền vào câu truy vấn được xử lý như dữ liệu, chứ không phải là một phần của câu truy vấn SQL.

<p align="right">(<a href="#readme-top">Về đầu trang</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[React.js]: https://img.shields.io/badge/React-23272f?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[MUI.com]: https://img.shields.io/badge/MaterialUI-007FFF?style=for-the-badge&logo=mui&logoColor=white
[MUI-url]: https://mui.com/
