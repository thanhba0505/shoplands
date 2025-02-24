document.addEventListener("DOMContentLoaded", () => {});

// Hiển thị thông báo
function showToast(config) {
    // Thiết lập cấu hình mặc định
    const defaultConfig = {
        message: "", // Nội dung thông báo
        type: "success", // Loại thông báo (success, error, warning, info)
        duration: 3000, // Thời gian hiển thị (ms)
        title: "Thông báo", // Tiêu đề thông báo
        icon: true, // Hiển thị biểu tượng
        dismissable: true, // Cho phép đóng thủ công
        location: "bottom-right", // Vị trí hiển thị
        primaryButton: null, // Cấu hình nút chính
        secondaryButton: null, // Cấu hình nút phụ
    };

    // Kết hợp cấu hình mặc định với cấu hình được truyền vào
    const toastConfig = { ...defaultConfig, ...config };

    // Hiển thị toast và trả về toastId
    butterup.options.toastLife = toastConfig.duration;
    butterup.toast(toastConfig);
    return "butterupToast-" + butterup.options.currentToasts; // Trả về ID của toast
}

function hideToast(toastId) {
    butterup.despawnToast(toastId);
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
    counter(".cart-quantity", 1, 1);
    // console.log(productVariants);
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
            counter(".cart-quantity", 1, 1);
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
            $(".cart-quantity input").val(1);
            counter(".cart-quantity", 1, matchingVariant.quantity);

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
                    showToast({
                        message: response.message,
                        type: response.status,
                    });
                },
                error: function (error) {
                    showToast({
                        message: "Có lỗi xảy ra, vui lòng thử lại sau",
                        type: "error",
                    });
                },
            });
        } else {
            showToast({
                message: "Vui lòng chọn đủ thuộc tính",
                type: "warning",
            });
        }
    });
}

// Xóa khỏi giỏ hàng
function deleteCart(url, csrf) {
    // Gắn sự kiện click cho nút "Xóa"
    $(".delete-cart-button").on("click", function () {
        var cartId = $(this).data("cart-id"); // Lấy cartId từ thuộc tính data-cart-id
        var groupId = $(this)
            .closest("tr")
            .find('input[name="c_ids[]"]')
            .data("group"); // Lấy groupId từ thuộc tính data-group

        // Hiển thị thông báo xác nhận
        const toastId = showToast({
            message:
                "Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?",
            type: "warning", // Loại thông báo (warning để cảnh báo)
            duration: 5000,
            primaryButton: {
                text: "Đồng ý", // Văn bản cho nút "Đồng ý"
                onClick: function () {
                    // Xử lý xóa sản phẩm khi người dùng chọn "Đồng ý"
                    deleteCartHadle(cartId, groupId);
                    hideToast(toastId);
                },
            },
            secondaryButton: {
                text: "Từ chối", // Văn bản cho nút "Từ chối"
                onClick: function () {
                    // Đóng thông báo khi người dùng chọn "Từ chối"
                    hideToast(toastId);
                },
            },
        });
    });

    // Hàm xóa sản phẩm khỏi giỏ hàng
    function deleteCartHadle(cartId, groupId) {
        var data = {
            cart_id: cartId,
            csrf: csrf,
        };

        // Gửi yêu cầu xóa sản phẩm đến server (ví dụ sử dụng AJAX)
        $.ajax({
            url: url, // Đường dẫn đến file xử lý xóa
            method: "POST",
            data: data,
            success: function (response) {
                // Xử lý phản hồi từ server
                if (response.status === "success") {
                    // Xóa hàng khỏi bảng
                    $(`button[data-cart-id="${cartId}"]`)
                        .closest("tr")
                        .remove();

                    // Kiểm tra số lượng sản phẩm còn lại trong nhóm
                    const remainingProducts = $(
                        `input[data-group="${groupId}"]`
                    ).length;

                    // Nếu không còn sản phẩm nào trong nhóm, xóa luôn nhóm đó
                    if (remainingProducts === 1) {
                        $(`input[data-group="${groupId}"]`)
                            .closest("tr.border-b")
                            .remove();
                    }

                    // Hiển thị thông báo thành công
                    showToast({
                        message: response.message,
                        type: "success",
                    });
                    checkTable();
                    updateTotalPrice();
                } else {
                    showToast({
                        message: response.message,
                        type: "error",
                    });
                }
            },
            error: function () {
                showToast({
                    message: "Có lỗi xảy ra, vui lòng thử lại sau",
                    type: "error",
                });
            },
        });
    }
}

// Kiểm tra giỏ hàng trống
function checkTable() {
    const table = $("#cart-table");
    const footer = $("#cart-footer");
    const emptyMessage = $("#empty-cart-message");

    // Đếm số lượng dòng (<tr>) trong bảng, không tính dòng tiêu đề
    const rowCount = table.find("tr").length;

    // Nếu không có dòng nào, hiển thị thông báo
    if (rowCount === 0) {
        emptyMessage.show();
        footer.hide();
    } else {
        emptyMessage.hide();
        footer.show();
    }
}

// Hàm format giá tiền
function formatCurrency(value = 0) {
    return new Intl.NumberFormat("vi-VN").format(value) + "đ";
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
    let textareas = form.querySelectorAll("textarea");
    textareas.forEach((textarea) => {
        if (textarea.value.trim() === "") {
            textarea.removeAttribute("name"); // Xoa textarea rongyang
        }
    });
    let selects = form.querySelectorAll("select");
    selects.forEach((select) => {
        if (select.value === "") {
            select.removeAttribute("name"); // Xoa select rongyang
        }
    });
}

// Hàm tăng giảm số lượng
function counter(selector, min = 1, max = Infinity, onChange = null) {
    $(selector).each(function () {
        const container = $(this);
        const minusBtn = container.find("button:first-child");
        const plusBtn = container.find("button:last-child");
        const input = container.find("input");

        // Xóa các sự kiện click cũ trước khi gắn sự kiện mới
        minusBtn.off("click");
        plusBtn.off("click");
        input.off("input keydown paste");

        // Đặt giá trị ban đầu của input trong khoảng [min, max]
        let currentValue = parseInt(input.val(), 10);
        if (currentValue < min) {
            input.val(min);
        } else if (currentValue > max) {
            input.val(max);
        }

        // Gọi callback khi có thay đổi
        function triggerChange() {
            if (typeof onChange === "function") {
                onChange(input.val());
            }
        }

        // Kiểm tra giá trị input khi người dùng nhập
        input.on("input", function () {
            let value = parseInt(input.val(), 10);

            if (isNaN(value) || value < min) {
                input.val(min);
            } else if (value > max) {
                input.val(max);
            }

            triggerChange(); // Gọi callback
        });

        // Xử lý khi nhấn nút giảm
        minusBtn.on("click", function () {
            let value = parseInt(input.val(), 10);
            if (value > min) {
                input.val(value - 1);
                triggerChange();
            }
        });

        // Xử lý khi nhấn nút tăng
        plusBtn.on("click", function () {
            let value = parseInt(input.val(), 10);
            if (value < max) {
                input.val(value + 1);
                triggerChange();
            }
        });

        // Ngăn chặn nhập ký tự không hợp lệ
        input.on("keydown", function (e) {
            if ([8, 46, 37, 39].includes(e.keyCode)) {
                return;
            }
            if (e.key.length === 1 && isNaN(Number(e.key))) {
                e.preventDefault();
            }
        });

        // Ngăn chặn việc dán giá trị không hợp lệ
        input.on("paste", function (e) {
            e.preventDefault();
            const pasteData = e.originalEvent.clipboardData.getData("text");
            const pasteValue = parseInt(pasteData, 10);

            if (!isNaN(pasteValue) && pasteValue >= min && pasteValue <= max) {
                input.val(pasteValue);
                triggerChange();
            }
        });
    });
}

// Xử lý checkbox group và quantity
function checkboxGroup() {
    // Lắng nghe sự kiện change trên checkbox group (s_ids[])
    $('input[name="s_ids[]"]').on("change", function () {
        const groupId = $(this).data("group"); // Lấy giá trị data-group
        const isChecked = $(this).is(":checked"); // Kiểm tra trạng thái check

        // Nếu checkbox group này được check
        if (isChecked) {
            // Bỏ chọn tất cả các checkbox group khác
            $('input[name="s_ids[]"]').not(this).prop("checked", false);

            // Check tất cả các checkbox sản phẩm trong nhóm này
            $(`input[name="c_ids[]"][data-group="${groupId}"]`).prop(
                "checked",
                true
            );
        } else {
            // Nếu checkbox group này bị bỏ chọn, bỏ chọn tất cả các checkbox sản phẩm trong nhóm này
            $(`input[name="c_ids[]"][data-group="${groupId}"]`).prop(
                "checked",
                false
            );
        }

        updateTotalPrice();
    });

    // Lắng nghe sự kiện change trên checkbox product (c_ids[])
    $('input[name="c_ids[]"]').on("change", function () {
        const groupId = $(this).data("group"); // Lấy giá trị data-group

        // Kiểm tra trạng thái của tất cả các checkbox sản phẩm trong nhóm hiện tại
        const allChecked =
            $(`input[name="c_ids[]"][data-group="${groupId}"]`).length ===
            $(`input[name="c_ids[]"][data-group="${groupId}"]:checked`).length;

        // Cập nhật checkbox group tương ứng
        const groupCheckbox = $(
            `input[name="s_ids[]"][data-group="${groupId}"]`
        );
        groupCheckbox.prop("checked", allChecked);

        updateTotalPrice();
    });
}

// Cập nhật tổng tiền giỏ hàng
function updateTotalPrice() {
    let total = 0;

    // Lặp qua tất cả các sản phẩm (dù có checked hay không)
    $("input[name='c_ids[]']").each(function () {
        let cartId = $(this).val();
        let priceText = $("#price-" + cartId)
            .text()
            .trim();
        let quantity = parseInt($("#quantity-" + cartId).val()) || 1;

        // Chuyển giá từ dạng "100.000đ" về số (loại bỏ ký tự không phải số)
        let price = parseFloat(priceText.replace(/\D/g, ""));

        // Tính tổng tiền của sản phẩm
        let productTotal = price * quantity;

        // Cập nhật giá của từng sản phẩm vào #total-price-{cartId}
        $("#total-price-" + cartId).text(formatCurrency(productTotal));

        // Kiểm tra nếu checkbox sản phẩm này được chọn
        if ($(this).is(":checked")) {
            total += productTotal;
        }
    });

    // Cập nhật tổng tiền hiển thị
    $("#total-price").text(formatCurrency(total));
}

// // Xử lý sự kiện submit form cart
function submitFormCart() {
    $("form").on("submit", function (e) {
        // Duyệt qua tất cả các checkbox product
        $('input[name="c_ids[]"]').each(function () {
            const cartId = $(this).data("cart-id"); // Lấy cartId
            const quantityInput = $(
                `input[name="quantity[]"][data-cart-id="${cartId}"]`
            ); // Tìm input quantity tương ứng

            // Nếu checkbox không được tích, xóa giá trị quantity
            if (!$(this).is(":checked")) {
                // quantityInput.val(""); // Xóa giá trị quantity
                quantityInput.prop("disabled", true);
            }
        });

        // Tiếp tục submit form
        return true;
    });
}
