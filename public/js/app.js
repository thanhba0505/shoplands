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

async function loadTabAjax(url, options = {}) {
    const defaults = {
        tabContainers: [], // Danh sách các container tab, sử dụng id
        contentId: "contentId", // ID phần tử nội dung
        dataName: "dataName", // Thuộc tính data-tab
        loadingId: "loadingId", // ID của phần tử loading
        errorId: "errorId", // ID của phần tử hiển thị lỗi
        noContentId: "noContentId", // ID của phần tử hiển thị "No content"
    };

    const settings = Object.assign({}, defaults, options);

    const setActiveTab = (tabKey) => {
        settings.tabContainers.forEach((tabContainer) => {
            const activeClass = tabContainer.activeClass || "active";
            $(`#${tabContainer.selectorId} [data-tab]`).removeClass(
                activeClass
            );
            $(`#${tabContainer.selectorId} [data-tab="${tabKey}"]`).addClass(
                activeClass
            );
        });
    };

    const showIndicator = (indicatorId) => {
        $(
            `#${settings.loadingId}, #${settings.errorId}, #${settings.noContentId}`
        ).hide();
        $(`#${indicatorId}`).show();
    };

    settings.tabContainers.forEach((tabContainer) => {
        $(`#${tabContainer.selectorId} [data-tab]`).click(async function (e) {
            e.preventDefault();

            const $this = $(this);

            // Kiểm tra nếu tab đã active và nội dung đã tồn tại
            if (
                $this.hasClass(tabContainer.activeClass) &&
                $(`#${settings.contentId}`).html().trim() !== ""
            ) {
                return;
            }

            const tab = $this.data(settings.dataName);

            // Lưu trạng thái tab vào localStorage
            localStorage.setItem("activeTab", tab);

            // Hiển thị loading indicator
            showIndicator(settings.loadingId);

            // Xóa nội dung cũ
            $(`#${settings.contentId}`).empty();

            setActiveTab(tab, tabContainer);

            try {
                const response = await $.post(url, { page: tab });
                if (response.content) {
                    $(`#${settings.contentId}`).html(response.content);
                    // Ẩn tất cả các indicator
                    $(
                        `#${settings.loadingId}, #${settings.errorId}, #${settings.noContentId}`
                    ).hide();
                } else {
                    // Hiển thị "No content" indicator
                    showIndicator(settings.noContentId);
                }
            } catch (error) {
                // Hiển thị error indicator
                showIndicator(settings.errorId);
            }
        });
    });

    // Lấy trạng thái tab từ localStorage
    const activeTab = localStorage.getItem("activeTab") || "all";

    settings.tabContainers.forEach((tabContainer) => {
        setActiveTab(activeTab, tabContainer);
    });

    $(`[data-tab="${activeTab}"]`).first().trigger("click");
}
