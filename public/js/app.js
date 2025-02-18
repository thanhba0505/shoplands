document.addEventListener("DOMContentLoaded", () => { });

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

function showPriceProductDeatil(productVariants) {
    var selectedAttributes = {}; // Lưu các thuộc tính đã chọn
    var totalAttributes = $(".attribute-option")
        .map(function () {
            return $(this).data("attribute-id");
        })
        .get();
    totalAttributes = [...new Set(totalAttributes)]; // Lấy danh sách ID thuộc tính duy nhất

    // Khi click vào thuộc tính
    $(".attribute-option").click(function () {
        var attributeId = $(this).data("attribute-id");
        var valueId = $(this).data("value-id");

        // Nếu đã chọn trước đó, thì xóa lựa chọn
        if (selectedAttributes[attributeId] === valueId) {
            delete selectedAttributes[attributeId];
            $(this).removeClass("bg-blue-400 text-white");
        } else {
            // Nếu chưa chọn, cập nhật thuộc tính đã chọn
            selectedAttributes[attributeId] = valueId;
            $(this).siblings().removeClass("bg-blue-400 text-white");
            $(this).addClass("bg-blue-400 text-white");
        }

        // Cập nhật giá theo biến thể
        updatePrice();
    });

    function updatePrice() {
        var matchingVariant = null;
        var minPrice = Infinity,
            maxPrice = 0;
        var minPromo = Infinity,
            maxPromo = 0;

        // Nếu chưa chọn đủ tất cả thuộc tính thì chỉ hiển thị min-max
        if (Object.keys(selectedAttributes).length < totalAttributes.length) {
            $.each(productVariants, function (variantId, variant) {
                var promoPrice = variant.promotion_price
                    ? parseFloat(variant.promotion_price)
                    : parseFloat(variant.price);
                minPrice = Math.min(minPrice, parseFloat(variant.price));
                maxPrice = Math.max(maxPrice, parseFloat(variant.price));
                minPromo = Math.min(minPromo, promoPrice);
                maxPromo = Math.max(maxPromo, promoPrice);
            });

            if (minPromo === maxPromo) {
                $("#price").text(formatCurrency(minPromo));
            } else {
                $("#price").text(
                    formatCurrency(minPromo) + " - " + formatCurrency(maxPromo)
                );
            }
            $("#old-price").hide();
            $("#discount").hide();
            return;
        }

        // Nếu đã chọn đủ thuộc tính, tìm biến thể phù hợp
        $.each(productVariants, function (variantId, variant) {
            var isMatch = true;
            $.each(selectedAttributes, function (attrId, valueId) {
                if (variant.attributes[attrId] != valueId) {
                    isMatch = false;
                    return false; // Dừng vòng lặp
                }
            });

            if (isMatch) {
                matchingVariant = variant;
                return false; // Dừng vòng lặp
            }
        });

        if (matchingVariant) {
            var finalPrice = matchingVariant.promotion_price
                ? parseFloat(matchingVariant.promotion_price)
                : parseFloat(matchingVariant.price);
            $("#price").text(formatCurrency(finalPrice));

            if (matchingVariant.promotion_price) {
                $("#old-price")
                    .text(formatCurrency(parseFloat(matchingVariant.price)))
                    .show();
                $("#discount")
                    .text(
                        "-" +
                        (
                            ((parseFloat(matchingVariant.price) -
                                finalPrice) /
                                parseFloat(matchingVariant.price)) *
                            100
                        ).toFixed(0) +
                        "%"
                    )
                    .show();
            } else {
                $("#old-price").hide();
                $("#discount").hide();
            }
        }
    }

    // Hiển thị giá min-max khi load trang
    updatePrice();
}

function formatCurrency(value) {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    })
        .format(value)
        .replace(/\s₫/, "₫");
}

// Hàm chuyển ảnh trong trang productDetails
function imgTransfer() {
    const mainImg = $("#main-img");
    const thumbnails = $("#thumbnails img");
    const prevButton = $("#prev-btn");
    const nextButton = $("#next-btn");
    let currentIndex = 0;

    // Cập nhật hình ảnh chính và đánh dấu ảnh được chọn
    function updateMainImage(index) {
        if (thumbnails.length > 0) {
            currentIndex = index;
            const newSrc = thumbnails.eq(currentIndex).attr("src");
            mainImg.attr("src", newSrc);

            // Xóa viền ở tất cả ảnh nhỏ
            thumbnails.removeClass("border-2 border-blue-500");

            // Thêm viền cho ảnh đang được chọn
            thumbnails.eq(currentIndex).addClass("border-2 border-blue-500");
        }
    }

    // Lắng nghe sự kiện click trên ảnh nhỏ
    thumbnails.each(function (index) {
        $(this).on("click", function () {
            updateMainImage(index);
        });
    });

    // Xử lý nút prev
    prevButton.on("click", function () {
        if (thumbnails.length > 0) {
            currentIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
            updateMainImage(currentIndex);
        }
    });

    // Xử lý nút next
    nextButton.on("click", function () {
        if (thumbnails.length > 0) {
            currentIndex = (currentIndex + 1) % thumbnails.length;
            updateMainImage(currentIndex);
        }
    });

    // Đặt hình ảnh mặc định ban đầu (nếu có ảnh mặc định)
    const defaultImageSrc = mainImg.attr("src");
    const defaultIndex = thumbnails.toArray().findIndex(img => $(img).attr("src") === defaultImageSrc);

    if (defaultIndex !== -1) {
        currentIndex = defaultIndex;
    } else {
        currentIndex = 0;
    }

    updateMainImage(currentIndex);
}
