<?php 
    $title = "Chi Tiết Sản Phẩm | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminProductRoute'),
        'subNavItem' => route('AdminProductRoute'),
    ];
    $extraCSS = [
        public_dir('css/AdminCss/Product/product.css'), 
    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>

<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> /
            <a href="<?= route('AdminProductRoute'); ?>">Quản lý sản phẩm</a> /
            <a href="<?= route('AdminProductDetailsRoute', ['proId' => $productDetailsInfo['proId']]); ?>">
                <?= $productDetailsInfo['proName'] ?>
            </a>
        </p>
    </div>
    <!-- Thông tin gốc của sản phẩm -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><?= $productDetailsInfo['proName'] ?></h3>
                <span class="badge bg-light text-dark"><?= $productDetailsInfo['brandName'] ?></span>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <p><i class="bi bi-info-circle"></i> <strong>Mã sản phẩm:</strong> <?= $productDetailsInfo['proId'] ?></p>
                <p><i class="bi bi-bookmark"></i> <strong>Thương hiệu:</strong> <?= $productDetailsInfo['brandName'] ?></p>
                <p><i class="bi bi-bookmark"></i> <strong>Nhà cung cấp:</strong> <?= $productDetailsInfo['supName'] ?></p>
                <p><i class="bi bi-tag"></i> <strong>Danh mục chính:</strong> <?= $productDetailsInfo['mainCategory'] ?></p>
                <p><i class="bi bi-tag"></i> 
                    <strong>Danh mục phụ:</strong> 
                    <?php
                        $subCategories = [];
                        foreach ($productDetailsInfo['categories'] as $categoryItem) {
                            if ($categoryItem['mainMapping'] != 1 && $categoryItem['catActive'] == 1) {
                                $subCategories[] = $categoryItem['catName'];
                            }
                        }
                        echo implode(" - ", $subCategories);
                    ?>
                </p>

                <?php if (!empty($productDetailsInfo['mappingDesc'])) { ?>
                    <p><i class="bi bi-card-text"></i> <strong>Mô tả mapping:</strong> <?= $productDetailsInfo['mappingDesc'] ?></p>
                <?php } ?>
                <p><i class="bi bi-file-text"></i> <strong>Mô tả:</strong> <?= $productDetailsInfo['productDescription'] ?></p>
            </div>
        </div>
    </div>
    
    <!-- Đếm số lượng biến thể màu sắc -->
    <div class="alert alert-info">
        Tổng số biến thể màu sắc: <?= count($productDetailsInfo['colors']) ?>
    </div>
    
    <!-- Tabs cho từng màu sắc -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h4 class="mb-0"><i class="bi bi-palette"></i> Các biến thể sản phẩm</h4>
        </div>
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="colorTabs" role="tablist">
                <?php 
                $firstTab = true;
                
                // Duyệt qua mảng màu sắc đúng cách
                foreach ($productDetailsInfo['colors'] as $colorCode => $color) { 
                    // Tạo ID an toàn cho HTML
                    $colorId = preg_replace('/[^a-z0-9]/i', '', $colorCode);
                ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $firstTab ? 'active' : '' ?>" 
                            id="color-<?= $colorId ?>-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#color-<?= $colorId ?>" 
                            type="button" 
                            role="tab" 
                            aria-controls="color-<?= $colorId ?>" 
                            aria-selected="<?= $firstTab ? 'true' : 'false' ?>">
                        <div class="d-flex align-items-center">
                            <div style="width: 15px; height: 15px; background-color: <?= $color['colorCode'] ?>; border-radius: 50%; margin-right: 8px; border: 1px solid #ddd;"></div>
                            <?= $color['colorName'] ?>
                        </div>
                    </button>
                </li>
                <?php 
                    $firstTab = false;
                } 
                ?>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content p-3 border border-top-0 rounded-bottom">
                <?php 
                $firstTab = true;
                foreach ($productDetailsInfo['colors'] as $colorCode => $color) {
                    $colorId = preg_replace('/[^a-z0-9]/i', '', $colorCode);
                ?>
                <div class="tab-pane fade <?= $firstTab ? 'show active' : '' ?>" 
                     id="color-<?= $colorId ?>" 
                     role="tabpanel" 
                     aria-labelledby="color-<?= $colorId ?>-tab">
                    
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <img src="/<?= $color['image'] ?>" alt="<?= $color['colorName'] ?>" class="img-fluid rounded shadow-sm mb-2" style="max-height: 200px; object-fit: contain;">
                            <div class="badge bg-dark text-white mb-2">
                                <?= $color['colorName'] ?> (<?= $color['colorCode'] ?>)
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Mã biến thể</th>
                                            <th>Kích thước</th>
                                            <th>Giá (VNĐ)</th>
                                            <th>Giảm giá</th>
                                            <th>Trạng thái</th>
                                            <th>Thông tin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($color['sizes'] as $size) { ?>
                                        <tr>
                                            <td><?= $size['varId'] ?></td>
                                            <td><strong><?= $size['size'] ?></strong></td>
                                            <td class="text-end"><?= number_format($size['price'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <?php if ($size['discount'] > 0) { ?>
                                                <span class="badge bg-danger"><?= $size['discount'] ?>%</span>
                                                <div class="small text-muted mt-1">
                                                    <?= formatPrice($size['price'] * (100 - $size['discount']) / 100) ?> VNĐ
                                                </div>
                                                <?php } else { ?>
                                                <span class="text-muted">-</span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($size['status']) { ?>
                                                <span class="badge bg-success">Đang Hiển thị</span>
                                                <div class="small text-muted mt-1">SL: <?= $size['quantity'] ?></div>
                                                <?php } else { ?>
                                                <span class="badge bg-danger">Đang Ẩn</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-secondary" 
                                                        type="button" 
                                                        data-bs-toggle="collapse" 
                                                        data-bs-target="#details-<?= $size['varId'] ?>" 
                                                        aria-expanded="false">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="collapse" id="details-<?= $size['varId'] ?>" style="transition: height 0.3s ease-out;">
                                            <td colspan="6" class="bg-light">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <small><strong>Ngày tạo:</strong> <?= formatDate($size['createAt']); ?></small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <small><strong>Cập nhật:</strong> <?= formatDateTime($size['lastUpdated']); ?></small>
                                                    </div>
                                                    <?php if (!empty($size['variantDescription'])) { ?>
                                                    <div class="col-md-12 mt-2">
                                                        <small><strong>Mô tả biến thể:</strong> <?= $size['variantDescription'] ?></small>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $firstTab = false;
                } 
                ?>
            </div>
        </div>
    </div>
</div>
  

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>
