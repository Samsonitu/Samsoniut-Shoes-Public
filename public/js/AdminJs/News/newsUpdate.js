// Đợi tài liệu tải xong trước khi khởi tạo Quill
document.addEventListener("DOMContentLoaded", function() {
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    // Khi form submit, lấy nội dung và lưu vào input ẩn
    document.querySelector("form").onsubmit = function() {
        document.querySelector("#quillContent").value = quill.root.innerHTML;
    };
});
