document.addEventListener("DOMContentLoaded", () => {
    const modalUpdateNewsCategory = new bootstrap.Modal(document.getElementById("modalUpdateNewsCategory"));
    const modalChangingStatusNewsCategory = new bootstrap.Modal(document.getElementById("modalChangingStatusNewsCategory"));
    const modalTempDeleteNewsCat = new bootstrap.Modal(document.getElementById("modalTempDeleteNewsCat"));
    let currentForm = null;

    document.querySelectorAll(".btn-action--edit").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation(); 
            const newsCategoryRow = button.closest("tr"); 
            if (!newsCategoryRow) return;

            const newsCatId = newsCategoryRow.children[0].querySelector('input[name="newsCatId"]').value.trim();
            const newsCatName = newsCategoryRow.children[1].textContent.trim();
            const newsCatDesc = newsCategoryRow.children[2].textContent.trim();

            document.getElementById("newsCatIdUpdating").value = newsCatId;
            document.getElementById("newsCatNameUpdating").value = newsCatName;
            document.getElementById("descriptionUpdating").value = newsCatDesc;

            modalUpdateNewsCategory.show();
        });
    });
    
    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
    
            const newsCategoryRow = button.closest("tr"); 
            if (!newsCategoryRow) return;
    
            currentForm = button.parentElement; 
    
            const newsCatName = newsCategoryRow.children[1].textContent.trim();
    
            document.getElementById("newsCategoryNameDelete").innerText = newsCatName;
    
            modalTempDeleteNewsCat.show();

            const btnConfirmTempDeleteNewsCat = modalTempDeleteNewsCat._element.querySelector('button[name="ConfirmSubmitTempDeleteNewsCat"]');
            const btnCancelTempDeleteNewsCat = modalTempDeleteNewsCat._element.querySelector('button[name="ConfirmCancelSubmitTempDeleteNewsCat"]');

            btnConfirmTempDeleteNewsCat.addEventListener("click", () => {
                if (!currentForm) return;     
                console.log(currentForm);
                
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "SubmitTempDeleteNewsCat";
                hiddenInput.value = "submitDelete";
            
                currentForm.appendChild(hiddenInput);

                currentForm.submit();
            });
            
            btnCancelTempDeleteNewsCat.addEventListener("click", () => {
                if (!currentForm) return;
            
                currentForm.reset();
                modalTempDeleteNewsCat.hide();
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        });
    });

    document.querySelectorAll(".btn-action--status").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
    
            const newsCategoryRow = button.closest("tr"); 
            if (!newsCategoryRow) return;
    
            currentForm = button.parentElement; 
    
            const newsCatName = newsCategoryRow.children[1].textContent.trim();
            const newsCatStatus = button.querySelector('i');
    
            document.getElementById("newsCatCurrentStatus").innerText = newsCatName;
            document.getElementById("newsCatNameChangingStatus").innerText = newsCatStatus.classList.contains('action-icons__icon--toggle-on') 
                ? 'ẩn'
                : 'hiển thị' ;
    
            modalChangingStatusNewsCategory.show();

            const btnConfirmChangingStatus = modalChangingStatusNewsCategory._element.querySelector('button[name="ConfirmSubmitChangingStatus"]');
            const btnCancelSubmitChangingStatus = modalChangingStatusNewsCategory._element.querySelector('button[name="CancelSubmitChangingStatus"]');

            btnConfirmChangingStatus.addEventListener("click", () => {
                if (!currentForm) return;     
                console.log(currentForm);
                
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "SubmitChangeStatusNewsCategory";
                hiddenInput.value = "submitChangeStatus";
            
                currentForm.appendChild(hiddenInput);

                currentForm.submit();
            });
            
            btnCancelSubmitChangingStatus.addEventListener("click", () => {
                if (!currentForm) return;
            
                currentForm.reset();
                modalChangingStatusNewsCategory.hide();
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        });
    });

    new DataTable(
        '#table-news-category-management', {
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
