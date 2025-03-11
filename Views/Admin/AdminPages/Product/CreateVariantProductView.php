<?php 
    $title = "Tạo Biến Thể Sản Phẩm Mới | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminProductRoute'),
        'subNavItem' => route('AdminProductRoute'),
    ];
    $extraCSS = [public_dir('css/AdminCss/Product/createVariantProduct.css')];
    $extraJS = [
        public_dir('js/AdminJs/Product/createVariantProduct.js')];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>

<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> / 
            <a href="<?= route('AdminProductRoute'); ?>">Quản lý sản phẩm</a> / 
            <a href="<?= route('AdminCreateVariantProductRoute', ['proId' => $productExtraInfo['proId']]); ?>">
                Tạo biến thể sản phẩm mới
            </a>
        </p>
    </div> 
    <form id="variantProductForm" action="<?= route('AdminHandleCreateVariantProductRoute') ?>" method="post" enctype="multipart/form-data">
    <h3 id="section-divider-title">---Các biến thể của sản phẩm---</h3>
        <!-- Hiển thị tất cả các biến thể -->
        <div class="all-variants">
            <?php foreach ($productExtraInfo['colors'] as $colorCode => $color): ?>
                <div class="variant-block">
                    <div class="variant-info">
                        <div class="color-info">
                            <span class="color-name"><?= $color['colorName']; ?></span>
                            <span class="color-swatch" style="background-color: <?= $colorCode; ?>"></span>
                            <span class="color-code"><?= $colorCode; ?></span>
                        </div>
                        
                        <div class="variant-image">
                            <img src="/<?= $color['image'] ?>" 
                                alt="<?= $productExtraInfo['proName'] ?> - <?= $color['colorName'] ?>" 
                                width="120" 
                                height="120">
                        </div>
                    </div>
                    
                    <div class="size-list">
                        <?php foreach ($color['sizes'] as $size): ?>
                            <div class="size-item">
                                <span class="size-label"><?= $size['size'] ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr>
        <h3 id="section-divider-title">---Thông tin biến thể mới---</h3>
        <small id="variant-error" class="text-danger"></small>
        <div class="row">
            <div class="mb-3">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="file" name="proImage" class="form-control" id="imageUpload" accept="image/*" required>
                        <img src="#" alt="Ảnh Xem Trước" class="preview-image" id="imagePreview">
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" name="gender" required>
                        <option value="">Chọn giới tính</option>
                        <option value="male">Nam</option>
                        <option value="female">Nữ</option>
                        <option value="unisex">Unisex</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="size" class="form-control" placeholder="Kích thước" min="20" max="50" required>
                        <small class="text-danger" id="sizeError"></small>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="colorName" class="form-control w-100" placeholder="Tên màu" maxlength="50" required>
                        <small class="text-danger" id="colorNameError"></small>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="quantity" class="form-control" placeholder="Số lượng" min="1" required>
                    </div>
                    <div class="col-md-6">
                        <input type="color" name="colorCode" class="form-control w-100" placeholder="Mã màu" maxlength="20" required>
                        <small class="text-danger" id="colorCodeError"></small>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="price" class="form-control" id="price" placeholder="Giá" required>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="discount" max="99" class="form-control" placeholder="Giảm giá %">
                    </div>
                    <div class="col-12">
                        <textarea name="varDesc" class="form-control" placeholder="Mô tả biến thể"></textarea>
                    </div>
                </div>
            </div>
    
            <!-- Nút submit -->
            <div class="text-center">
                <input type="hidden" name="proId" value="<?= $productExtraInfo['proId']; ?>">
                <button type="submit" name="SubmitCreateVariantProduct" class="btn btn-success" value="Submit">
                    <i class="fas fa-save"></i> Lưu sản phẩm
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="fas fa-times me-2"></i>Hủy
                </button>
            </div>
        </div>
    </form>
</div>

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>