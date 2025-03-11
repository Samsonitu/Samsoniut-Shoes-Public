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

    const priceFilters = document.querySelectorAll("#price-filter input[name='rangePrice']");
    const genderFilters = document.querySelectorAll("#gender-filter input[type='checkbox']");
    const brandFilters = document.querySelectorAll("#brand-filter input[type='checkbox']");

    priceFilters.forEach(filter => {
        filter.addEventListener("change", filterProducts);
    });

    genderFilters.forEach(filter => {
        filter.addEventListener("change", filterProducts);
    });

    brandFilters.forEach(filter => {
        filter.addEventListener("change", filterProducts);
    });

    function filterProducts() {
        const selectedPrice = document.querySelector("#price-filter input[name='rangePrice']:checked");
    
        const minPrice = selectedPrice ? parseInt(selectedPrice.dataset.min) : null;
        const maxPrice = selectedPrice ? parseInt(selectedPrice.dataset.max) : null;
    
        const selectedGenders = Array.from(document.querySelectorAll("#gender-filter input[type='checkbox']:checked"))
                                     .map(input => input.value.trim());
    
        const selectedBrands = Array.from(document.querySelectorAll("#brand-filter input[type='checkbox']:checked"))
                                     .map(input => input.value.trim());
    
        const products = document.querySelectorAll(".product-item");
        let visibleCount = 0; 
        const noProductsMessage = document.getElementById("no-products");
    
        products.forEach(product => {
            const priceElement = product.querySelector(".product-price-discounted");
            const price = priceElement ? parseInt(priceElement.dataset.priceDiscounted) : 0;
    
            const productGenders = Array.from(product.querySelectorAll(".circle-product-color"))
                                        .map(color => color.dataset.variantGender);
    
            const productBrands = Array.from(product.querySelectorAll(".product-brand"))
                                       .map(brand => brand.dataset.brandId);
    
            let matchesPrice = (!minPrice || price >= minPrice) && (!maxPrice || price <= maxPrice);
            let matchesGender = selectedGenders.length === 0 || selectedGenders.some(gender => productGenders.includes(gender));
            let matchesBrand = selectedBrands.length === 0 || selectedBrands.some(brand => productBrands.includes(brand));
    
            if (matchesPrice && matchesGender && matchesBrand) {
                product.style.display = "block";
                visibleCount++;
            } else {
                product.style.display = "none";
            }
        });
    
        noProductsMessage.style.display = visibleCount === 0 ? "block" : "none";
    }
    

    document.querySelector('.section-product #input-search').addEventListener('input', function (e) {
        let productSearch = e.target.value.trim().toLowerCase();
        let productList = document.querySelector(".product-list");
        let products = productList.querySelectorAll(".product-item");
        let noProductsMessage = document.getElementById("no-products");
    
        let visibleCount = 0; // Đếm số sản phẩm hiển thị
    
        products.forEach(product => {
            let productName = product.querySelector('.product-name a').textContent.toLowerCase();
            if (productSearch === "" || productName.includes(productSearch)) {
                product.style.display = "block";
                visibleCount++;
            } else {
                product.style.display = "none";
            }
        });
    
        // Nếu không có sản phẩm nào hiển thị, hiển thị thông báo
        noProductsMessage.style.display = visibleCount === 0 ? "block" : "none";
    });

    document.querySelectorAll(".sort-option").forEach(item => {
        item.addEventListener("click", function () {
            const sortType = this.dataset.sort;
            document.getElementById("sort-by").textContent = this.textContent; // Cập nhật tiêu đề button
            sortProducts(sortType);
        });
    });
    
    function sortProducts(sortType) {
        const productContainer = document.querySelector(".product-list"); // Chứa danh sách sản phẩm
        const products = Array.from(document.querySelectorAll(".product-item"));
    
        products.sort((a, b) => {
            const nameA = a.querySelector(".product-name a").textContent.trim().toLowerCase();
            const nameB = b.querySelector(".product-name a").textContent.trim().toLowerCase();
    
            const priceA = parseInt(a.querySelector(".product-price-discounted").dataset.priceDiscounted) || 0;
            const priceB = parseInt(b.querySelector(".product-price-discounted").dataset.priceDiscounted) || 0;
    
            const dateA = new Date(a.dataset.dateAdded); // Ngày thêm sản phẩm
            const dateB = new Date(b.dataset.dateAdded);
    
            switch (sortType) {
                case "az":
                    return nameA.localeCompare(nameB);
                case "za":
                    return nameB.localeCompare(nameA);
                case "price-asc":
                    return priceA - priceB;
                case "price-desc":
                    return priceB - priceA;
                default:
                    return 0; // Mặc định không sắp xếp
            }
        });
    
        // Xóa sản phẩm cũ và thêm sản phẩm đã sắp xếp vào container
        productContainer.innerHTML = "";
        products.forEach(product => productContainer.appendChild(product));
    }
    
    
});
