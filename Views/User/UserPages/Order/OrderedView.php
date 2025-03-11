<?php 
    $Title = "Đơn Mua Của Bạn | Samsonitu Shoes";
    $extraCSS = [public_dir('css/UserCss/Ordered.css')];
    require_once __DIR__ . "/../../UserLayouts/HeaderView.php"; 
?>
<main>
    <section class="section-ordered" style="max-width: 1400px; margin: 0 auto;">
        <div class="row">
            <div class="col-lg-2 py-3" style="background-color: #F5F5F5; border-radius: 5px;">
                <h5 style="border-bottom: 1px solid #ccc; color: var(--maincolor)" class="py-2">TRANG TÀI KHOẢN</h5>
                <ul style="list-style-type: none;" class="m-0 p-0">
                    <li class="py-2"><b>Xin chào! <?= $_SESSION['userInfo'][0]['fullName']; ?></b></li>
                    <li class="py-2">
                        <a href="<?= route('AccountRoute'); ?>" class="text-dark text-decoration-none hover-maincl" style="font-size: 14px;">
                            Thông tin tài khoản
                        </a>
                    </li>
                    <li class="py-2">
                        <a class="text-decoration-none" href="<?= route('OrderedRoute'); ?>" 
                        style="font-size: 14px; color: var(--maincolor)">
                            Đơn hàng của bạn
                        </a>
                    </li>
                    <li class="py-2">
                        <a class="text-dark text-decoration-none hover-maincl" 
                            href="<?= route('ChangePasswordRoute'); ?>" style="font-size: 14px;">
                            Đổi mật khẩu
                        </a>
                    </li>
                    <li class="py-2">
                        <a class="text-dark text-decoration-none hover-maincl" href="<?= route('LogoutRoute'); ?>" style="font-size: 14px;">
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-10" style="padding: 30px;">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#waitingConfirm">Chờ Xác Nhận</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#confirm">Đã Xác nhận</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#shipping">Chờ Giao Hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#complete">Hoàn Thành</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#canceled">Đã Hủy</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <?php if(!empty($orderedList)) : ?> 
                    <div class="tab-content">
                        <div class="tab-pane container active" id="waitingConfirm">
                            <?php 
                            $waitingConfirmOrders = array_filter($orderedList, function($item) { return $item['status'] == 1; });
                            if (!empty($waitingConfirmOrders)) : 
                                foreach($waitingConfirmOrders as $orderedItem) : 
                            ?>
                                <div class="card order-details mb-2">
                                    <div class="row g-2">
                                        <div class="col-4 col-md-3 text-center">
                                            <img src="<?php echo $orderedItem['image']; ?>" alt="<?php echo $orderedItem['proName']; ?>" class="img-fluid order-image">
                                        </div>
                                        <div class="col-8 col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="card-title mb-1">Thương Hiệu: <?php echo $orderedItem['brandName']; ?></h6>
                                                    <p class="card-text mb-1">Tên Sản Phẩm: <?php echo $orderedItem['proName']; ?></p>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <?php 
                                                    $statusLabels = [
                                                        1 => ['text' => 'Chờ Xác Nhận', 'class' => 'bg-secondary', 'icon' => 'fa-clock'],
                                                        2 => ['text' => 'Đã Xác Nhận', 'class' => 'bg-warning', 'icon' => 'fa-box-archive'],
                                                        3 => ['text' => 'Đang Giao Hàng', 'class' => 'bg-info', 'icon' => 'fa-truck'],
                                                        4 => ['text' => 'Hoàn Thành', 'class' => 'bg-success', 'icon' => 'fa-check-circle'],
                                                        5 => ['text' => 'Đã Hủy', 'class' => 'bg-danger', 'icon' => 'fa-times-circle']
                                                    ];
                                                    $status = $orderedItem['status'];
                                                    $statusInfo = $statusLabels[$status];
                                                    ?>
                                                    <span class="badge <?php echo $statusInfo['class']; ?> status-badge">
                                                        <i class="fas <?php echo $statusInfo['icon']; ?>"></i> 
                                                        <?php echo $statusInfo['text']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <hr class="my-2">
                                            
                                            <div class="row">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Màu Sắc</small>
                                                    <p class="mb-1">
                                                        <div class="circle-product-color" 
                                                            style="background-color: <?= $orderedItem['colorCode']; ?>">
                                                        </div>
                                                        <?php echo $orderedItem['colorName']; ?>
                                                    </p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Kích Thước</small>
                                                    <p class="mb-1"><?php echo $orderedItem['size']; ?></p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Số Lượng</small>
                                                    <p class="mb-1"><?php echo $orderedItem['quantity']; ?></p>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Giá Sản Phẩm</small>
                                                    <p class="mb-1"><?php echo number_format($orderedItem['unitPrice'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Hình Thức Thanh Toán</small>
                                                    <p class="mb-1"><?php echo $orderedItem['paymentForm']; ?></p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <small class="text-muted">Tổng Hóa Đơn</small>
                                                    <p class="fw-bold text-danger mb-1"><?php echo number_format($orderedItem['totalOrder'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; 
                            else : ?>
                                <div class="empty-order-message">
                                    <i class="fas fa-box-open fa-3x mb-3"></i>
                                    <p>Chưa có đơn hàng</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane container fade" id="confirm">
                            <?php 
                            $confirmOrders = array_filter($orderedList, function($item) { return $item['status'] == 2; });
                            if (!empty($confirmOrders)) : 
                                foreach($confirmOrders as $orderedItem) : 
                            ?>
                                <div class="card order-details mb-2">
                                    <div class="row g-2">
                                        <div class="col-4 col-md-3 text-center">
                                            <img src="<?php echo $orderedItem['image']; ?>" alt="<?php echo $orderedItem['proName']; ?>" class="img-fluid order-image">
                                        </div>
                                        <div class="col-8 col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="card-title mb-1">Thương Hiệu: <?php echo $orderedItem['brandName']; ?></h6>
                                                    <p class="card-text mb-1">Tên Sản Phẩm: <?php echo $orderedItem['proName']; ?></p>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <?php 
                                                    $statusLabels = [
                                                        1 => ['text' => 'Chờ Xác Nhận', 'class' => 'bg-secondary', 'icon' => 'fa-clock'],
                                                        2 => ['text' => 'Đã Xác Nhận', 'class' => 'bg-warning', 'icon' => 'fa-box-archive'],
                                                        3 => ['text' => 'Đang Giao Hàng', 'class' => 'bg-info', 'icon' => 'fa-truck'],
                                                        4 => ['text' => 'Hoàn Thành', 'class' => 'bg-success', 'icon' => 'fa-check-circle'],
                                                        5 => ['text' => 'Đã Hủy', 'class' => 'bg-danger', 'icon' => 'fa-times-circle']
                                                    ];
                                                    $status = $orderedItem['status'];
                                                    $statusInfo = $statusLabels[$status];
                                                    ?>
                                                    <span class="badge <?php echo $statusInfo['class']; ?> status-badge">
                                                        <i class="fas <?php echo $statusInfo['icon']; ?>"></i> 
                                                        <?php echo $statusInfo['text']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <hr class="my-2">
                                            
                                            <div class="row">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Màu Sắc</small>
                                                    <p class="mb-1">
                                                        <div class="circle-product-color" 
                                                            style="background-color: <?= $orderedItem['colorCode']; ?>">
                                                        </div>
                                                        <?php echo $orderedItem['colorName']; ?>
                                                    </p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Kích Thước</small>
                                                    <p class="mb-1"><?php echo $orderedItem['size']; ?></p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Số Lượng</small>
                                                    <p class="mb-1"><?php echo $orderedItem['quantity']; ?></p>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Giá Sản Phẩm</small>
                                                    <p class="mb-1"><?php echo number_format($orderedItem['unitPrice'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Hình Thức Thanh Toán</small>
                                                    <p class="mb-1"><?php echo $orderedItem['paymentForm']; ?></p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <small class="text-muted">Tổng Hóa Đơn</small>
                                                    <p class="fw-bold text-danger mb-1"><?php echo number_format($orderedItem['totalOrder'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                endforeach; 
                            else : ?>
                                <div class="empty-order-message">
                                    <i class="fas fa-box-open fa-3x mb-3"></i>
                                    <p>Chưa có đơn hàng</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane container fade" id="shipping">
                            <?php 
                            $shippingOrders = array_filter($orderedList, function($item) { return $item['status'] == 3; });
                            if (!empty($shippingOrders)) : 
                                foreach($shippingOrders as $orderedItem) : 
                            ?>
                                <div class="card order-details mb-2">
                                    <div class="row g-2">
                                        <div class="col-4 col-md-3 text-center">
                                            <img src="<?php echo $orderedItem['image']; ?>" alt="<?php echo $orderedItem['proName']; ?>" class="img-fluid order-image">
                                        </div>
                                        <div class="col-8 col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="card-title mb-1">Thương Hiệu: <?php echo $orderedItem['brandName']; ?></h6>
                                                    <p class="card-text mb-1">Tên Sản Phẩm: <?php echo $orderedItem['proName']; ?></p>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <?php 
                                                    $statusLabels = [
                                                        1 => ['text' => 'Chờ Xác Nhận', 'class' => 'bg-secondary', 'icon' => 'fa-clock'],
                                                        2 => ['text' => 'Đã Xác Nhận', 'class' => 'bg-warning', 'icon' => 'fa-box-archive'],
                                                        3 => ['text' => 'Đang Giao Hàng', 'class' => 'bg-info', 'icon' => 'fa-truck'],
                                                        4 => ['text' => 'Hoàn Thành', 'class' => 'bg-success', 'icon' => 'fa-check-circle'],
                                                        5 => ['text' => 'Đã Hủy', 'class' => 'bg-danger', 'icon' => 'fa-times-circle']
                                                    ];
                                                    $status = $orderedItem['status'];
                                                    $statusInfo = $statusLabels[$status];
                                                    ?>
                                                    <span class="badge <?php echo $statusInfo['class']; ?> status-badge">
                                                        <i class="fas <?php echo $statusInfo['icon']; ?>"></i> 
                                                        <?php echo $statusInfo['text']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <hr class="my-2">
                                            
                                            <div class="row">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Màu Sắc</small>
                                                    <p class="mb-1">
                                                        <div class="circle-product-color" 
                                                            style="background-color: <?= $orderedItem['colorCode']; ?>">
                                                        </div>
                                                        <?php echo $orderedItem['colorName']; ?>
                                                    </p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Kích Thước</small>
                                                    <p class="mb-1"><?php echo $orderedItem['size']; ?></p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Số Lượng</small>
                                                    <p class="mb-1"><?php echo $orderedItem['quantity']; ?></p>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Giá Sản Phẩm</small>
                                                    <p class="mb-1"><?php echo number_format($orderedItem['unitPrice'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Hình Thức Thanh Toán</small>
                                                    <p class="mb-1"><?php echo $orderedItem['paymentForm']; ?></p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <small class="text-muted">Tổng Hóa Đơn</small>
                                                    <p class="fw-bold text-danger mb-1"><?php echo number_format($orderedItem['totalOrder'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                endforeach; 
                            else : ?>
                                <div class="empty-order-message">
                                    <i class="fas fa-box-open fa-3x mb-3"></i>
                                    <p>Chưa có đơn hàng</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane container fade" id="complete">
                            <?php 
                            $completedOrders = array_filter($orderedList, function($item) { return $item['status'] == 4; });
                            if (!empty($completedOrders)) : 
                                foreach($completedOrders as $orderedItem) : 
                            ?>
                                <div class="card order-details mb-2">
                                    <div class="row g-2">
                                        <div class="col-4 col-md-3 text-center">
                                            <img src="<?php echo $orderedItem['image']; ?>" alt="<?php echo $orderedItem['proName']; ?>" class="img-fluid order-image">
                                        </div>
                                        <div class="col-8 col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="card-title mb-1">Thương Hiệu: <?php echo $orderedItem['brandName']; ?></h6>
                                                    <p class="card-text mb-1">Tên Sản Phẩm: <?php echo $orderedItem['proName']; ?></p>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <?php 
                                                    $statusLabels = [
                                                        1 => ['text' => 'Chờ Xác Nhận', 'class' => 'bg-secondary', 'icon' => 'fa-clock'],
                                                        2 => ['text' => 'Đã Xác Nhận', 'class' => 'bg-warning', 'icon' => 'fa-box-archive'],
                                                        3 => ['text' => 'Đang Giao Hàng', 'class' => 'bg-info', 'icon' => 'fa-truck'],
                                                        4 => ['text' => 'Hoàn Thành', 'class' => 'bg-success', 'icon' => 'fa-check-circle'],
                                                        5 => ['text' => 'Đã Hủy', 'class' => 'bg-danger', 'icon' => 'fa-times-circle']
                                                    ];
                                                    $status = $orderedItem['status'];
                                                    $statusInfo = $statusLabels[$status];
                                                    ?>
                                                    <span class="badge <?php echo $statusInfo['class']; ?> status-badge">
                                                        <i class="fas <?php echo $statusInfo['icon']; ?>"></i> 
                                                        <?php echo $statusInfo['text']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <hr class="my-2">
                                            
                                            <div class="row">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Màu Sắc</small>
                                                    <p class="mb-1">
                                                        <div class="circle-product-color" 
                                                            style="background-color: <?= $orderedItem['colorCode']; ?>">
                                                        </div>
                                                        <?php echo $orderedItem['colorName']; ?>
                                                    </p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Kích Thước</small>
                                                    <p class="mb-1"><?php echo $orderedItem['size']; ?></p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Số Lượng</small>
                                                    <p class="mb-1"><?php echo $orderedItem['quantity']; ?></p>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Giá Sản Phẩm</small>
                                                    <p class="mb-1"><?php echo number_format($orderedItem['unitPrice'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Hình Thức Thanh Toán</small>
                                                    <p class="mb-1"><?php echo $orderedItem['paymentForm']; ?></p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <small class="text-muted">Tổng Hóa Đơn</small>
                                                    <p class="fw-bold text-danger mb-1"><?php echo number_format($orderedItem['totalOrder'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                endforeach; 
                            else : ?>
                                <div class="empty-order-message">
                                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                                    <p>Chưa có đơn hàng</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane container fade" id="canceled">
                            <?php 
                            $canceledOrders = array_filter($orderedList, function($item) { return $item['status'] == 5; });
                            if (!empty($canceledOrders)) : 
                                foreach($canceledOrders as $orderedItem) : 
                            ?>
                                <div class="card order-details mb-2">
                                    <div class="row g-2">
                                        <div class="col-4 col-md-3 text-center">
                                            <img src="<?php echo $orderedItem['image']; ?>" alt="<?php echo $orderedItem['proName']; ?>" class="img-fluid order-image">
                                        </div>
                                        <div class="col-8 col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="card-title mb-1">Thương Hiệu: <?php echo $orderedItem['brandName']; ?></h6>
                                                    <p class="card-text mb-1">Tên Sản Phẩm: <?php echo $orderedItem['proName']; ?></p>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <?php 
                                                    $statusLabels = [
                                                        1 => ['text' => 'Chờ Xác Nhận', 'class' => 'bg-secondary', 'icon' => 'fa-clock'],
                                                        2 => ['text' => 'Đã Xác Nhận', 'class' => 'bg-warning', 'icon' => 'fa-box-archive'],
                                                        3 => ['text' => 'Đang Giao Hàng', 'class' => 'bg-info', 'icon' => 'fa-truck'],
                                                        4 => ['text' => 'Hoàn Thành', 'class' => 'bg-success', 'icon' => 'fa-check-circle'],
                                                        5 => ['text' => 'Đã Hủy', 'class' => 'bg-danger', 'icon' => 'fa-times-circle']
                                                    ];
                                                    $status = $orderedItem['status'];
                                                    $statusInfo = $statusLabels[$status];
                                                    ?>
                                                    <span class="badge <?php echo $statusInfo['class']; ?> status-badge">
                                                        <i class="fas <?php echo $statusInfo['icon']; ?>"></i> 
                                                        <?php echo $statusInfo['text']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <hr class="my-2">
                                            
                                            <div class="row">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Màu Sắc</small>
                                                    <p class="mb-1">
                                                        <div class="circle-product-color" 
                                                            style="background-color: <?= $orderedItem['colorCode']; ?>">
                                                        </div>
                                                        <?php echo $orderedItem['colorName']; ?>
                                                    </p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Kích Thước</small>
                                                    <p class="mb-1"><?php echo $orderedItem['size']; ?></p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Số Lượng</small>
                                                    <p class="mb-1"><?php echo $orderedItem['quantity']; ?></p>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Giá Sản Phẩm</small>
                                                    <p class="mb-1"><?php echo number_format($orderedItem['unitPrice'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <small class="text-muted">Hình Thức Thanh Toán</small>
                                                    <p class="mb-1"><?php echo $orderedItem['paymentForm']; ?></p>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <small class="text-muted">Tổng Hóa Đơn</small>
                                                    <p class="fw-bold text-danger mb-1"><?php echo number_format($orderedItem['totalOrder'], 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                endforeach; 
                            else : ?>
                                <div class="empty-order-message">
                                    <i class="fas fa-times-circle fa-3x mb-3"></i>
                                    <p>Chưa có đơn hàng</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="tab-content">
                        <div class="empty-order-message tab-pane container active" id="waitingConfirm">
                            <i class="fas fa-clock fa-3x mb-3"></i>
                            <p>Chưa có đơn hàng</p>
                        </div>
                        <div class="empty-order-message tab-pane container fade" id="confirm">
                            <i class="fas fa-box-archive fa-3x mb-3"></i>
                            <p>Chưa có đơn hàng</p>
                        </div>
                        <div class="empty-order-message tab-pane container fade" id="shipping">
                            <i class="fas fa-truck fa-3x mb-3"></i>
                            <p>Chưa có đơn hàng</p>
                        </div>
                        <div class="empty-order-message tab-pane container fade" id="complete">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <p>Chưa có đơn hàng</p>
                        </div>
                        <div class="empty-order-message tab-pane container fade" id="canceled">
                            <i class="fas fa-times-circle fa-3x mb-3"></i>
                            <p>Chưa có đơn hàng</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php
    require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>