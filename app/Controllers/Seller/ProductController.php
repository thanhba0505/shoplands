<?php

require_once 'app/Models/ConnectDatabase.php';

class ProductController
{
    public function show($page = 'all')
    {
        if (!in_array($page, ['all', 'in-stock', 'out-of-stock', 'locked', 'hidden', 'deleted'])) {
            http_response_code(404);
            View::make('App/404');
            return;
        }

        // $userModel = new User();
        // $users = $userModel->getTest('Thử nghiệm');

        // $data = [
        //     'title' => 'Seller Page',
        //     'title_header' => 'Kênh người bán',
        //     'group' => 'product',
        //     'page' => $page,
        //     'users' => $users
        // ];

        $conn = new ConnectDatabase();
        $sql = file_get_contents('.sql');
        echo $sql;
        $products = $conn->query($sql)->fetchAll();

        // Console::table($products);

        if ($products) {
            // Bắt đầu bảng
            echo "<div class='overflow-auto w-full'>";
            echo "<table class='min-w-full table-auto border-collapse border border-gray-200'>";
        
            // Tạo tiêu đề bảng (dựa trên các tên cột trong cơ sở dữ liệu)
            echo "<thead class='bg-gray-100'>";
            echo "<tr>";
            foreach ($products[0] as $key => $value) {
                echo "<th class='px-4 py-2 border border-gray-300 text-left'>" . htmlspecialchars($key) . "</th>";
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

        // View::make('Seller/Product/index', [], 'layout/layout-header-only');
    }
}
