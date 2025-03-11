const imageUpload = document.getElementById('imageUpload');
const imagePreview = document.getElementById('imagePreview');

imageUpload.addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
    } else {
        imagePreview.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Reference đến form
    const variantForm = document.getElementById('variantProductForm');
    
    // Lấy thông tin biến thể hiện có từ dữ liệu đã hiển thị
    function getExistingVariants() {
        const variants = [];
        const variantBlocks = document.querySelectorAll('.variant-block');
        
        variantBlocks.forEach(block => {
            const colorName = block.querySelector('.color-name').textContent;
            const colorCode = block.querySelector('.color-swatch').style.backgroundColor;
            const sizes = Array.from(block.querySelectorAll('.size-label')).map(el => el.textContent);
            
            variants.push({
                colorName,
                colorCode,
                sizes
            });
        });
        
        return variants;
    }
    
    // Hiển thị hình ảnh xem trước
    const imageUpload = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');
    
    imageUpload.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                imagePreview.style.maxWidth = '150px';
                imagePreview.style.marginTop = '10px';
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Tự động format giá
    const priceInput = document.getElementById('price');
    priceInput.addEventListener('input', function () {
        let value = this.value.replace(/,/g, '');
        if (!isNaN(value)) {
        this.value = new Intl.NumberFormat().format(value);
        }
    });

    
    // Validate form trước khi submit
    variantForm.addEventListener('submit', function(event) {
        // Reset thông báo lỗi
        document.getElementById('sizeError').textContent = '';
        document.getElementById('colorNameError').textContent = '';
        document.getElementById('colorCodeError').textContent = '';
        document.getElementById('variant-error').textContent = '';
        
        const existingVariants = getExistingVariants();
        const newColorName = variantForm.querySelector('[name="colorName"]').value.trim();
        const newColorCode = variantForm.querySelector('[name="colorCode"]').value;
        const newSize = variantForm.querySelector('[name="size"]').value;
        
        // Kiểm tra kích thước trùng
        let sizeExists = false;
        
        for (const variant of existingVariants) {
            // Nếu màu giống nhau (tên hoặc mã)
            if (variant.colorName.toLowerCase() === newColorName.toLowerCase() || 
                normalizeColorCode(variant.colorCode) === normalizeColorCode(newColorCode)) {
                
                // Kiểm tra xem kích thước có bị trùng không
                if (variant.sizes.includes(newSize)) {
                    sizeExists = true;
                    break;
                }
            }
        }
        
        if (sizeExists) {
            document.getElementById('sizeError').textContent = 'Kích thước này đã tồn tại cho màu này!';
            document.getElementById('variant-error').textContent = 'Vui lòng kiểm tra lại thông tin biến thể';
            event.preventDefault();
            window.scrollTo({
                top: document.getElementById('section-divider-title').offsetTop,
                behavior: 'smooth'
            });
            return false;
        }
        
        // Kiểm tra các trường bắt buộc khác
        const requiredFields = variantForm.querySelectorAll('[required]');
        let hasError = false;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                hasError = true;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (hasError) {
            document.getElementById('variant-error').textContent = 'Vui lòng điền đầy đủ thông tin bắt buộc';
            event.preventDefault();
            window.scrollTo({
                top: document.getElementById('section-divider-title').offsetTop,
                behavior: 'smooth'
            });
            return false;
        }
        
        // Validate giá
        const price = priceInput.value.replace(/\D/g, '');
        if (parseInt(price) <= 0) {
            document.getElementById('variant-error').textContent = 'Giá sản phẩm không hợp lệ';
            priceInput.classList.add('is-invalid');
            event.preventDefault();
            return false;
        }
        
        // Nếu mọi thứ đều hợp lệ, tiếp tục submit form
        return true;
    });
    
    // Hàm chuẩn hóa mã màu để so sánh
    function normalizeColorCode(colorCode) {
        // Xử lý colorCode từ style.backgroundColor (rgb(x,y,z) hoặc #hex)
        if (colorCode.startsWith('rgb')) {
            // Trích xuất giá trị RGB
            const rgb = colorCode.match(/\d+/g);
            if (rgb && rgb.length === 3) {
                // Chuyển đổi RGB thành hex
                return '#' + (1 << 24 | rgb[0] << 16 | rgb[1] << 8 | rgb[2]).toString(16).slice(1);
            }
        }
        return colorCode.toLowerCase();
    }

    document.querySelector('button[type="reset"]').addEventListener('click', () => {
        imagePreview.src = "";
    })
});

