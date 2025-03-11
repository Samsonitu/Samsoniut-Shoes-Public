document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.querySelector('#select-all');
    const checkBoxOrderCodeList = document.querySelectorAll('.cart__body input[name="checkBoxOrderCode"]');
    const totalCheckBoxOrderCode = document.querySelector('#totalCheckBoxOrderCode');
    const totalProductOrder = document.querySelector('#total-items');
    const totalPriceOrder = document.querySelector('#totalPriceOrder');
    const orderCodesContainer = document.querySelector('#orderCodesContainer'); // Container chứa input

    // Hàm cập nhật tổng sản phẩm và tổng giá
    function updateOrderSummary() {
        let selectedCodes = [];
        let totalPrice = 0;
        let countSelected = 0;

        // Xóa tất cả input[name="orderCodes[]"] cũ
        orderCodesContainer.innerHTML = '';

        checkBoxOrderCodeList.forEach((e) => {
            if (e.checked) {
                // Chia nhỏ từng mã đơn hàng và thêm vào mảng
                let orderCodes = e.value.split(',');
                orderCodes.forEach(code => {
                    selectedCodes.push(code.trim());

                    // Tạo input[name="orderCodes[]"] mới
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'orderCodes[]';
                    input.value = code.trim();
                    orderCodesContainer.appendChild(input);
                });

                countSelected++;

                // Lấy giá trị từ data-item-total của sản phẩm
                let itemTotal = parseFloat(e.closest('.cart__item').querySelector('.cart__item-total').dataset.itemTotal);
                totalPrice += itemTotal;
            }
        });

        // Cập nhật số lượng sản phẩm đã chọn
        totalCheckBoxOrderCode.innerText = countSelected > 0 ? `(${countSelected})` : '';
        totalProductOrder.innerText = countSelected.toString();

        // Tính tổng giá và cộng phí vận chuyển nếu có sản phẩm được chọn
        totalPriceOrder.innerText = countSelected > 0 ? `${formatPrice(totalPrice + 40000)}` : '0';
    }

    // Xử lý khi thay đổi trạng thái checkbox sản phẩm
    checkBoxOrderCodeList.forEach((e) => {
        e.addEventListener('change', function () {
            updateOrderSummary();
        });
    });

    // Xử lý chọn tất cả sản phẩm
    selectAll.addEventListener('change', function () {
        checkBoxOrderCodeList.forEach((e) => {
            e.checked = selectAll.checked;
        });
        updateOrderSummary();
    });
});
