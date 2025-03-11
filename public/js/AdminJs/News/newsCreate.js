// Đợi tài liệu tải xong trước khi khởi tạo Quill
document.addEventListener("DOMContentLoaded", function() {
    const imageUpload = document.getElementById('thumbnail');
    const imagePreview = document.getElementById('preview-thumbnail');

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

    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    // Khi form submit, lấy nội dung và lưu vào input ẩn
    document.querySelector("form").onsubmit = function() {
        document.querySelector("#quillContent").value = quill.root.innerHTML;
    };
});
