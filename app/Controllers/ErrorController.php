<?php

require_once './app/Models/ConnectDatabase.php';

class ErrorController
{
    public function show()
    {
        return View::make('App/404', ['title' => '404 Not Found']);
    }

    public function sql()
    {
        $conn = new ConnectDatabase();
        $sql = file_get_contents('.sql');
        $products = $conn->query($sql)->fetchAll();

        // Console::table($products);

        if ($products) {
            // Bắt đầu bảng
            echo "<div class=' w-full'>";
            echo "<table class='min-w-full table-auto border-collapse border border-gray-200'>";

            // Tạo tiêu đề bảng (dựa trên các tên cột trong cơ sở dữ liệu)
            echo "<thead class='bg-gray-300 sticky top-0'>";
            echo "<tr>";
            foreach ($products[0] as $key => $value) {
                echo "<th class='px-4 py-2 border border-gray-300 bg-gray-300 text-left'>" . htmlspecialchars($key) . "</th>";
            }
            echo "</tr>";
            echo "</thead>";

            // Hiển thị các dữ liệu trong bảng
            echo "<tbody>";
            foreach ($products as $product) {
                echo "<tr class='bg-white hover:bg-gray-50'>";
                foreach ($product as $value) {
                    echo "<td class='px-4 py-2 border border-gray-300'>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody>";

            // Kết thúc bảng
            echo "</table>";
            echo "</div>";
        } else {
            echo "Không có dữ liệu!";
        }
    }
}
