document.addEventListener("DOMContentLoaded", () => {
    const modalUpdateCategoryProduct = new bootstrap.Modal(document.getElementById("modalUpdateProductCategory"));
    const modalChangingStatusCategoryProduct = new bootstrap.Modal(document.getElementById("modalChangeStatusProductCategory"));
    const modalTempDeleteProCat = new bootstrap.Modal(document.getElementById("modalTempDeleteProCat"));
    let currentForm = null;

    document.querySelectorAll(".btn-action--edit").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation(); 
            const categoryRow = button.closest("tr"); 
            if (!categoryRow) return;

            const catId = categoryRow.children[0].querySelector('input[name="categoryId"]').value.trim();
            const catName = categoryRow.children[1].textContent.trim();
            const catDesc = categoryRow.children[2].textContent.trim();

            document.getElementById("categoryIdUpdating").value = catId;
            document.getElementById("categoryNameUpdating").value = catName;
            document.getElementById("descriptionUpdating").value = catDesc;

            modalUpdateCategoryProduct.show();
        });
    });

    document.querySelectorAll(".btn-action--status").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
    
            const categoryRow = button.closest("tr"); 
            if (!categoryRow) return;
    
            currentForm = button.parentElement; 
    
            const catName = categoryRow.children[1].textContent.trim();
            const catStatus = button.querySelector('i');
    
            document.getElementById("categoryCurrentStatus").innerText = catName;
            document.getElementById("categoryNameChangingStatus").innerText = catStatus.classList.contains('action-icons__icon--toggle-on') 
                ? 'ẩn'
                : 'hiển thị' ;
    
            modalChangingStatusCategoryProduct.show();

            const btnConfirmChangingStatus = modalChangingStatusCategoryProduct._element.querySelector('button[name="ConfirmSubmitChangingStatus"]');
            const btnCancelSubmitChangingStatus = modalChangingStatusCategoryProduct._element.querySelector('button[name="CancelSubmitChangingStatus"]');

            btnConfirmChangingStatus.addEventListener("click", () => {
                if (!currentForm) return;     
                console.log(currentForm);
                
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "SubmitChangeStatusProductCategory";
                hiddenInput.value = "submitChangeStatus";
            
                currentForm.appendChild(hiddenInput);

                currentForm.submit();
            });
            
            btnCancelSubmitChangingStatus.addEventListener("click", () => {
                if (!currentForm) return;
            
                currentForm.reset();
                modalChangingStatusCategoryProduct.hide();
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        });
    });
    
    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
    
            const categoryRow = button.closest("tr"); 
            if (!categoryRow) return;
    
            currentForm = button.parentElement; 
    
            const catName = categoryRow.children[1].textContent.trim();
    
            document.getElementById("categoryNameDelete").innerText = catName;
    
            modalTempDeleteProCat.show();

            const btnConfirmTempDeleteProCat = modalTempDeleteProCat._element.querySelector('button[name="ConfirmSubmitTempDeleteProCat"]');
            const btnCancelTempDeleteProCat = modalTempDeleteProCat._element.querySelector('button[name="CancelSubmitTempDeleteProCat"]');

            btnConfirmTempDeleteProCat.addEventListener("click", () => {
                if (!currentForm) return;     
                console.log(currentForm);
                
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "SubmitTempDeleteProCat";
                hiddenInput.value = "submitDelete";
            
                currentForm.appendChild(hiddenInput);

                currentForm.submit();
            });
            
            btnCancelTempDeleteProCat.addEventListener("click", () => {
                if (!currentForm) return;
            
                currentForm.reset();
                modalTempDeleteProCat.hide();
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        });
    });

    new DataTable(
        '#table-product-category-management', {
            language: {
                info: 'Hiển thị trang _PAGE_ / _PAGES_',
                infoEmpty: 'Không có danh mục nào trùng khớp',
                infoFiltered: '(được lọc từ _MAX_ danh mục)',
                lengthMenu: 'Hiển thị _MENU_ danh mục',
                zeroRecords: 'Không tìm thấy danh mục nào',
                search: 'Tìm kiếm:',
                searchPlaceholder: "Nhập từ khóa danh mục..."
            },
        }
    );
});
