document.addEventListener("DOMContentLoaded", () => {});

function showNotification(message = "", type = "success", duration = 3000) {
    const notification = document.getElementById("notification");

    // Cập nhật nội dung và kiểu thông báo
    const typeElement = document.getElementById("notification-type");
    const messageElement = document.getElementById("notification-message");
    typeElement.textContent = type.charAt(0).toUpperCase() + type.slice(1);
    messageElement.textContent = message;

    // Cập nhật lớp CSS và hiển thị thông báo
    notification.className = `notification ${type}`;
    notification.hidden = false;

    // Thêm hiệu ứng hiển thị
    setTimeout(() => {
        notification.classList.add("show");
    }, 10);

    // Ẩn thông báo sau thời gian quy định
    setTimeout(() => {
        notification.classList.remove("show");
        setTimeout(() => {
            notification.hidden = true; // Ẩn thông báo hoàn toàn
        }, 500); // Thời gian cho hiệu ứng ẩn
    }, duration);
}
