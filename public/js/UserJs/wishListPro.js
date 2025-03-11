document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.circle-product-color').forEach((e) => {
        e.addEventListener('click', function () {
            const productItem = e.closest('.product-item');
            productItem.querySelectorAll('.circle-product-color').forEach((box) => {
                box.classList.remove('active');
            })
            e.classList.add('active');
            let price = parseFloat(e.dataset.variantPrice) || 0;
            let discount = parseFloat(e.dataset.variantDiscount) || 0;
            let discountedPrice = price * (100 - discount) / 100;

            productItem.querySelector('.product-item-image').src = e.dataset.variantImage;
            productItem.querySelector('.sale-flash').innerText = discount + '%';
            productItem.querySelector('.product-price-discounted').innerText = formatPrice(discountedPrice);
            productItem.querySelector('.product-price-old').innerText = formatPrice(price);
        });
    });
});