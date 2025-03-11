const btnShowSubnav = document.querySelectorAll(' .show-subnav');
btnShowSubnav.forEach((btn)=>{
    btn.onclick = function () {
        btn.parentElement.nextElementSibling.classList.toggle('show');
        btn.querySelector('.fa-angle-up').classList.toggle('hide');
        btn.querySelector('.fa-angle-down').classList.toggle('hide');
    }
})

function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(price);
}

function debounce(func, delay) {
    let timer;
    return function(...args) {
        clearTimeout(timer);
        timer = setTimeout(() => func.apply(this, args), delay);
    };
}

const searchInput = document.getElementById('search-input');
const resultsContainer = document.getElementById('search-results');

const fetchSearchResults = debounce(function() {
    const query = searchInput.value.trim();
    if (query === '') {
        resultsContainer.innerHTML = '';
        resultsContainer.classList.remove('active'); // Ẩn khi không có query
        return;
    }
    
    fetch(`/tim-kiem/${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            let html = '';
            if (data.success && data.productList && data.productList.length > 0) {
                data.productList.forEach(item => {
                    html += `<a href="san-pham/${item.proSlug}" class="result-item">
                                <img src="${item.image}" alt="${item.proName}" class="result-image">
                                <div class="result-details">
                                    <h4 class="result-title">${item.proName}</h4>
                                    <p class="result-color">${item.colorName}</p>
                                </div>
                             </a>`;
                });
                resultsContainer.classList.add('active'); // Hiển thị khi có kết quả
            } else {
                html = '<p>Không tìm thấy kết quả nào</p>';
                resultsContainer.classList.add('active'); // Hiển thị khi có thông báo không tìm thấy
            }
            resultsContainer.innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
            resultsContainer.innerHTML = '<p>Đã xảy ra lỗi khi tìm kiếm</p>';
            resultsContainer.classList.add('active'); // Hiển thị khi có lỗi
        });
}, 300);

searchInput.addEventListener('keyup', fetchSearchResults);

// Ẩn kết quả khi click ra ngoài
document.addEventListener('click', function(event) {
    if (!searchInput.contains(event.target) && !resultsContainer.contains(event.target)) {
        resultsContainer.classList.remove('active');
    }
});

// Hiển thị lại kết quả khi focus vào input nếu có query
searchInput.addEventListener('focus', function() {
    if (searchInput.value.trim() !== '' && resultsContainer.innerHTML !== '') {
        resultsContainer.classList.add('active');
    }
});

// Khởi tạo - đảm bảo kết quả tìm kiếm ẩn khi trang mới load
document.addEventListener('DOMContentLoaded', function() {
    resultsContainer.classList.remove('active');

    const wishListButtons = document.querySelectorAll('button.wish-list');

    if (wishListButtons.length > 0) {
        wishListButtons.forEach((e) => {
            e.addEventListener('click', function () {
                const productItem = e.closest('.product-item');
                if (!productItem) return;

                const proId = productItem.dataset.proId;
                if (!proId) return;

                fetch(`/them-san-pham-vao-muc-yeu-thich/${proId}`, {
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
                        const wishlistBadge = document.querySelector('.icon-container__link--wishlist .icon-container__badge-count');
                        if (wishlistBadge) {
                            wishlistBadge.textContent = data.totalProWishList;
                        }
                        e.classList.add('active');
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
                .catch(error => console.error('Lỗi khi fetch API:', error));
            });
        });
    }
});

