import {
  Box,
  Typography,
  Link,
  Container,
  List,
  ListItem,
  ListItemText,
  Table,
  TableBody,
  TableCell,
  TableRow,
  Paper,
  Chip,
  TableContainer,
  Grid2,
} from "@mui/material";

const About = () => {
  return (
    <Container maxWidth="md" sx={{ py: 4 }}>
      {/* Project Logo */}
      <Box sx={{ textAlign: "center", mb: 4 }}>
        <Link target="_blank" href="https://shoplands.vercel.app/" underline="none">
          <Box
            sx={{
              display: "inline-block",
              width: 200,
              height: 200,
              position: "relative",
            }}
          >
            <img
              src="https://backend.shoplands.store/src/Storage/public/app/logo-1.png"
              alt="Logo Shoplands"
              style={{
                height: 200,
                width: 200,
              }}
            />
          </Box>
        </Link>

        <Typography
          variant="h4"
          component="h1"
          mt={2}
          gutterBottom
          id="san-thuong-mai-dien-tu-shoplands"
        >
          Sàn thương mại điện tử Shoplands
        </Typography>

        <Typography variant="subtitle1" gutterBottom>
          Đồ án tốt nghiệp
        </Typography>

        <Link
          target="_blank"
          href="https://shoplands.vercel.app/"
          variant="body1"
          color="primary"
        >
          Truy cập website
        </Link>
      </Box>

      {/* About Project */}
      <Box id="ve-du-an" sx={{ mb: 4 }}>
        <Typography variant="h5" component="h2" gutterBottom>
          I. Về dự án
        </Typography>

        <Paper
          elevation={0}
          sx={{ p: 2, mb: 2, backgroundColor: "action.hover" }}
        >
          <Typography component="span" sx={{ fontWeight: "bold" }}>
            Shoplands
          </Typography>
          <Typography component="span">
            {" "}
            là dự án xây dựng hệ thống sàn thương mại điện tử đa người dùng, cho
            phép người bán đăng sản phẩm, quản lý đơn hàng và tương tác với
            khách hàng trên một giao diện hiện đại, thân thiện.
          </Typography>
        </Paper>

        <Typography>
          Dự án được phát triển với mục tiêu mô phỏng quy trình kinh doanh trực
          tuyến thực tế, hỗ trợ các chức năng như tìm kiếm sản phẩm, giỏ hàng,
          thanh toán, đánh giá và quản lý tài khoản.{" "}
          <Typography component="span" sx={{ fontWeight: "bold" }}>
            Shoplands
          </Typography>{" "}
          hướng đến việc tạo ra một môi trường mua sắm số tiện lợi, an toàn và
          dễ mở rộng trong tương lai.
        </Typography>
      </Box>

      {/* Members */}
      <Box id="thanh-vien" sx={{ mb: 4 }}>
        <Typography variant="h6" component="h3" gutterBottom>
          1. Thành viên
        </Typography>

        <Typography>
          -{" "}
          <Typography component="span" sx={{ fontWeight: "bold" }}>
            Lê Thanh Bá
          </Typography>{" "}
          - Sinh viên năm 4 (2021-2025) ngành Hệ thống thông tin Trường Đại học
          Công nghiệp Thành phố Hồ Chí Minh
        </Typography>
        <Typography>
          -{" "}
          <Typography component="span" sx={{ fontWeight: "bold" }}>
            Phạm Ngọc Tuấn
          </Typography>{" "}
          - Sinh viên năm 4 (2021-2025) ngành Hệ thống thông tin Trường Đại học
          Công nghiệp Thành phố Hồ Chí Minh
        </Typography>
      </Box>

      {/* Technologies */}
      <Box id="cong-nghe-su-dung" sx={{ mb: 4 }}>
        <Typography variant="h6" component="h3" gutterBottom>
          2. Công nghệ sử dụng
        </Typography>

        <Grid2 container spacing={2} sx={{ mb: 2 }}>
          <Grid2>
            <Chip
              label="React"
              component="a"
              href="https://reactjs.org/"
              clickable
              sx={{ backgroundColor: "#23272f", color: "white" }}
            />
          </Grid2>
          <Grid2>
            <Chip
              label="Laravel"
              component="a"
              href="https://laravel.com"
              clickable
              sx={{ backgroundColor: "#FF2D20", color: "white" }}
            />
          </Grid2>
          <Grid2>
            <Chip
              label="MUI"
              component="a"
              href="https://mui.com/"
              clickable
              sx={{ backgroundColor: "#007FFF", color: "white" }}
            />
          </Grid2>
        </Grid2>
      </Box>

      {/* User Guide */}
      <Box id="huong-dan-su-dung" sx={{ mb: 4 }}>
        <Typography variant="h5" component="h2" gutterBottom>
          II. Hướng dẫn sử dụng
        </Typography>

        <Paper
          elevation={0}
          sx={{ p: 2, mb: 2, backgroundColor: "warning.light" }}
        >
          <Typography sx={{ fontWeight: "bold" }}>⚠️ Quan trọng:</Typography>{" "}
          Nên đọc trước khi sử dụng trang web.
        </Paper>

        <Paper
          elevation={0}
          sx={{ p: 2, mb: 2, backgroundColor: "info.light" }}
        >
          <Typography>
            <Typography component="span" sx={{ fontWeight: "bold" }}>
              ℹ️ Ghi chú 1:
            </Typography>{" "}
            Mỗi tài khoản chỉ có thể đăng nhập trên 1 thiết bị, nên khi đăng
            nhập trên thiết bị khác thì bên đây sẽ đăng xuất.
          </Typography>
          <Typography>
            <Typography component="span" sx={{ fontWeight: "bold" }}>
              ℹ️ Ghi chú 2:
            </Typography>{" "}
            Do trang web sử dụng nền tảng Twilio miễn phí nên không thể gửi tin
            nhắn cho nhiều số điện thoại nên người dùng cần truy cập vào{" "}
            <Link
              target="_blank"
              href="https://backend.shoplands.store/view/message"
            >
              đây
            </Link>{" "}
            để xem tin nhắn.
          </Typography>
          <Typography>
            <Typography component="span" sx={{ fontWeight: "bold" }}>
              ℹ️ Ghi chú 3:
            </Typography>{" "}
            Khi đặt hàng, vào{" "}
            <Link
              target="_blank"
              href="https://sandbox.vnpayment.vn/apis/vnpay-demo"
            >
              đây
            </Link>{" "}
            để lấy thông tin thẻ test của VNPAY.
          </Typography>
          <Typography>
            <Typography component="span" sx={{ fontWeight: "bold" }}>
              ℹ️ Ghi chú 4:
            </Typography>{" "}
            Sau khi đặt hàng, vào{" "}
            <Link
              target="_blank"
              href="https://giaohangnhanh.shoplands.store/update-status"
            >
              đây
            </Link>{" "}
            để điều chỉnh trạng thái đơn hàng.
          </Typography>
          <Typography>
            <Typography component="span" sx={{ fontWeight: "bold" }}>
              ℹ️ Ghi chú 5:
            </Typography>{" "}
            Để tra cứu thông tin vận chuyển của đơn hàng, vào{" "}
            <Link
              target="_blank"
              href="https://giaohangnhanh.shoplands.store/order-detail"
            >
              đây
            </Link>{" "}
            và nhập mã vận chuyển.
          </Typography>
        </Paper>
      </Box>

      {/* For Buyers */}
      <Box id="doi-voi-nguoi-mua" sx={{ mb: 4 }}>
        <Typography variant="h6" component="h3" gutterBottom>
          1. Đối với người mua
        </Typography>

        <Typography>
          Đăng ký tài khoản tại:{" "}
          <Link target="_blank" href="https://shoplands.vercel.app/register">
            https://shoplands.vercel.app/register
          </Link>
        </Typography>
        <Typography>
          Hoặc đăng nhập tại:{" "}
          <Link target="_blank" href="https://shoplands.vercel.app/login">
            https://shoplands.vercel.app/login
          </Link>
        </Typography>

        <Typography sx={{ fontWeight: "bold", mt: 2 }}>
          Một số tài khoản người mua:
        </Typography>

        <TableContainer sx={{ mb: 2 }}>
          <Table>
            <TableBody>
              <TableRow>
                <TableCell sx={{ fontWeight: "bold", textAlign: "center" }}>
                  Tên người mua
                </TableCell>
                <TableCell sx={{ fontWeight: "bold", textAlign: "center" }}>
                  Số điện thoại
                </TableCell>
                <TableCell sx={{ fontWeight: "bold", textAlign: "center" }}>
                  Mật khẩu
                </TableCell>
              </TableRow>
              <TableRow>
                <TableCell sx={{ textAlign: "center" }}>Ngô Thị Hai</TableCell>
                <TableCell sx={{ textAlign: "center" }}>0811138364</TableCell>
                <TableCell sx={{ textAlign: "center" }}>763gdu3ew5</TableCell>
              </TableRow>
              <TableRow>
                <TableCell sx={{ textAlign: "center" }}>Lê Văn Tâm</TableCell>
                <TableCell sx={{ textAlign: "center" }}>0887373235</TableCell>
                <TableCell sx={{ textAlign: "center" }}>koiwer9823</TableCell>
              </TableRow>
              <TableRow>
                <TableCell sx={{ textAlign: "center" }}>
                  Phạm Thị Ngọc
                </TableCell>
                <TableCell sx={{ textAlign: "center" }}>0866445533</TableCell>
                <TableCell sx={{ textAlign: "center" }}>12sf234sdf3</TableCell>
              </TableRow>
              <TableRow>
                <TableCell sx={{ textAlign: "center" }}>
                  Hoàng Văn Bình
                </TableCell>
                <TableCell sx={{ textAlign: "center" }}>0839444478</TableCell>
                <TableCell sx={{ textAlign: "center" }}>09jif8jr43</TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </TableContainer>
      </Box>

      {/* For Sellers */}
      <Box id="doi-voi-nguoi-ban" sx={{ mb: 4 }}>
        <Typography variant="h6" component="h3" gutterBottom>
          2. Đối với người bán
        </Typography>

        <Typography>
          Đăng ký tài khoản tại:{" "}
          <Link target="_blank" href="https://shoplands.vercel.app/register-seller">
            https://shoplands.vercel.app/register-seller
          </Link>
        </Typography>
        <Typography>
          Hoặc đăng nhập tại:{" "}
          <Link target="_blank" href="https://shoplands.vercel.app/login">
            https://shoplands.vercel.app/login
          </Link>
        </Typography>

        <Typography sx={{ fontWeight: "bold", mt: 2 }}>
          Một số tài khoản người bán:
        </Typography>
        <TableContainer sx={{ mb: 2 }}>
          <Table>
            <TableBody>
              <TableRow>
                <TableCell sx={{ fontWeight: "bold", textAlign: "center" }}>
                  Tên người bán
                </TableCell>
                <TableCell sx={{ fontWeight: "bold", textAlign: "center" }}>
                  Số điện thoại
                </TableCell>
                <TableCell sx={{ fontWeight: "bold", textAlign: "center" }}>
                  Mật khẩu
                </TableCell>
              </TableRow>
              <TableRow>
                <TableCell sx={{ textAlign: "center" }}>
                  Phụ Kiện Sành Điệu
                </TableCell>
                <TableCell sx={{ textAlign: "center" }}>0883468773</TableCell>
                <TableCell sx={{ textAlign: "center" }}>fet3sd45w</TableCell>
              </TableRow>
              <TableRow>
                <TableCell sx={{ textAlign: "center" }}>Công Nghệ Số</TableCell>
                <TableCell sx={{ textAlign: "center" }}>0824666345</TableCell>
                <TableCell sx={{ textAlign: "center" }}>sdfh356edrt</TableCell>
              </TableRow>
              <TableRow>
                <TableCell sx={{ textAlign: "center" }}>
                  Nhà Cửa Online
                </TableCell>
                <TableCell sx={{ textAlign: "center" }}>0822646477</TableCell>
                <TableCell sx={{ textAlign: "center" }}>s723fkrsdfa</TableCell>
              </TableRow>
              <TableRow>
                <TableCell sx={{ textAlign: "center" }}>
                  Thể Thao và Sách
                </TableCell>
                <TableCell sx={{ textAlign: "center" }}>0829088908</TableCell>
                <TableCell sx={{ textAlign: "center" }}>24dfuyu63u</TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </TableContainer>
      </Box>

      {/* For Admin */}
      <Box id="doi-voi-quan-tri-vien" sx={{ mb: 4 }}>
        <Typography variant="h6" component="h3" gutterBottom>
          3. Đối với quản trị viên
        </Typography>

        <Paper
          elevation={0}
          sx={{ p: 2, mb: 2, backgroundColor: "info.light" }}
        >
          <Typography>
            <Typography component="span" sx={{ fontWeight: "bold" }}>
              ℹ️ Ghi chú:
            </Typography>{" "}
            Tài khoản quản trị viên chỉ có 1 nên không thể đăng ký.
          </Typography>
        </Paper>

        <Typography>
          Hoặc đăng nhập tại:{" "}
          <Link target="_blank" href="https://shoplands.vercel.app/login">
            https://shoplands.vercel.app/login
          </Link>
        </Typography>

        <Typography sx={{ fontWeight: "bold", mt: 2 }}>
          Tài khoản quản trị viên:
        </Typography>

        <TableContainer sx={{ mb: 2, maxWidth: 400 }}>
          <Table>
            <TableBody>
              <TableRow>
                <TableCell sx={{ fontWeight: "bold", textAlign: "center" }}>
                  Số điện thoại
                </TableCell>
                <TableCell sx={{ fontWeight: "bold", textAlign: "center" }}>
                  Mật khẩu
                </TableCell>
              </TableRow>
              <TableRow>
                <TableCell sx={{ textAlign: "center" }}>0833333333</TableCell>
                <TableCell sx={{ textAlign: "center" }}>123</TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </TableContainer>
      </Box>

      {/* Project Code Description */}
      <Box id="mo-ta-code-du-an" sx={{ mb: 4 }}>
        <Typography variant="h5" component="h2" gutterBottom>
          III. Mô tả code dự án
        </Typography>

        <Box id="cau-truc-thu-muc" sx={{ mb: 4 }}>
          <Typography variant="h6" component="h3" gutterBottom>
            1. Cấu trúc thư mục
          </Typography>

          <List>
            <ListItem>
              <ListItemText
                primary="$document"
                secondary="chứa tài liệu của dự án"
              />
            </ListItem>
            <ListItem>
              <ListItemText
                primary="BACKEND"
                secondary="sử dụng PHP thuần xây dựng api cho trang web"
              />
            </ListItem>
            <ListItem>
              <ListItemText
                primary="FRONTEND"
                secondary="sử dụng React kết hợp Material UI xây dựng giao diện"
              />
            </ListItem>
            <ListItem>
              <ListItemText
                primary="DATABASE"
                secondary="sử dụng Laravel lưu cấu trúc và tạo dữ liệu cho database"
              />
            </ListItem>
            <ListItem>
              <ListItemText
                primary="APIGHN"
                secondary="ban đầu sử dụng api của GiaoHangNhanh cho việc giao hàng nhưng api đó thường xuyên lỗi nên phải tạo thư mục này mô phỏng lại api của GiaoHangNhanh"
              />
            </ListItem>
          </List>
        </Box>

        <Box id="phuong-phap-bao-mat" sx={{ mb: 4 }}>
          <Typography variant="h6" component="h3" gutterBottom>
            2. Phương pháp bảo mật
          </Typography>

          <Typography
            variant="subtitle1"
            component="h4"
            fontWeight={"bold"}
            mt={2}
            gutterBottom
          >
            a. Mã hóa dữ liệu nhạy cảm
          </Typography>

          <Typography>
            - Mã hóa 1 chiều: Dùng cho các dữ liệu không thể khôi phục lại như
            mật khẩu người dùng, mã xác nhận. Trang web sử dụng thuật toán
            ARGON2I kết hợp khóa bí giúp bảo vệ mật khẩu ngay cả khi cơ sở dữ
            liệu bị xâm nhập.
          </Typography>
          <Typography>
            - Mã hóa 2 chiều: Dùng cho các dữ liệu có thể cần phải giải mã để sử
            dụng sau này như số điện thoại, thông tin thẻ ngân hàng. Dự án sử
            dụng thật toán AES-256-CBC kết hợp khóa bí mật để bảo vệ các dữ liệu
            này.
          </Typography>

          <Typography
            variant="subtitle1"
            component="h4"
            fontWeight={"bold"}
            mt={2}
            gutterBottom
          >
            b. Xác thực người dùng
          </Typography>

          <Typography>
            - Khi đăng nhập, backend sẽ dùng JWT trả về access-token và
            refresh-token, sau đó frontend lưu vào redux. Với mỗi yêu cầu gửi
            lên backend sẽ phải kèm theo access-token trong header để xác thực
            người dùng và vai trò của họ qua middleware.
          </Typography>
          <Typography>
            - Access-token có thời gian ngắn nên khi hết thời gian, frontend sẽ
            phải gửi refresh-token để lấy lại access-token và refresh token mới
            và lưu lại vào redux.
          </Typography>

          <Typography
            variant="subtitle1"
            component="h4"
            fontWeight={"bold"}
            mt={2}
            gutterBottom
          >
            c. Xác thực SMS
          </Typography>

          <Typography>
            - Để chống tấn công brute-force khi đăng nhập, đăng ký, người dùng
            phải xác thực thông qua mã OTP gửi về điện thoại. Hệ thống cũng lưu
            REMOTE_ADDR và HTTP_USER_AGENT của trình duyệt vừa mới đăng nhập và
            khi đăng nhập lại 1 trình duyệt khác cũng sẽ yêu cầu nhập mã OTP.
          </Typography>

          <Typography
            variant="subtitle1"
            component="h4"
            fontWeight={"bold"}
            mt={2}
            gutterBottom
          >
            d. Chống tấn công CSRF
          </Typography>

          <Typography
            variant="subtitle1"
            component="h4"
            fontWeight={"bold"}
            mt={2}
            gutterBottom
          >
            e. Ghi dữ liệu
          </Typography>

          <Typography>
            - Hệ thống ghi lại một số dữ liệu như các lần đăng nhập của người
            dùng gồm địa chỉ IP, thời gian để nhanh chóng phát hiện các hành vi
            đáng ngờ.
          </Typography>

          <Typography
            variant="subtitle1"
            component="h4"
            fontWeight={"bold"}
            mt={2}
            gutterBottom
          >
            f. Cấu hình CORS
          </Typography>

          <Typography>
            - Hệ thống backend được cấu hình CORS chỉ cho phép duy nhất địa chỉ
            của frontend được phép truy cập api. Việc này hạn chế các mối đe dọa
            từ các tấn công cross-origin.
          </Typography>

          <Typography
            variant="subtitle1"
            component="h4"
            fontWeight={"bold"}
            mt={2}
            gutterBottom
          >
            g. Chống SQL Injection
          </Typography>

          <Typography>
            - Để bảo vệ hệ thống khỏi SQL Injection, hệ thống sử dụng PDO (PHP
            Data Objects). PDO cung cấp một cách an toàn và chuẩn mực để tương
            tác với cơ sở dữ liệu, thông qua các câu truy vấn chuẩn bị (prepared
            statements). Điều này giúp ngăn chặn SQL Injection vì tất cả các
            tham số truyền vào câu truy vấn được xử lý như dữ liệu, chứ không
            phải là một phần của câu truy vấn SQL.
          </Typography>
        </Box>
      </Box>
    </Container>
  );
};

export default About;
