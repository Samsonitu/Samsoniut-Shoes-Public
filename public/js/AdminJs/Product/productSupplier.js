$(document).ready(function () {
    $('table').DataTable({
        "paging": true,
        "lengthMenu": [10, 25, 50, 100],
        "ordering": true,
        "info": true,
        "language": {
            "lengthMenu": "Hiển thị _MENU_ nhà cung cấp mỗi trang",
            "zeroRecords": "Không tìm thấy nhà cung cấp nào",
            "info": "Đang hiển thị _START_ đến _END_ trong tổng _TOTAL_ nhà cung cấp",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ nhà cung cấp)",
            "search": "Tìm kiếm:",
        }
    });

    const modalUpdateProductSupplier = new bootstrap.Modal(document.getElementById("modalUpdateProductSupplier"));
    const modalDeleteProductSupplier = new bootstrap.Modal(document.getElementById("modalDeleteProductSupplier"));

    document.querySelectorAll(".btn-action--edit").forEach((button) => {
        button.addEventListener("click", function () {
            const productRow = this.closest("tr");
            if (!productRow) return;

            // Lấy dữ liệu từ dataset
            const supId = productRow.dataset.supId;
            const supName = productRow.dataset.supName;
            const email = productRow.dataset.email;
            const country = productRow.dataset.country;
            const phoneNumber = productRow.dataset.phoneNumber;
            const address = productRow.dataset.address;
            const description = productRow.dataset.description;

            // Gán dữ liệu vào modal
            modalUpdateProductSupplier._element.querySelector("#supplierId").value = supId;
            modalUpdateProductSupplier._element.querySelector("#supplierName").value = supName;
            modalUpdateProductSupplier._element.querySelector("#supplierNameOld").value = supName;
            modalUpdateProductSupplier._element.querySelector("#supplierEmail").value = email;
            modalUpdateProductSupplier._element.querySelector("#supplierCountry").value = country;
            modalUpdateProductSupplier._element.querySelector("#supplierPhone").value = phoneNumber;
            modalUpdateProductSupplier._element.querySelector("#supplierAddress").value = address;
            modalUpdateProductSupplier._element.querySelector("#supplierDescription").value = description;

            // Hiển thị modal
            modalUpdateProductSupplier.show();
        });
    });


    document.querySelectorAll(".btn-action--delete").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const productRow = button.closest("tr"); 
            if (!productRow) return;
    
            const supId = productRow.dataset.supId;
            const supName = productRow.dataset.supName;
          
    
            modalDeleteProductSupplier._element.querySelector('input[name="supId"]').value = supId;
            modalDeleteProductSupplier._element.querySelector('#supNameDelete').innerText = supName;
    
            modalDeleteProductSupplier.show();
        });
    });
    
});