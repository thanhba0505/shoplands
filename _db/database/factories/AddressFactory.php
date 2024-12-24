<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\User;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

class AddressFactory extends Factory
{
    protected $model = \App\Models\Address::class;

    // Mảng để lưu trữ các seller_id đã được sử dụng
    protected static $usedSellerIds = [];

    // Mảng để lưu trữ các user_id đã có địa chỉ mặc định
    protected static $usersWithDefaultAddress = [];

    public function definition(): array
    {
        if ($this->faker->boolean()) { // Lấy danh sách tất cả các seller_id
            $sellerIds = Seller::pluck('id')->toArray();

            // Lọc ra các seller_id chưa được sử dụng
            $unusedSellerIds = array_diff($sellerIds, self::$usedSellerIds);

            // Nếu không còn seller_id nào để chọn, trả về null hoặc xử lý theo cách khác
            if (empty($unusedSellerIds)) {
                $sellerId = null; // Hoặc xử lý theo cách khác nếu hết seller
            } else {
                // Chọn seller_id ngẫu nhiên từ danh sách chưa sử dụng
                $sellerId = $this->faker->randomElement($unusedSellerIds);
                // Thêm seller_id này vào danh sách đã sử dụng
                self::$usedSellerIds[] = $sellerId;
            }
        } else {
            $sellerId = null;
        }

        // Lấy provinceId ngẫu nhiên
        $provinceId = Province::inRandomOrder()->first()->id;

        // Lấy userId ngẫu nhiên
        $userId = $sellerId ? null : User::inRandomOrder()->first()->id;

        // Log giá trị để kiểm tra
        // Log::info('--------', ['sellerId' => $sellerId, 'userId' => $userId]);

        $isDefault = false;
        if ($userId && !in_array($userId, self::$usersWithDefaultAddress)) {
            $isDefault = true;
            self::$usersWithDefaultAddress[] = $userId;
        }

        return [
            'address_line' => $this->faker->address(),
            'default' => $isDefault,
            'province_id' => $provinceId,
            'seller_id' => $sellerId,
            'user_id' => $userId,
        ];
    }
}
