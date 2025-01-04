document.addEventListener("DOMContentLoaded", () => {});

function showNotification(duration = 3000) {
    const notification = document.getElementById("notification");
    // Cập nhật lớp CSS
    notification.hidden = false;

    // Hiển thị với hiệu ứng
    setTimeout(() => {
        notification.classList.remove("right-8");
        notification.classList.remove("opacity-0");
        notification.classList.add("right-10");
        notification.classList.add("opacity-1");
    }, 50);

    // Ẩn thông báo sau thời gian quy định
    setTimeout(() => {
        notification.classList.add("right-8");
        notification.classList.add("opacity-0");
        notification.classList.remove("opacity-1");
        notification.classList.remove("right-10");
        setTimeout(() => {
            notification.hidden = true; // Ẩn hoàn toàn
        }, 500); // Thời gian cho hiệu ứng
    }, duration);
}
