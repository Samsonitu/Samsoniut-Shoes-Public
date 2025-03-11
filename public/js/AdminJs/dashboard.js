document.addEventListener("DOMContentLoaded", function () {
    // Biểu đồ doanh thu theo tháng
    new Chart(document.getElementById("revenueChart"), {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            datasets: [{
                label: "Doanh thu (VNĐ)",
                data: [12000000, 15000000, 18000000, 22000000, 25000000, 27000000],
                borderColor: "rgba(75, 192, 192, 1)",
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: "top" } }
        }
    });

    // Biểu đồ đơn hàng theo trạng thái
    new Chart(document.getElementById("orderChart"), {
        type: "pie",
        data: {
            labels: ["Chờ xử lý", "Đang giao", "Hoàn thành", "Hủy"],
            datasets: [{
                data: [20, 30, 50, 10],
                backgroundColor: ["#f39c12", "#3498db", "#2ecc71", "#e74c3c"]
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: "right" } }
        }
    });
});
