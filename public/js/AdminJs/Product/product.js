document.addEventListener("DOMContentLoaded", () => {
    // Cache cho dữ liệu sản phẩm (sẽ được tạo động)
    const productData = {};
    
    // Khởi tạo dữ liệu sản phẩm từ các thuộc tính data-*
    function initProductData() {
        document.querySelectorAll('tr[data-product-id]').forEach(row => {
            const productId = row.dataset.productId;
            productData[productId] = { colors: {} };
            
            // Thêm thông tin màu sắc
            row.querySelectorAll('.table__data-variant--color').forEach(colorElement => {
                const colorCode = colorElement.dataset.colorCode;
                productData[productId].colors[colorCode] = {
                    image: colorElement.dataset.image,
                    sizes: []
                };
            });
            
            // Chúng ta sẽ thêm thông tin size cho màu được chọn bên dưới
        });
    }
    
    // Tải dữ liệu size cho màu được chọn
    const loadSizesForColor = async function (productId, colorCode) {
        const encodedColorCode = encodeURIComponent(colorCode); // Mã hóa colorCode
        const url = `/admin/get-sizes/${productId}?colorCode=${encodedColorCode}`;
    
        console.log("Fetching URL:", url); // Debug xem URL đúng không
    
        return fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            console.log("Response status:", response.status);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                productData[productId].colors[colorCode].sizes = data.sizes;
                console.log(data.sizes);
                return data.sizes;
            }
            return [];
        })
        .catch(error => {
            console.error('Error loading sizes:', error);
            return [];
        });
    }
    
    // Cập nhật danh sách size trong dropdown
    function updateSizeDropdown(row, sizes) {
        const sizeSelect = row.querySelector('.size-select');
        sizeSelect.innerHTML = '';
        
        sizes.forEach(sizeData => {
            const option = document.createElement('option');
            option.value = sizeData.size;
            option.textContent = sizeData.size;
            option.dataset.variantId = sizeData.varId;
            option.dataset.price = sizeData.price;
            option.dataset.quantity = sizeData.quantity;
            option.dataset.variantStatus = sizeData.variantStatus;
            option.dataset.variantDescription = sizeData.variantDescription;
            option.dataset.variantDiscount = sizeData.discount;
            sizeSelect.appendChild(option);
        });

        
        // Trigger change event để cập nhật thông tin hiển thị
        sizeSelect.dispatchEvent(new Event('change'));
    }
    
    // Cập nhật thông tin hiển thị dựa trên size được chọn
    function updateProductInfo(row) {
        const sizeSelect = row.querySelector('.size-select');
        const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
        
        if (!selectedOption) return;
        
        const varId = selectedOption.dataset.variantId;
        const price = selectedOption.dataset.price;
        const quantity = selectedOption.dataset.quantity;
        const variantStatus = selectedOption.dataset.variantStatus;

        // Cập nhật hidden input và các thông tin hiển thị
        row.querySelector('.selected-variant-id').value = varId;
        row.querySelector('.product-quantity').textContent = quantity;
        row.querySelector('.product-price').textContent = formatPrice(price) + ' ₫';
        
        // Cập nhật toggle button
        row.querySelector('.btn-action--status').dataset.variantId = varId;
        row.querySelector('.btn-action--status').dataset.variantStatus = variantStatus;
        
        const toggleIcon = row.querySelector('.toggle-icon');
        if (variantStatus === "1") {
            toggleIcon.className = 'fas fa-toggle-on action-icons__icon action-icons__icon--toggle-on bg-success toggle-icon';
        } else {
            toggleIcon.className = 'fas fa-toggle-off action-icons__icon action-icons__icon--toggle-off bg-secondary toggle-icon';
        }
    }
    
    // Xử lý khi click vào màu sắc
    document.querySelectorAll('.table__data-variant--color').forEach(colorOption => {
        colorOption.addEventListener('click', function() {
            const row = this.closest('tr');
            const productId = row.dataset.productId;
            const colorCode = this.dataset.colorCode;
            
            // Cập nhật trạng thái active cho màu
            row.querySelectorAll('.table__data-variant--color').forEach(opt => {
                opt.classList.remove('active');
            });
            this.classList.add('active');
            
            // Cập nhật ảnh sản phẩm
            const image = this.dataset.image;
            row.querySelector('.product-image').src = '/' + image;
            
            // Tải danh sách size cho màu này (nếu chưa có trong cache)
            if (!productData[productId].colors[colorCode].sizes.length) {
                loadSizesForColor(productId, colorCode).then(sizes => {
                    updateSizeDropdown(row, sizes);
                });
            } else {
                updateSizeDropdown(row, productData[productId].colors[colorCode].sizes);
            }
        });
    });
    
    // Xử lý khi chọn size
    document.querySelectorAll('.size-select').forEach(select => {
        select.addEventListener('change', function() {
            const row = this.closest('tr');
            updateProductInfo(row);
        });
    });
    
    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN').format(price);
    }
    
    initProductData();

    const modalUpdateProduct = new bootstrap.Modal(document.getElementById("modalUpdateProduct"));
    const modalChangeStatusProByOption = new bootstrap.Modal(document.getElementById("modalChangeStatusProByOption"));
    const modalTempDeleteProVar = new bootstrap.Modal(document.getElementById("modalTempDeleteProVar"));

    document.querySelectorAll(".btn-action--edit").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation(); 
            const productRow = button.closest("tr"); 
            if (!productRow) return;
            modalUpdateProduct._element.querySelector('#updateVariantProductForm').reset();
            
            const proName = productRow.children[2].textContent.trim();
            const proId = productRow.dataset.productId;
            const proBrandId = productRow.querySelector('input[name="proBrandId"]').value;
            const proSupId = productRow.dataset.proSupId;
            const productDescription = productRow.querySelector('input[name="productDescription"]').value;

            const varId = productRow.querySelector('.size-select').options[productRow.querySelector('.size-select').selectedIndex].dataset.variantId;
            const size = productRow.querySelector('.size-select').options[productRow.querySelector('.size-select').selectedIndex].value;  
            const varColorCode = productRow.querySelector('.table__data-variant--color.active').dataset.colorCode;
            const varColorName = productRow.querySelector('.table__data-variant--color.active').dataset.colorName;
            const varImage = productRow.querySelector('.table__data-image img').src;
            const quantity = productRow.querySelector('.size-select').options[productRow.querySelector('.size-select').selectedIndex].dataset.quantity;
            const price = productRow.querySelector('.size-select').options[productRow.querySelector('.size-select').selectedIndex].dataset.price;
            const varDesc = productRow.querySelector('.size-select').options[productRow.querySelector('.size-select').selectedIndex].dataset.variantDescription;
            const discount = productRow.querySelector('.size-select').options[productRow.querySelector('.size-select').selectedIndex].dataset.variantDiscount;
            const varGender = productRow.querySelector('.table__data-variant--color.active').dataset.gender;
            const proCatIds = JSON.parse(productRow.dataset.proCatIds || "[]").map(String);
            const proMainCatId = productRow.dataset.proMainCatId;

            modalUpdateProduct._element.querySelectorAll('input[name="proIdUpdate"]').forEach((e) => e.value = proId);
            modalUpdateProduct._element.querySelector('input[name="proNameUpdate"]').value = proName;
            modalUpdateProduct._element.querySelectorAll('select[name="proBrandIdUpdate"] option').forEach((e) => {
                if(e.value == proBrandId) e.selected = true;
            });
            modalUpdateProduct._element.querySelectorAll('select[name="proSupIdUpdate"] option').forEach((e) => {
                if(e.value == proSupId) e.selected = true;
            });
            modalUpdateProduct._element.querySelector('textarea[name="proDescUpdate"]').value = productDescription;


            modalUpdateProduct._element.querySelector('input[name="proVarIdUpdate"]').value = varId;
            modalUpdateProduct._element.querySelector('#proVarImageUpdate').src = varImage;
            modalUpdateProduct._element.querySelector('textarea[name="proVarDescUpdate"]').value = varDesc;
            modalUpdateProduct._element.querySelector('input[name="colorNameUpdate"]').value = varColorName;
            modalUpdateProduct._element.querySelector('input[name="colorCodeUpdate"]').value = varColorCode;
            modalUpdateProduct._element.querySelector('input[name="sizeUpdate"]').value = size;
            modalUpdateProduct._element.querySelectorAll('select[name="proVarGenderUpdate"] option').forEach((e) => {
                if(e.value == varGender) e.selected = true;
            });
            modalUpdateProduct._element.querySelector('input[name="quantityUpdate"]').value = quantity;
            modalUpdateProduct._element.querySelector('input[name="priceUpdate"]').value = new Intl.NumberFormat().format(price);
            modalUpdateProduct._element.querySelector('input[name="priceUpdate"]').addEventListener('input', function () {
                let rawValue = this.value.replace(/,/g, '');
                if (!isNaN(rawValue) && rawValue !== '') {
                    this.value = new Intl.NumberFormat().format(rawValue);
                }
            });


            modalUpdateProduct._element.querySelector('input[name="discountUpdate"]').value = discount;
            modalUpdateProduct._element.querySelector('input[name="proVarImageUpdate"]').addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    modalUpdateProduct._element.querySelector('#proVarImageUpdate').src = e.target.result;
                };
                reader.readAsDataURL(file);
                }
            });

            // Hàm cập nhật trạng thái disabled cho danh mục phụ
            function updateCategoryOptions() {
                const mainCatSelect = modalUpdateProduct._element.querySelector('select[name="proMainCatIdUpdate"]');
                const subCatOptions = modalUpdateProduct._element.querySelectorAll('select[name="proCatIdsUpdate[]"] option');

                if (!mainCatSelect) return;

                let selectedMainCat = mainCatSelect.value; // Lấy giá trị danh mục chính hiện tại

                subCatOptions.forEach((option) => {
                    // Nếu option trong danh mục phụ trùng với danh mục chính -> disabled, ngược lại thì bật lên
                    option.disabled = option.value === selectedMainCat;
                });
            }

            // **Thiết lập giá trị ban đầu**
            modalUpdateProduct._element.querySelectorAll('select[name="proCatIdsUpdate[]"] option').forEach((e) => {
                if (proMainCatId === e.value) {
                    e.disabled = true;
                    return;
                };
                e.selected = proCatIds.includes(e.value);
            });

            // Lặp qua các option của select proMainCatId để đặt giá trị mặc định
            modalUpdateProduct._element.querySelectorAll('select[name="proMainCatIdUpdate"] option').forEach((e) => {
                e.selected = proMainCatId === e.value;
            });

            // Lắng nghe sự kiện thay đổi trên danh mục chính
            modalUpdateProduct._element.querySelector('select[name="proMainCatIdUpdate"]').addEventListener('change', updateCategoryOptions);



            modalUpdateProduct.show();
        });
    });

    document.querySelectorAll(".btn-action--status").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const productRow = button.closest("tr"); 
            if (!productRow) return;
    
            const proName = productRow.children[2].textContent.trim();
            const proId = productRow.dataset.productId;
            const varId = button.dataset.variantId;
            const varStatus = button.dataset.variantStatus;
            const size = productRow.querySelector('.size-select').options[productRow.querySelector('.size-select').selectedIndex].value;  

            const variantStatus = button.querySelector('i');
            const variantColor = productRow.querySelector('.table__data-variant--color.active').dataset.colorCode;
    
            document.getElementById("currentStatusOfProVar").innerText = variantStatus.classList.contains('action-icons__icon--toggle-on') 
                ? 'Ẩn trạng thái'
                : 'Hiện trạng thái' ;

            modalChangeStatusProByOption._element.querySelector("#proNameChangingStatus").innerText = proName;
            modalChangeStatusProByOption._element.querySelector("#varColorChangingStatus").style.backgroundColor = variantColor;
            modalChangeStatusProByOption._element.querySelectorAll('input[name="proId"]').forEach((e) => e.value = proId);
            modalChangeStatusProByOption._element.querySelector('input[name="varId"]').value = varId;
            modalChangeStatusProByOption._element.querySelector('input[name="varStatus"]').value = varStatus;
            modalChangeStatusProByOption._element.querySelector('#varSizeChangingStatus').innerText = size;
    
            modalChangeStatusProByOption.show();
        });
    });
    
    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const productRow = button.closest("tr"); 
            if (!productRow) return;
    
            const proName = productRow.children[2].textContent.trim();
            const proId = productRow.dataset.productId;
            const varId = productRow.querySelector('.size-select').options[productRow.querySelector('.size-select').selectedIndex].dataset.variantId;
            const size = productRow.querySelector('.size-select').options[productRow.querySelector('.size-select').selectedIndex].value;  

            const variantColor = productRow.querySelector('.table__data-variant--color.active').dataset.colorCode;
    
            modalTempDeleteProVar._element.querySelector("#proNameDelete").innerText = proName;
            modalTempDeleteProVar._element.querySelector("#varColorDelete").style.backgroundColor = variantColor;
            modalTempDeleteProVar._element.querySelectorAll('input[name="proId"]').forEach((e) => e.value = proId);
            modalTempDeleteProVar._element.querySelector('input[name="varId"]').value = varId;
            modalTempDeleteProVar._element.querySelector('#varSizeDelete').innerText = size;
    
            modalTempDeleteProVar.show();
        });
    });

    new DataTable(
        '#table-product-management', {
            language: {
                info: 'Hiển thị trang _PAGE_ / _PAGES_',
                infoEmpty: 'Không có sản phẩm nào trùng khớp',
                infoFiltered: '(được lọc từ _MAX_ sản phẩm)',
                lengthMenu: 'Hiển thị _MENU_ sản phẩm',
                zeroRecords: 'Không tìm thấy sản phẩm nào',
                search: 'Tìm kiếm:',
                searchPlaceholder: "Nhập từ khóa sản phẩm..."
            },
        }
    );
});