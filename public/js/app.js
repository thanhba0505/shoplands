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

// async function loadTabAjax(url, options = {}) {
//     const defaults = {
//         tabClass: "tabClass",
//         contentId: "contentId",
//         dataName: "dataName",
//         activeClass: "active",
//     };

//     const settings = Object.assign({}, defaults, options);

//     const setActiveTab = (tabKey) => {
//         $("." + settings.tabClass).removeClass(settings.activeClass);
//         $(`[data-tab="${tabKey}"]`).addClass(settings.activeClass);
//     };

//     $("." + settings.tabClass).click(async function (e) {
//         e.preventDefault();

//         const $this = $(this);
//         const tab = $this.data(settings.dataName);

//         // Lưu trạng thái tab vào localStorage
//         localStorage.setItem("activeTab", tab);

//         $("#" + settings.contentId).html(
//             '<tr><td colspan="10">Loading content...</td></tr>'
//         );

//         setActiveTab(tab);

//         try {
//             const response = await $.post(url, { page: tab });
//             if (response.content) {
//                 $("#" + settings.contentId).html(response.content);
//             } else {
//                 $("#" + settings.contentId).html(
//                     '<tr><td colspan="10">No content.</td></tr>'
//                 );
//             }
//         } catch (error) {
//             $("#" + settings.contentId).html(
//                 '<tr><td colspan="10">Error loading content.</td></tr>'
//             );
//         }
//     });

//     // Lấy trạng thái tab từ localStorage
//     const activeTab = localStorage.getItem("activeTab") || "all";
//     setActiveTab(activeTab);
//     $(`[data-tab="${activeTab}"]`).first().trigger("click");
// }

async function loadTabAjax(url, options = {}) {
    const defaults = {
        tabContainers: [], // Danh sách các container tab, sử dụng id
        contentId: "contentId",
        dataName: "dataName",
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

    settings.tabContainers.forEach((tabContainer) => {
        $(`#${tabContainer.selectorId} [data-tab]`).click(async function (e) {
            e.preventDefault();
            
            const $this = $(this);
            const tab = $this.data(settings.dataName);

            // Lưu trạng thái tab vào localStorage
            localStorage.setItem("activeTab", tab);

            $(`#${settings.contentId}`).html(
                '<tr><td colspan="10">Loading content...</td></tr>'
            );

            setActiveTab(tab, tabContainer);

            try {
                const response = await $.post(url, { page: tab });
                if (response.content) {
                    $(`#${settings.contentId}`).html(response.content);
                } else {
                    $(`#${settings.contentId}`).html(
                        '<tr><td colspan="10">No content.</td></tr>'
                    );
                }
            } catch (error) {
                $(`#${settings.contentId}`).html(
                    '<tr><td colspan="10">Error loading content.</td></tr>'
                );
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
