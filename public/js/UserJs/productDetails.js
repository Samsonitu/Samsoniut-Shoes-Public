document.addEventListener('DOMContentLoaded', function () {
    const btnMinus = document.getElementById('btn-minus');
    const btnPlus = document.getElementById('btn-plus');
    const quantityInput = document.getElementById('orderQuantity');

    const mainImage = document.querySelector('.main-product-img img');
    const thumbnailImage = document.querySelectorAll('.list-product-img img');
    const variantSizes = document.querySelector('.sizes .list-size');
    const variantPrice = document.querySelector('.price');
    const variantStatus = document.querySelector('.status');
    const listProductColor = document.querySelectorAll('.product-details .circle-product-color');

    const orderColorCode = document.querySelector('input[name="orderColorCode"]');
    const orderSize = document.querySelector('input[name="orderSize"]');

    const btnSubmitOrder = document.querySelector('input[name="SubmitOrderFast"]');
    const btnAddToCart = document.querySelector('#btn-add-to-cart');

    btnAddToCart.addEventListener('click', function () {
        const proId = document.querySelector('.product-item').dataset.proId;
        const varId = JSON.parse(document.querySelector('.list-size button.active').dataset.size).varId;

        if(!proId || !varId || !quantityInput.value) {
            toast({
                type: 'warning',
                title: 'Thất bại',
                message: 'Thêm sản phẩm vào giỏ hàng thất bại, vui lòng kiểm tra lại'
            })
            return false;
        }

        fetch(`them-san-pham-vao-gio-hang/${proId}/${varId}/${quantityInput.value}`, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.redirect) {
                window.location.href = data.redirect;
                return;
            }

            if (data.success) {
                const cartBadge = document.querySelector('.icon-container__link--cart .icon-container__badge-count');
                if (cartBadge) {
                    cartBadge.textContent = data.totalProInCart;
                }
                toast({
                    type: 'success',
                    title: 'Thành công',
                    message: `${data.message}`
                });
            } else {
                toast({
                    type: 'error',
                    title: 'Thất bại',
                    message: `${data.message}`
                });
            }
        })
    });

    thumbnailImage.forEach((e) => {
        e.addEventListener('click', () => {
            thumbnailImage.forEach(e => e.classList.remove('active'));
            e.classList.add('active');
            mainImage.src = e.src;

            listProductColor.forEach((element) => {
                element.classList.remove('active');
                if(element.dataset.colorCode.includes(e.dataset.colorCode)) {
                    element.classList.add('active');
                    orderColorCode.value = e.dataset.colorCode;
                }
            });

            variantSizes.innerHTML = "";
            let htmls = "";
            JSON.parse(e.dataset.sizes).forEach((size, index) => {
                if(index === 0) {
                    orderSize.value = size.size;
                    variantPrice.querySelector('.product-price-discounted').innerText = formatPrice(size.price * (100 - size.discount) / 100);
                    variantPrice.querySelector('.product-price-old').innerText = formatPrice(size.price);
                    if(size.quantity >= 1) {
                        btnSubmitOrder.removeAttribute('disabled');
                        variantStatus.style.color = "var(--maincolor)"
                        variantStatus.innerText = 'Còn Hàng';
                    }else {
                        btnSubmitOrder.setAttribute('disabled', true);
                        variantStatus.innerText = 'Hết Hàng';
                        variantStatus.style.color = "red";
                    }
                }
                htmls += `
                <button class="btn border border-1 btn-default btn-sm ${index === 0 ? 'active' : ''}"
                data-size=${JSON.stringify(size)}
                >

                    ${size.size}
                </button>
                `;
            });
            variantSizes.innerHTML = htmls;

            variantSizes.querySelectorAll('button').forEach((e) => {
                e.addEventListener('click', () => {
                    orderSize.value = JSON.parse(e.dataset.size).size;
                    variantSizes.querySelectorAll('button').forEach((el) => {
                        el.classList.remove('active');
                    })
                    e.classList.add('active');
                    if(JSON.parse(e.dataset.size).quantity >= 1) {
                        btnSubmitOrder.removeAttribute('disabled');
                        variantStatus.style.color = "var(--maincolor)"
                        variantStatus.innerText = 'Còn Hàng';
                    }else {
                        btnSubmitOrder.setAttribute('disabled', true);
                        variantStatus.innerText = 'Hết Hàng';
                        variantStatus.style.color = "red";
                    }
                })
            })
        })
    })  

    listProductColor.forEach((e) => {
        e.addEventListener('click', () => {
            listProductColor.forEach((element) => {
                element.classList.remove('active');
            });
            e.classList.add('active');
            orderColorCode.value = e.dataset.colorCode;

            mainImage.src = '/' + e.dataset.image;
            thumbnailImage.forEach((el) => {
                el.classList.remove('active');
                if(el.dataset.colorCode === e.dataset.colorCode) {
                    el.classList.add('active');
                }
            })

            variantSizes.innerHTML = "";
            let htmls = "";
            JSON.parse(e.dataset.sizes).forEach((size, index) => {
                if(index === 0) {
                    orderSize.value = size.size;
                    variantPrice.querySelector('.product-price-discounted').innerText = formatPrice(size.price * (100 - size.discount) / 100);
                    variantPrice.querySelector('.product-price-old').innerText = formatPrice(size.price);
                    if(size.quantity >= 1) {
                        btnSubmitOrder.removeAttribute('disabled');
                        variantStatus.style.color = "var(--maincolor)"
                        variantStatus.innerText = 'Còn Hàng';
                    }else {
                        btnSubmitOrder.setAttribute('disabled', true);
                        variantStatus.innerText = 'Hết Hàng';
                        variantStatus.style.color = "red";
                    }
                }
                htmls += `
                <button class="btn border border-1 btn-default btn-sm ${index === 0 ? 'active' : ''}"
                data-size=${JSON.stringify(size)}>
                    ${size.size}
                </button>
                `;
            });
            variantSizes.innerHTML = htmls;

            variantSizes.querySelectorAll('button').forEach((e) => {
                e.addEventListener('click', () => {
                    orderSize.value = JSON.parse(e.dataset.size).size;
                    variantSizes.querySelectorAll('button').forEach((el) => {
                        el.classList.remove('active');
                    })
                    e.classList.add('active');
                    if(JSON.parse(e.dataset.size).quantity >= 1) {
                        btnSubmitOrder.removeAttribute('disabled');
                        variantStatus.style.color = "var(--maincolor)"
                        variantStatus.innerText = 'Còn Hàng';
                    }else {
                        btnSubmitOrder.setAttribute('disabled', true);
                        variantStatus.innerText = 'Hết Hàng';
                        variantStatus.style.color = "red";
                    }
                })
            })
        })
    })  
    variantSizes.querySelectorAll('button').forEach((e) => {
        e.addEventListener('click', () => {
            orderSize.value = JSON.parse(e.dataset.size).size;
            variantSizes.querySelectorAll('button').forEach((el) => {
                el.classList.remove('active');
            })
            
            e.classList.add('active');
            if(JSON.parse(e.dataset.size).quantity >= 1) {
                btnSubmitOrder.removeAttribute('disabled');
                variantStatus.style.color = "var(--maincolor)"
                variantStatus.innerText = 'Còn Hàng';
            }else {
                btnSubmitOrder.setAttribute('disabled', true);
                variantStatus.innerText = 'Hết Hàng';
                variantStatus.style.color = "red";
            }
        })
    })

    btnMinus.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value) || 1;
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    btnPlus.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value) || 1;
        quantityInput.value = currentValue + 1;
    });

    // Ngăn nhập chữ và số âm vào input
    quantityInput.addEventListener('input', function () {
        let value = quantityInput.value.replace(/[^0-9]/g, ''); // Chỉ cho nhập số
        if (value === '' || parseInt(value) < 1) {
            quantityInput.value = 1;
        } else {
            quantityInput.value = value;
        }
    });

    document.querySelectorAll('.section-product-suggestion .circle-product-color').forEach((e) => {
        e.addEventListener('click', function () {
            const productItem = e.closest('.product-item');

            productItem.querySelectorAll('.circle-product-color').forEach((el) => {
                el.classList.remove('active');
            });
            e.classList.add('active');
    
            let price = parseFloat(e.dataset.variantPrice) || 0;
            let discount = parseFloat(e.dataset.variantDiscount) || 0;
            let discountedPrice = price * (100 - discount) / 100;
            
            productItem.querySelector('.product-item-image').src = "/" + e.dataset.variantImage;
            productItem.querySelector('.sale-flash').innerText = discount + '%';
            productItem.querySelector('.product-price-discounted').innerText = formatPrice(discountedPrice);
            productItem.querySelector('.product-price-old').innerText = formatPrice(price);
        });
    });
})