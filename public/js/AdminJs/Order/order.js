document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('.nav'); // Lắng nghe sự kiện từ phần tử cha
    nav.addEventListener('click', function (event) {
        const target = event.target.closest('.nav-link');
        if (!target) return; // Nếu không phải .nav-link thì bỏ qua
    
        document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
        target.classList.add('active');
    
        fetch(`/admin/order-by-status/${target.dataset.status}`, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) return;
    
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = ''; // Xóa nội dung cũ
    
            const statusLabels = {
                1: { text: 'Chờ Xác Nhận', class: 'bg-secondary', icon: 'fa-clock' },
                2: { text: 'Đã Xác Nhận', class: 'bg-warning', icon: 'fa-box-archive' },
                3: { text: 'Đang Giao Hàng', class: 'bg-info', icon: 'fa-truck' },
                4: { text: 'Hoàn Thành', class: 'bg-success', icon: 'fa-check-circle' },
                5: { text: 'Đã Hủy', class: 'bg-danger', icon: 'fa-times-circle' }
            };
    
            if (data.orderList.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7">Không có đơn hàng nào.</td></tr>`;
                return;
            }
    
            const fragment = document.createDocumentFragment();
            data.orderList.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <input type="hidden" name="orderCode" value="${order.orderCode}">
                        <input type="hidden" name="userId" value="${order.userId}">
                        ${order.orderCode}
                    </td>
                    <td>
                        <div>${order.proName} 
                            ${order.colorName}
                            Size: ${order.size}
                        </div>
                        <img width="100px" height="100px" src="/${order.image}" 
                            alt="${order.proName} Màu ${order.colorName}">
                    </td>
                    <td>
                        ${formatPrice(order.unitPrice)}đ x 
                        ${order.quantity} <br> 
                        = ${formatPrice(order.totalOrder)}đ
                    </td>
                    <td>
                        <span>
                            ${order.fullName}
                            ${order.gender === 'male' 
                                ? '<i class="fa-solid fa-mars text-primary"></i>' 
                                : '<i class="fa-solid fa-venus" style="color: pink;"></i>'}
                        </span> 
                        <br>
                        <p>Địa chỉ: ${order.address}</p>
                    </td>
                    <td>${formatDateTime(order.orderAt)}</td>
                    <td>
                        <span class="badge ${statusLabels[order.status].class} status-badge">
                            <i class="fas ${statusLabels[order.status].icon}"></i> 
                            ${statusLabels[order.status].text}
                        </span>
                    </td>
                    <td>
                        <input type="hidden" name="orderStatus" value="${order.status}">
                        <input type="hidden" name="orderNote" value="${order.note}">
                        <button class="btn-action btn-action--edit" data-bs-toggle="tooltip" 
                        title="Cập nhật thông tin đơn hàng">
                            <i class="bg-success fa-solid fa-clipboard-check action-icons__icon"></i>
                        </button>
                    </td>
                `;
                fragment.appendChild(row);
            });
            
            tbody.appendChild(fragment); // Chỉ cập nhật DOM một lần
            
            // Khởi tạo lại tooltips sau khi cập nhật DOM
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Khởi tạo lại event listeners cho nút edit
            document.querySelectorAll(".btn-action--edit").forEach((button) => {
                button.addEventListener("click", handleEditButtonClick);
            });
        })
        .catch(error => console.error('Lỗi khi fetch API:', error));
    });

    document.querySelectorAll(".btn-action--edit").forEach((button) => {
        button.addEventListener("click", handleEditButtonClick);
    });
    // Hàm xử lý sự kiện click nút edit - tách riêng để có thể gọi lại sau khi cập nhật DOM
    function handleEditButtonClick(e) {
        e.stopPropagation();
        const orderRow = this.closest("tr");
        if (!orderRow) return;
    
        // Lấy thông tin từ bảng
        const orderCode = orderRow.querySelector('input[name="orderCode"]').value.trim();
        const userId = orderRow.querySelector('input[name="userId"]').value.trim();
        
        // Lấy thông tin khách hàng
        const customerCell = orderRow.cells[3];
        const customerNameElement = customerCell.querySelector('span');
        const customerName = customerNameElement ? customerNameElement.innerHTML.trim() : 'Không có thông tin';
        
        // Lấy địa chỉ khách hàng
        const addressElement = customerCell.querySelector('p');
        const customerAddress = addressElement ? addressElement.textContent.replace('Địa chỉ:', '').trim() : 'Không có địa chỉ';
        
        // Lấy ngày đặt hàng
        const orderDate = orderRow.cells[4].textContent.trim();
        
        // Lấy thông tin trạng thái
        const statusBadge = orderRow.cells[5].querySelector('.status-badge');
        const statusText = statusBadge.textContent.trim();
        const statusClass = statusBadge.classList[1]; // Lấy class màu (bg-warning, bg-success, etc.)
        
        // Lấy thông tin sản phẩm và ảnh
        const productCell = orderRow.cells[1];
        const productImg = productCell.querySelector('img');
        const imgSrc = productImg ? productImg.src : '';
        const imgAlt = productImg ? productImg.alt : 'Hình ảnh sản phẩm';
        
        // Lấy thông tin giá và số lượng
        const priceCell = orderRow.cells[2].textContent.trim();

        // Lấy thông tin ghi chú
        const orderNote = orderRow.querySelector('input[name="orderNote"]').value;

        // Lấy thông tin trạng thái
        const orderStatus = orderRow.querySelector('input[name="orderStatus"]').value;
        
        
        // Cập nhật thông tin hiển thị trong modal
        document.getElementById("orderCodeDisplay").textContent = orderCode;
        document.getElementById("customerNameDisplay").innerHTML = customerName;
        document.getElementById("orderDateDisplay").textContent = orderDate;
        document.getElementById("customerAddressDisplay").textContent = customerAddress;
        
        // Hiển thị trạng thái với badge tương tự
        const statusElement = document.getElementById("orderStatusDisplay");
        statusElement.textContent = statusText;
        statusElement.className = "badge " + statusClass;
        
        // Cập nhật giá trị form
        document.getElementById("orderCodeInput").value = orderCode;
        document.getElementById("userIdInput").value = userId;
        document.getElementById("orderNoteTextArea").value = orderNote;
        console.log(document.querySelectorAll("select[name='orderStatusUpdate'] option"));
        
        document.querySelectorAll("select[name='orderStatusUpdate'] option").forEach(e => {
            if(e.value == orderStatus) e.selected = true
        });

        // Hiển thị thông tin sản phẩm (đơn giản hóa vì chỉ có 1 sản phẩm)
        const orderProductsContainer = document.getElementById("orderProductsDisplay");
        
        // Lấy thông tin sản phẩm trực tiếp từ các ô trong bảng
        const productName = productCell.querySelector('div').textContent.trim();
        
        orderProductsContainer.innerHTML = `
            <div class="p-2 border rounded">
                <div class="row">
                    <div class="col-md-3 text-center mb-2">
                        <img src="${imgSrc}" alt="${imgAlt}" class="img-fluid" style="max-height: 100px;">
                    </div>
                    <div class="col-md-9">
                        <div><b>${productName}</b></div>
                        <div>${priceCell}</div>
                    </div>
                </div>
            </div>
        `;
    
        // Hiển thị modal
        const modalUpdateOrderInfo = new bootstrap.Modal(document.getElementById("modalUpdateOrderInfo"));
        modalUpdateOrderInfo.show();
    }
    
    new DataTable(
        'table', {
            language: {
                info: 'Hiển thị trang _PAGE_ / _PAGES_',
                infoEmpty: 'Không có đơn hàng nào trùng khớp',
                infoFiltered: '(được lọc từ _MAX_ sản phẩm)',
                lengthMenu: 'Hiển thị _MENU_ sản phẩm',
                zeroRecords: 'Không tìm thấy đơn hàng nào',
                search: 'Tìm kiếm:',
                searchPlaceholder: "Nhập từ khóa đơn hàng..."
            },
        }
    );
});

// Hàm định dạng tiền tệ
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}

// Hàm định dạng ngày giờ
function formatDateTime(dateTime) {
    const date = new Date(dateTime);
    return `${date.toLocaleTimeString('vi-VN')} ${date.toLocaleDateString('vi-VN')}`;
}
