const adminFunctions = [
    { title: "Bảng điều khiển", href: "/admin" },
    { title: "Quản lý sản phẩm", href: "/admin/product" },
    { title: "Thêm sản phẩm", href: "/admin/create-product" },
    { title: "Quản lý danh mục sản phẩm", href: "/admin/product-category" },
    { title: "Nhà cung cấp", href: "/admin/product-supplier" },
    { title: "Quản lý tài khoản", href: "/admin/account" },
    { title: "Thương hiệu", href: "/admin/product-brand" },
    { title: "Quản lý đơn hàng", href: "/admin/order" },
];


const searchInput = document.getElementById("adminSearch");
const searchResults = document.getElementById("searchResults");

searchInput.addEventListener("input", function () {
    const query = this.value.trim().toLowerCase();
    searchResults.innerHTML = ""; 

    if (query === "") {
        searchResults.style.display = "none";
        return;
    }

    const filtered = adminFunctions.filter(item => item.title.toLowerCase().includes(query));

    if (filtered.length > 0) {
        searchResults.style.display = "block";
        filtered.forEach(item => {
            const li = document.createElement("li");
            li.innerHTML = `<a href="${item.href}" class="dropdown-item">${item.title}</a>`;
            searchResults.appendChild(li);
        });
    } else {
        searchResults.style.display = "none";
    }
});

document.addEventListener("click", function (e) {
    if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
        searchResults.style.display = "none";
    }
});


const btnsDropdownSubnav = document.querySelectorAll('.btn-dropdown-subnav');
btnsDropdownSubnav.forEach((btn) => {
    let currentNavItem = btn.parentElement;
    let iconDropdown = btn.querySelector('i');
    btn.addEventListener('click', (e) => {
        e.preventDefault()
        if(currentNavItem.nextElementSibling.style.display == "block") {
            currentNavItem.nextElementSibling.style = "display: none;";
            iconDropdown.style = "transform: rotate(0); transition: transform 0.3s ease;"
        }else {
            currentNavItem.nextElementSibling.style = "display: block";
            iconDropdown.style = "transform: rotate(90deg); transition: transform 0.3s ease;"
        }
    });
})