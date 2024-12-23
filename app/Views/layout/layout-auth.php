<?php include './app/views/layout/index.php'; ?>

<div class="background-auth" style="background-image: url('<?= BASE_URL ?>/public/img/background.jpg?v=2');">
    <div class="row justify-content-center" style="height: 100vh;">
        <div class="col-4">
            <div class="container-auth">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let lastTime = 0; // Thời điểm cập nhật cuối cùng
        const updateInterval = 200; // Khoảng thời gian tối thiểu giữa 2 lần cập nhật (ms)

        document.addEventListener("mousemove", (event) => {
            const currentTime = Date.now(); // Lấy thời gian hiện tại

            // Kiểm tra nếu đã qua khoảng thời gian cần thiết
            if (currentTime - lastTime >= updateInterval) {
                const background = document.querySelector(".background-auth");

                // Lấy vị trí của con trỏ chuột (theo tỷ lệ)
                const x = (event.clientX / window.innerWidth) * 100;
                const y = (event.clientY / window.innerHeight) * 100;

                // Tính toán vị trí cùng hướng (chỉnh độ nhạy bằng 0.2)
                const offsetX = 50 + (x - 50) * 0.2;
                const offsetY = 50 + (y - 50) * 0.2;

                // Gán vị trí cho background
                background.style.backgroundPosition = `${offsetX}% ${offsetY}%`;

                lastTime = currentTime; // Cập nhật thời gian cuối
            }
        });
    });
</script>