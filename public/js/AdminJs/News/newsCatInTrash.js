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

    const modalDelNewsCatPermanently = new bootstrap.Modal(document.getElementById('modalDelNewsCatPermanently'));
    const modalRestoreProCatInTrash = new bootstrap.Modal(document.getElementById('modalRestoreNewsCatInTrash'));

    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const newsCatRow = button.closest("tr"); 
            if (!newsCatRow) return;
    
            const newsCatName = newsCatRow.dataset.newsCatName;
            const newsCatId = newsCatRow.dataset.newsCatId;
    
            modalDelNewsCatPermanently._element.querySelector('input[name="newsCatIdDelete"]').value = newsCatId;
            modalDelNewsCatPermanently._element.querySelector('#newsCatNameDelete').innerText = newsCatName;
    
            modalDelNewsCatPermanently.show();
        });
    });

    document.querySelectorAll(".btn-action--restore").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const newsCatRow = button.closest("tr"); 
            if (!newsCatRow) return;
    
            const newsCatName = newsCatRow.dataset.newsCatName;
            const newsCatId = newsCatRow.dataset.newsCatId;
    
            modalRestoreProCatInTrash._element.querySelector('input[name="newsCatIdRestore"]').value = newsCatId;
            modalRestoreProCatInTrash._element.querySelector('#newsCatNameRestore').innerText = newsCatName;
    
            modalRestoreProCatInTrash.show();
        });
    });
})