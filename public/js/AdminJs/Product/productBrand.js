document.addEventListener("DOMContentLoaded", () => {
    const imageUpload = document.getElementById('brandImage');
    const imagePreview = document.getElementById('brand-image--preview');

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

    const inputBrandImageUpdate = document.querySelector('input[name="brandImageUpdate"]');
    const brandImageUpdate = document.getElementById('brandImageUpdating');
    inputBrandImageUpdate.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            brandImageUpdate.src = e.target.result;
            brandImageUpdate.style.display = 'block';
        };
        reader.readAsDataURL(file);
        }
    });

    const modalUpdateProductBrand = new bootstrap.Modal(document.getElementById("modalUpdateProductBrand"));
    const modalDeleteProBrand = new bootstrap.Modal(document.getElementById("modalDeleteProBrand"));
    let currentForm = null;

    document.querySelectorAll(".btn-action--edit").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation(); 
            const brandRow = button.closest("tr"); 
            
            if (!brandRow) return;

            const brandId = brandRow.children[0].querySelector('input[name="brandId"]').value.trim();
            const brandName = brandRow.children[1].textContent.trim();
            console.log(brandRow.children[2].querySelector('img').src);
            const brandImage = brandRow.children[2].querySelector('img').src;
            
            const catDesc = brandRow.children[3].textContent.trim();

            document.getElementById("brandIdUpdating").value = brandId;
            document.getElementById("brandNameUpdating").value = brandName;
            document.getElementById("brandImageUpdating").src = brandImage;
            document.getElementById("descriptionUpdating").value = catDesc;

            modalUpdateProductBrand.show();
        });
    });

    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
    
            const brandRow = button.closest("tr"); 
            if (!brandRow) return;
    
            currentForm = button.parentElement; 
    
            const brandName = brandRow.children[1].textContent.trim();
    
            document.getElementById("brandNameDelete").innerText = brandName;
    
            modalDeleteProBrand.show();

            const btnConfirmDeleteProBrand = modalDeleteProBrand._element.querySelector('button[name="ConfirmSubmitDeleteProBrand"]');
            const btnCancelDeleteProBrand = modalDeleteProBrand._element.querySelector('button[name="CancelSubmitDeleteProBrand"]');

            btnConfirmDeleteProBrand.addEventListener("click", () => {
                if (!currentForm) return;     
                console.log(currentForm);
                
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "SubmitDeleteProductBrand";
                hiddenInput.value = "submitDelete";
            
                currentForm.appendChild(hiddenInput);

                currentForm.submit();
            });
            
            btnCancelDeleteProBrand.addEventListener("click", () => {
                if (!currentForm) return;
            
                currentForm.reset();
                modalDeleteProBrand.hide();
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            });
        });
    });

    new DataTable(
        '#table-product-brand-management', {
            language: {
                info: 'Hiển thị trang _PAGE_ / _PAGES_',
                infoEmpty: 'Không có thương hiệu nào trùng khớp',
                infoFiltered: '(được lọc từ _MAX_ thương hiệu)',
                lengthMenu: 'Hiển thị _MENU_ thương hiệu',
                zeroRecords: 'Không tìm thấy thương hiệu nào',
                search: 'Tìm kiếm:',
                searchPlaceholder: "Nhập từ khóa thương hiệu..."
            },
        }
    );
});
