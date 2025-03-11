const imageUpload = document.getElementById('imageUpload');
const imagePreview = document.getElementById('imagePreview');

imageUpload.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
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

// Lấy các phần tử DOM
const productForm = document.getElementById('productForm');
const productNameInput = document.getElementById('productName');
const productNameError = document.getElementById('productNameError');
const btnSubmit = document.querySelector('button[type="submit"]');
const mainCategory = document.querySelector('#mainCategory');
const subCategory = document.querySelector('#subCategory');

let isValidLength = false;
let isUnique = false;

productNameInput.addEventListener('input', function () {
    const proName = this.value.trim();
    if (proName.length > 50) {
        productNameError.style.display = 'block';
        productNameError.innerText = 'Tên sản phẩm không được vượt quá 50 ký tự.';
        isValidLength = false;
    } else {
        productNameError.style.display = 'none';
        isValidLength = true;
    }
    validateForm();
});

productNameInput.addEventListener('blur', async () => {
    let proName = productNameInput.value.trim();

    if (!proName) {
        productNameError.style.display = 'block';
        productNameError.innerText = 'Tên sản phẩm không được để trống';
        isUnique = false;
        validateForm();
        return;
    }

    if (!isValidLength) return; 

    try {
        const response = await fetch(`/admin/check-exists-product/${encodeURIComponent(proName)}`);
        const data = await response.json();

        if (!data.success) {
            isUnique = false;
            productNameError.style.display = 'block';
            productNameError.innerText = data.message;
        } else {
            isUnique = true;
            productNameError.style.display = 'none';
        }
        validateForm();
    } catch (error) {
        console.error("Lỗi khi fetch dữ liệu", error);
    }
});

// Xử lý chọn danh mục cha - con
mainCategory.addEventListener('change', () => {
    const selectedValue = mainCategory.value;
    subCategory.querySelectorAll('option').forEach(option => {
        if (option.value === selectedValue) {
            option.setAttribute('disabled', true);
        } else {
            option.removeAttribute('disabled');
        }
    });
});

productForm.addEventListener('submit', function (e) {
    if (!isValidLength || !isUnique) {
        e.preventDefault();
        productNameError.style.display = 'block';
    }
});

function validateForm() {
    if (isValidLength && isUnique) {
        btnSubmit.removeAttribute('disabled');
    } else {
        btnSubmit.setAttribute('disabled', true);
    }
}

