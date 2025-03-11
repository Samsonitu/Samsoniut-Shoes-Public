$(document).ready(function () {
    $('table').DataTable({
        "paging": true,
        "lengthMenu": [10, 25, 50, 100],
        "ordering": true,
        "info": true,
        "language": {
            "lengthMenu": "Hiển thị _MENU_ danh mục mỗi trang",
            "zeroRecords": "Không tìm thấy danh mục nào",
            "info": "Đang hiển thị _START_ đến _END_ trong tổng _TOTAL_ danh mục",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ danh mục)",
            "search": "Tìm kiếm:",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Tiếp",
                "previous": "Trước"
            }
        }
    });

    const modalDelProCatPermanently = new bootstrap.Modal(document.getElementById('modalDelProCatPermanently'));
    const modalRestoreProCatInTrash = new bootstrap.Modal(document.getElementById('modalRestoreProCatInTrash'));

    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const proCatRow = button.closest("tr"); 
            if (!proCatRow) return;
    
            const proCatName = proCatRow.dataset.proCatName;
            const proCatId = proCatRow.dataset.proCatId;
    
            modalDelProCatPermanently._element.querySelector('input[name="proCatIdDelete"]').value = proCatId;
            modalDelProCatPermanently._element.querySelector('#proCatNameDelete').innerText = proCatName;
    
            modalDelProCatPermanently.show();
        });
    });

    document.querySelectorAll(".btn-action--restore").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const proCatRow = button.closest("tr"); 
            if (!proCatRow) return;
    
            const proCatName = proCatRow.dataset.proCatName;
            const proCatId = proCatRow.dataset.proCatId;
    
            modalRestoreProCatInTrash._element.querySelector('input[name="proCatIdRestore"]').value = proCatId;
            modalRestoreProCatInTrash._element.querySelector('#proCatNameRestore').innerText = proCatName;
    
            modalRestoreProCatInTrash.show();
        });
    });
})