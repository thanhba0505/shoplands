document.addEventListener("DOMContentLoaded", () => {});

// Hiển thị thông báo
let currentTimeout = null; // Lưu trữ timeout hiện tại
let currentHideTimeout = null; // Lưu trữ timeout ẩn hiện tại
let notificationStartTime = null; // Thời điểm bắt đầu hiển thị thông báo
const MIN_DISPLAY_DURATION = 1000; // Thời gian tối thiểu thông báo phải hiển thị (1 giây)
const DELAY_BETWEEN_NOTIFICATIONS = 500; // Khoảng delay giữa hai thông báo (0.5 giây)

function showNotification(message, type = "success", duration = 3000) {
    const title = "Thông báo";

    butterup.toast({
        title: title,
        message: message,
        type: type,
        icon: true,
        duration: duration,
        dismissable: true,
        location:'bottom-right',

        // primaryButton: {
        //     text: "Approve",
        //     onClick: function () {
        //         console.log("Approved!");
        //     },
        // },
        // secondaryButton: {
        //     text: "Reject",
        //     onClick: function () {
        //         console.log("Rejected!");
        //     },
        // },
    });
}

// Funtion load tab ajax
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

// Hiển thị giá trong chi tiết sản phẩm
function showPriceAndAddToCartProductDetail(productVariants, urlAddToCart) {
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
    addToCart(
        selectedAttributes,
        totalAttributes,
        productVariants,
        urlAddToCart
    );
}

// Thêm vào giỏ hàng
function addToCart(
    selectedAttributes,
    totalAttributes,
    productVariants,
    urlAddToCart
) {
    $("#addToCart").click(function () {
        var selectedQuantity = $("#quantity").val(); // Lấy số lượng
        var selectedVariantId = null;

        // Kiểm tra xem đã chọn đủ thuộc tính chưa
        if (Object.keys(selectedAttributes).length === totalAttributes.length) {
            // Tìm ID của biến thể đã chọn
            $.each(productVariants, function (variantId, variant) {
                var isMatch = true;
                $.each(selectedAttributes, function (attrId, valueId) {
                    if (variant.attributes[attrId] != valueId) {
                        isMatch = false;
                        return false; // Dừng vòng lặp
                    }
                });

                if (isMatch) {
                    selectedVariantId = variant.id; // Lưu ID của biến thể đã chọn
                    return false; // Dừng vòng lặp khi tìm thấy biến thể khớp
                }
            });
        }

        console.log(productVariants, selectedAttributes, selectedVariantId);

        if (selectedVariantId || totalAttributes.length === 0) {
            // Gửi thông tin qua AJAX POST
            $.ajax({
                url: urlAddToCart, // Địa chỉ endpoint server của bạn
                type: "POST",
                data: {
                    product_variant_id: selectedVariantId,
                    quantity: selectedQuantity,
                },
                success: function (response) {
                    showNotification(response.message, response.status);
                },
                error: function (error) {
                    showNotification(
                        "Có lỗi xảy ra, vui lòng thử lại sau",
                        "error"
                    );
                },
            });
        } else {
            showNotification("Vui lòng chọn đủ thuộc tính", "error");
        }
    });
}

// Hàm format giá tiền
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
            currentIndex =
                (currentIndex - 1 + thumbnails.length) % thumbnails.length;
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
    const defaultIndex = thumbnails
        .toArray()
        .findIndex((img) => $(img).attr("src") === defaultImageSrc);

    if (defaultIndex !== -1) {
        currentIndex = defaultIndex;
    } else {
        currentIndex = 0;
    }

    updateMainImage(currentIndex);
}

// Xóa input text rỗng khi submit
function removeEmptyFields(form) {
    let inputs = form.querySelectorAll("input[type='text']");
    inputs.forEach((input) => {
        if (input.value.trim() === "") {
            input.removeAttribute("name"); // Xóa input rỗng để không gửi lên server
        }
    });
}

// Hàm tăng giảm số lượng
function counter() {
    $(".counter-container").each(function () {
        const container = $(this);
        const minusBtn = container.find("button:first-child");
        const plusBtn = container.find("button:last-child");
        const input = container.find("input");

        input.on("input", function () {
            let value = parseInt(input.val(), 10);
            if (value < 1) {
                input.val(1);
            }
        });

        minusBtn.on("click", function () {
            let value = parseInt(input.val(), 10);
            if (value > 1) {
                input.val(value - 1);
            }
        });

        plusBtn.on("click", function () {
            let value = parseInt(input.val(), 10);
            input.val(value + 1);
        });
    });
}
