document.addEventListener("DOMContentLoaded", () => {});

function showNotification(message, type = "success", duration = 3000) {
    const notification = document.getElementById("notification");
    notification.textContent = message;
    notification.className = `notification ${type}`;
    notification.hidden = false; // Xóa thuộc tính hidden

    // Hiệu ứng hiển thị
    setTimeout(() => {
        notification.classList.add("show");
    }, 10);

    // Xóa thông báo sau thời gian quy định
    setTimeout(() => {
        notification.classList.remove("show");
        setTimeout(() => {
            notification.hidden = true; // Thêm lại thuộc tính hidden
        }, 500);
    }, duration);
}
