<?php 
    $title = "Quản Lý Đơn Hàng | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminOrderRoute'),
        'subNavItem' => '',
    ];
    $extraCSS = [
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css',
        'https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css',
        public_dir('css/AdminCss/Order/order.css')
    ];
    $extraJS = [
        'https://code.jquery.com/jquery-3.7.1.js',
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js',
        public_dir('js/AdminJs/Order/order.js')

    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>

<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> /
            <a href="<?= route('AdminOrderRoute'); ?>">Quản lý đơn hàng</a> 
        </p>
    </div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-status="1">Chờ Xác nhận</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-status="2">Đã xác nhận</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-status="3">Đang giao hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-status="4">Hoàn tất</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-status="5">Đơn Hủy</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <table>
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Thông tin sản phẩm</th>
                <th>Tổng đơn hàng</th>
                <th>Thông tin đặt hàng</th>
                <th>Thời gian đặt hàng</th>
                <th>Trạng thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orderList)) : ?>
                <?php foreach ($orderList as $orderItem) : ?>
                    <tr>
                        <td>
                            <input type="hidden" name="orderCode" value="<?= htmlspecialchars($orderItem['orderCode']); ?>">
                            <input type="hidden" name="userId" value="<?= htmlspecialchars($orderItem['userId']); ?>">
                            <?= htmlspecialchars($orderItem['orderCode']); ?>
                        </td>
                        <td>
                            <div><?= htmlspecialchars($orderItem['proName']); ?> 
                                <?= htmlspecialchars($orderItem['colorName']); ?>
                                Size: <?= htmlspecialchars($orderItem['size']); ?>
                            </div>
                            <img width="100px" height="100px" src="/<?= htmlspecialchars($orderItem['image']); ?>" 
                                alt="<?= htmlspecialchars($orderItem['proName'] . ' Màu ' . $orderItem['colorName']); ?>">
                        </td>
                        <td>
                            <?= formatPrice($orderItem['unitPrice']); ?>đ x 
                            <?= htmlspecialchars($orderItem['quantity']); ?> <br> 
                            = <?= formatPrice($orderItem['totalOrder']); ?>đ
                        </td>
                        <td>
                            <span>
                                <?= htmlspecialchars($orderItem['fullName']); ?>
                                <?= $orderItem['gender'] = $orderItem['gender'] === 'male' 
                                ? '<i class="fa-solid fa-mars text-primary"></i>' 
                                : '<i class="fa-solid fa-venus" style="color: pink;"></i>'; ?>
                            </span> 
                            <br>
                            <p>Địa chỉ: <?= htmlspecialchars($orderItem['address']); ?></p>
                        </td>
                        <td><?= htmlspecialchars(formatDateTime($orderItem['orderAt'])); ?></td>
                        <td>
                            <?php 
                            $statusLabels = [
                                1 => ['text' => 'Chờ Xác Nhận', 'class' => 'bg-secondary', 'icon' => 'fa-clock'],
                                2 => ['text' => 'Đã Xác Nhận', 'class' => 'bg-warning', 'icon' => 'fa-box-archive'],
                                3 => ['text' => 'Đang Giao Hàng', 'class' => 'bg-info', 'icon' => 'fa-truck'],
                                4 => ['text' => 'Hoàn Thành', 'class' => 'bg-success', 'icon' => 'fa-check-circle'],
                                5 => ['text' => 'Đã Hủy', 'class' => 'bg-danger', 'icon' => 'fa-times-circle']
                            ];
                            $status = $orderItem['status'];
                            $statusInfo = $statusLabels[$status];
                            ?>
                            <span class="badge <?php echo $statusInfo['class']; ?> status-badge">
                                <i class="fas <?php echo $statusInfo['icon']; ?>"></i> 
                                <?php echo $statusInfo['text']; ?>
                            </span>
                        </td>
                        <td>
                            <input type="hidden" name="orderStatus" value="<?= htmlspecialchars($orderItem['status']); ?>">
                            <input type="hidden" name="orderNote" value="<?= htmlspecialchars($orderItem['note']); ?>">
                            <button class="btn-action btn-action--edit" data-bs-toggle="tooltip" 
                            title="Cập nhật thông tin đơn hàng">
                                <i class="bg-success fa-solid fa-clipboard-check action-icons__icon"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">Không có đơn hàng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="modal fade" id="modalUpdateOrderInfo" 
    tabindex="-1" aria-labelledby="modalUpdateOrderInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin đơn hàng</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- Thông tin đơn hàng (Chỉ hiển thị, không phải input) -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Thông tin đơn hàng</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Mã đơn hàng:</strong> <span id="orderCodeDisplay"></span></p>
                                <p><strong>Khách hàng:</strong> <span id="customerNameDisplay"></span></p>
                                <p><strong>Ngày đặt hàng:</strong> <span id="orderDateDisplay"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Trạng thái:</strong> <span id="orderStatusDisplay" class="badge"></span></p>
                                <p><strong>Địa chỉ:</strong> <span id="customerAddressDisplay"></span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Danh sách sản phẩm (Chỉ hiển thị, không chỉnh sửa) -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Sản phẩm trong đơn hàng</h5>
                        <div id="orderProductsDisplay" class="border rounded p-2 bg-light">
                            <p class="text-muted">Danh sách sản phẩm sẽ hiển thị ở đây...</p>
                        </div>
                    </div>

                    <!-- Form thêm ghi chú -->
                    <form action="<?= route('AdminUpdateOrderRoute'); ?>" method="post">
                        <!-- Input ẩn -->
                        <input type="hidden" id="orderCodeInput" name="orderCode">
                        <input type="hidden" id="userIdInput" name="userId">

                        <div class="col-12 mb-3">
                            <h5 class="border-bottom pb-2">Trạng thái</h5>
                            <select name="orderStatusUpdate" class="form-select">
                                <option value="1">Chờ Xác Nhận</option>
                                <option value="2">Đã Xác Nhận</option>
                                <option value="3">Đang Giao Hàng</option>
                                <option value="4">Hoàn Tất</option>
                                <option value="5">Hủy Đơn Hàng</option>
                            </select>
                        </div>
                        
                        <!-- Ghi chú -->
                        <div class="col-12 mb-3">
                            <h5 class="border-bottom pb-2">Ghi chú</h5>
                            <textarea class="form-control" name="orderNote" rows="4" maxlength="255"
                                placeholder="Nhập ghi chú cho đơn hàng này..." id="orderNoteTextArea"></textarea>
                        </div>

                        <!-- Nút hành động -->
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Hoàn tác</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100" name="SubmitUpdateOrder" 
                                    value="SubmitUpdate">
                                    Cập Nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>
