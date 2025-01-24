document.addEventListener("DOMContentLoaded", () => {});

function showNotification(message, type = "success", duration = 3000) {
    const $notification = $("#notification");
    const $notificationMessage = $("#notification-message");

    // Cập nhật nội dung thông báo
    $notificationMessage.text(message);

    // Thêm và xóa lớp CSS theo loại thông báo
    if (type === "error") {
        $notification.addClass("bg-red-400").removeClass("bg-blue-400");
    } else {
        $notification.addClass("bg-blue-400").removeClass("bg-red-400");
    }

    // Hiển thị thông báo với hiệu ứng
    $notification
        .removeAttr("hidden") // Hiển thị thông báo
        .removeClass("right-8 opacity-0")
        .addClass("right-10 opacity-1");

    // Ẩn thông báo sau thời gian quy định
    setTimeout(() => {
        $notification
            .addClass("right-8 opacity-0")
            .removeClass("right-10 opacity-1");

        setTimeout(() => {
            $notification.attr("hidden", true); // Ẩn hoàn toàn
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
        urlActive: "",
    };

    const settings = Object.assign({}, defaults, options);

    const setActiveTab = (tabKey) => {
        settings.tabContainers.forEach((tabContainer) => {
            const activeClass = tabContainer.activeClass || "active";
            $(
                `#${tabContainer.selectorId} [data-${settings.dataName}]`
            ).removeClass(activeClass);
            if ($(`#${settings.contentId}`).length > 0) {
                $(
                    `#${tabContainer.selectorId} [data-${settings.dataName}="${tabKey}"]`
                ).addClass(activeClass);
            }
        });
    };

    const showIndicator = (indicatorId) => {
        // Ẩn tất cả các trạng thái nếu tồn tại
        if ($("#" + settings.loadingId).length > 0)
            $("#" + settings.loadingId).hide();
        if ($("#" + settings.errorId).length > 0)
            $("#" + settings.errorId).hide();
        if ($("#" + settings.noContentId).length > 0)
            $("#" + settings.noContentId).hide();

        // Hiển thị trạng thái cụ thể nếu tồn tại
        if ($("#" + indicatorId).length > 0) {
            $("#" + indicatorId).show();
        }
    };

    settings.tabContainers.forEach((tabContainer) => {
        $(`#${tabContainer.selectorId} [data-${settings.dataName}]`).click(
            async function (e) {
                e.preventDefault();

                const $this = $(this);

                const tab = $this.data(settings.dataName);

                // Lưu trạng thái tab vào localStorage
                localStorage.setItem(settings.dataName, tab);

                if (window.location.href !== settings.urlActive) {
                    window.location.href = settings.urlActive;
                    return;
                }

                // Hiển thị loading indicator
                showIndicator(settings.loadingId);

                // Xóa nội dung cũ
                $(`#${settings.contentId}`).empty();

                setActiveTab(tab, tabContainer);

                try {
                    const response = await $.post(url, { page: tab });
                    if (response.data) {
                        $(`#${settings.contentId}`).html(response.data);
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
            }
        );
    });

    // Lấy trạng thái tab từ localStorage hoặc mặc định là thẻ đầu tiên
    const activeTab =
        localStorage.getItem(settings.dataName) ||
        $(
            `#${settings.tabContainers[0].selectorId} [data-${settings.dataName}]`
        )
            .first()
            .data(settings.dataName);

    settings.tabContainers.forEach((tabContainer) => {
        setActiveTab(activeTab, tabContainer);
    });

    if (window.location.href === settings.urlActive) {
        $(`[data-${settings.dataName}="${activeTab}"]`)
            .first()
            .trigger("click");
    }
}
