document.addEventListener("DOMContentLoaded", () => {
    var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');

    if (tooltipTriggerList.length > 0) { // Chỉ chạy nếu có tooltip
        var tooltipList = [].slice.call(tooltipTriggerList).map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
