$(document).ready(function () {
    $('table').DataTable({
        "paging": true,
        "lengthMenu": [10, 25, 50, 100],
        "ordering": true,
        "info": true,
        "language": {
            "lengthMenu": "Hiển thị _MENU_ tin tức mỗi trang",
            "zeroRecords": "Không tìm thấy tin tức nào",
            "info": "Đang hiển thị _START_ đến _END_ trong tổng _TOTAL_ tin tức",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ tin tức)",
            "search": "Tìm kiếm:",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Tiếp",
                "previous": "Trước"
            }
        }
    });

    const modalDelNewsPermanently = new bootstrap.Modal(document.getElementById('modalDelNewsPermanently'));
    const modalRestoreNewsInTrash = new bootstrap.Modal(document.getElementById('modalRestoreNewsInTrash'));

    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const newsRow = button.closest("tr"); 
            if (!newsRow) return;
    
            const title = newsRow.dataset.title;
            const newsId = newsRow.dataset.newsId;
    
            modalDelNewsPermanently._element.querySelector('input[name="newsIdDelete"]').value = newsId;
            modalDelNewsPermanently._element.querySelector('#titleDelete').innerText = title;
    
            modalDelNewsPermanently.show();
        });
    });

    document.querySelectorAll(".btn-action--restore").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const newsRow = button.closest("tr"); 
            if (!newsRow) return;
    
            const title = newsRow.dataset.title;
            const newsId = newsRow.dataset.newsId;
    
            modalRestoreNewsInTrash._element.querySelector('input[name="newsIdRestore"]').value = newsId;
            modalRestoreNewsInTrash._element.querySelector('#titleRestore').innerText = title;
    
            modalRestoreNewsInTrash.show();
        });
    });
})