<div class="mx-auto p-6 bg-white border rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold mb-4">Hồ Sơ Của Tôi</h1>
    <p class="text-gray-600 mb-6">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>

    <!-- Tên -->
    <div class="flex items-center space-x-2 mb-6">
        <label class="w-1/3 text-sm font-medium text-gray-700">Tên</label>
        <input type="text" value="Tuấn _01"
            class="w-2/3 p-2 border-2 border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
    </div>

    <!-- Số điện thoại -->
    <div class="flex items-center space-x-2 mb-6">
        <label class="w-1/3 text-sm font-medium text-gray-700">Số điện thoại</label>
        <input type="text" value="********20" disabled
            class="w-2/3 p-2 border-2 border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
    </div>

    <!-- Email -->
    <div class="flex items-center space-x-2 mb-6">
        <label class="w-1/3 text-sm font-medium text-gray-700">Email</label>
        <input type="email" value="" placeholder="Thêm email"
            class="w-2/3 p-2 border-2 border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
    </div>

    <!-- Giới tính -->
    <div class="flex items-center space-x-4 mb-6">
        <label class="w-1/3 text-sm font-medium text-gray-700">Giới tính</label>
        <label class="flex items-center">
            <input type="radio" name="gender" value="male" class="text-blue-500">
            <span class="ml-2 text-gray-700">Nam</span>
        </label>
        <label class="flex items-center">
            <input type="radio" name="gender" value="female" class="text-blue-500">
            <span class="ml-2 text-gray-700">Nữ</span>
        </label>
        <label class="flex items-center">
            <input type="radio" name="gender" value="other" class="text-blue-500">
            <span class="ml-2 text-gray-700">Khác</span>
        </label>
    </div>

    <!-- Ngày sinh -->
    <div class="flex items-center space-x-4 mb-4">
        <label class="w-1/3 text-sm font-medium text-gray-700">Ngày sinh</label>
        <div class="flex space-x-2 w-full">
            <!-- Chọn ngày -->
            <select id="day" name="day" class="w-full p-2 border-2 border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                <option value="">Ngày</option>
                <?php
                // Tạo các lựa chọn cho tháng và năm
                $months = [
                    1 => 31,
                    2 => 28,
                    3 => 31,
                    4 => 30,
                    5 => 31,
                    6 => 30,
                    7 => 31,
                    8 => 31,
                    9 => 30,
                    10 => 31,
                    11 => 30,
                    12 => 31
                ];

                // Đặt ngày mặc định là 1
                $selectedDay = 1;

                // Lấy năm và tháng từ input hoặc mặc định là năm 2025 và tháng 1
                $currentYear = date("Y"); // Năm hiện tại
                $selectedYear = isset($_POST['year']) ? $_POST['year'] : 2025;
                $selectedMonth = isset($_POST['month']) ? $_POST['month'] : 1;

                // Kiểm tra năm nhuận
                if (($selectedYear % 4 == 0 && $selectedYear % 100 != 0) || ($selectedYear % 400 == 0)) {
                    $months[2] = 29; // Tháng 2 có 29 ngày trong năm nhuận
                }

                // Lấy số ngày trong tháng đã chọn
                $daysInMonth = $months[$selectedMonth];

                // Tạo các lựa chọn cho ngày
                for ($i = 1; $i <= $daysInMonth; $i++) {
                    $selected = $i == $selectedDay ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>

            <!-- Chọn tháng -->
            <select id="month" name="month" class="w-full p-2 border-2 border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                <option value="">Tháng</option>
                <?php
                // Đặt tháng mặc định là 1 (tháng 1)
                for ($i = 1; $i <= 12; $i++) {
                    $selected = $i == $selectedMonth ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>

            <!-- Chọn năm -->
            <select id="year" name="year" class="w-full p-2 border-2 border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                <option value="">Năm</option>
                <?php
                // Đặt năm mặc định là 2025
                for ($i = $currentYear; $i >= 1900; $i--) {
                    $selected = $i == $selectedYear ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>
        </div>
    </div>




    <!-- Nút lưu -->
    <div>
        <button class="w-full py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-500 transition-all duration-300">
            Lưu
        </button>
    </div>
</div>