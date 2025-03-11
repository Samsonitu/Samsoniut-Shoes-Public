<?php 
    $activePage = [
        'navItem' => route('AdminRoute'),
    ];
    $extraCSS = [public_dir('css/AdminCss/dashboard.css')];
    $extraJS = [public_dir('js/AdminJS/dashboard.js'), 'https://cdn.jsdelivr.net/npm/chart.js'];

    require_once __DIR__ . "/../AdminLayouts/SidebarView.php"; 
    require_once __DIR__ . "/../AdminLayouts/HeaderView.php"; 
?>

    <!-- Main Content -->
    <div class="dashboard__main">
        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="stats-card">
                    <div class="stats-card__title">Tổng số doanh thu</div>
                    <div class="stats-card__value"><?= formatPrice($totalOrderAndMoney[0]['totalPrice']); ?> VNĐ</div>
                </div>
            </div>
             <div class="col-md-6 col-sm-3">
                <div class="stats-card">
                    <div class="stats-card__title">Tổng số sản phẩm được yêu thích</div>
                    <div class="stats-card__value"><?= $totalWishListProduct[0]['totalWishListProduct'] ?></div>
                </div> 
            </div>
            <div class="col-md-6 col-sm-3">
                <div class="stats-card">
                    <div class="stats-card__title">Tổng số sản phẩm được bán</div>
                    <div class="stats-card__value"><?= $totalOrderAndMoney[0]['totalOrderQuantity'] ?></div>
                </div> 
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <div class="stats-card__title">Tổng số khách hàng</div>
                    <div class="stats-card__value"><?= $totalCustomer[0]['totalCustomer'] ?></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <div class="stats-card__title">Tổng số bài tin tức</div>
                    <div class="stats-card__value"><?= $totalNews[0]['totalNews'] ?></div>
                </div>
            </div>
            <!-- Add more stat cards -->
        </div>

        <!-- Charts -->
        <div class="row">
            <div class="col-md-8">
                <div class="chart-card">
                    <h5 class="chart-card__title">Tổng doanh thu</h5>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-card">
                    <h5 class="chart-card__title">Thống kê đặt hàng</h5>
                    <canvas id="orderChart"></canvas>
                </div>
            </div>
        </div>

    </div>

<?php require_once __DIR__ . "/../AdminLayouts/FooterView.php"; ?>