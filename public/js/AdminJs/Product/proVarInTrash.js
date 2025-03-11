$(document).ready(function () {
    $('#trashProductTable').DataTable({
        "paging": true,
        "lengthMenu": [10, 25, 50, 100],
        "ordering": true,
        "info": true,
        "language": {
            "lengthMenu": "Hiển thị _MENU_ sản phẩm mỗi trang",
            "zeroRecords": "Không tìm thấy sản phẩm nào",
            "info": "Đang hiển thị _START_ đến _END_ trong tổng _TOTAL_ sản phẩm",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ sản phẩm)",
            "search": "Tìm kiếm:",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Tiếp",
                "previous": "Trước"
            }
        }
    });

    const modalDelProVarPermanently = new bootstrap.Modal(document.getElementById('modalDelProVarPermanently'));
    const modalRestoreProVarInTrash = new bootstrap.Modal(document.getElementById('modalRestoreProVarInTrash'));

    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const productRow = button.closest("tr"); 
            if (!productRow) return;
    
            const proName = productRow.dataset.productName;
            const proId = productRow.dataset.productId;
            const varId = productRow.dataset.variantId;
            const varColorCode = productRow.dataset.colorCode;
            const varSize = productRow.dataset.size;
    
            modalDelProVarPermanently._element.querySelector('input[name="proId"]').value = proId;
            modalDelProVarPermanently._element.querySelector('input[name="varId"]').value = varId;
            modalDelProVarPermanently._element.querySelector("#proVarNameDelete").innerText = proName;
            modalDelProVarPermanently._element.querySelector("#varColorDelete").style.backgroundColor = varColorCode;
            modalDelProVarPermanently._element.querySelector('#varSizeDelete').innerText = varSize;
    
            modalDelProVarPermanently.show();
        });
    });

    document.querySelectorAll(".btn-action--restore").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const productRow = button.closest("tr"); 
            if (!productRow) return;
    
            const proName = productRow.dataset.productName;
            const proId = productRow.dataset.productId;
            const varId = productRow.dataset.variantId;
            const varColorCode = productRow.dataset.colorCode;
            const varSize = productRow.dataset.size;
    
            modalRestoreProVarInTrash._element.querySelector('input[name="proId"]').value = proId;
            modalRestoreProVarInTrash._element.querySelector('input[name="varId"]').value = varId;
            modalRestoreProVarInTrash._element.querySelector("#proVarNameRestore").innerText = proName;
            modalRestoreProVarInTrash._element.querySelector("#varColorRestore").style.backgroundColor = varColorCode;
            modalRestoreProVarInTrash._element.querySelector('#varSizeRestore').innerText = varSize;
    
            modalRestoreProVarInTrash.show();
        });
    });
});
