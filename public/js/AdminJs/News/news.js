document.addEventListener("DOMContentLoaded", function() {
    const modalChangingStatusNews = new bootstrap.Modal(document.getElementById("modalChangingStatusNews"));
    const modalTempDeleteNews = new bootstrap.Modal(document.getElementById("modalTempDeleteNews"));

    let currentForm = null;
    document.querySelectorAll(".btn-action--status").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
    
            const newsRow = button.closest("tr"); 
            if (!newsRow) return;
    
            currentForm = button.parentElement; 
    
            const title = newsRow.children[1].textContent.trim();
            const newsStatus = button.querySelector('i');
    
            document.getElementById("titleChangingStatus").innerText = title;
            document.getElementById("newsCurrentStatus").innerText = newsStatus.classList.contains('action-icons__icon--toggle-on') 
                ? 'ẩn'
                : 'hiển thị' ;
    
                modalChangingStatusNews.show();

            const btnConfirmChangingStatus = modalChangingStatusNews._element.querySelector('button[name="ConfirmSubmitChangingStatus"]');
            const btnCancelSubmitChangingStatus = modalChangingStatusNews._element.querySelector('button[name="CancelSubmitChangingStatus"]');

            btnConfirmChangingStatus.addEventListener("click", () => {
                if (!currentForm) return;     
                console.log(currentForm);
                
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "SubmitChangeStatusNews";
                hiddenInput.value = "submitChangeStatus";
            
                currentForm.appendChild(hiddenInput);

                currentForm.submit();
            });
            
            btnCancelSubmitChangingStatus.addEventListener("click", () => {
                if (!currentForm) return;
            
                currentForm.reset();
                modalChangingStatusNews.hide();
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        });
    });

    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
    
            const newsRow = button.closest("tr"); 
            if (!newsRow) return;
    
            currentForm = button.parentElement; 
    
            const newsCat = newsRow.children[1].textContent.trim();
    
            document.getElementById("titleDelete").innerText = newsCat;
    
            modalTempDeleteNews.show();

            const btnConfirmTempDeleteProCat = modalTempDeleteNews._element.querySelector('button[name="ConfirmSubmitTempDeleteNews"]');
            const btnCancelTempDeleteProCat = modalTempDeleteNews._element.querySelector('button[name="CancelSubmitTempDeleteNews"]');

            btnConfirmTempDeleteProCat.addEventListener("click", () => {
                if (!currentForm) return;     
                console.log(currentForm);
                
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "SubmitTempDeleteNews";
                hiddenInput.value = "submitDelete";
            
                currentForm.appendChild(hiddenInput);

                currentForm.submit();
            });
            
            btnCancelTempDeleteProCat.addEventListener("click", () => {
                if (!currentForm) return;
            
                currentForm.reset();
                modalTempDeleteNews.hide();
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        });
    });

    new DataTable(
        '#table-news-management', {
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


