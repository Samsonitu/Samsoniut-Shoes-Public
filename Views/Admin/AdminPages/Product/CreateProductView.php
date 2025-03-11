<?php 
    $title = "Tạo Sản Phẩm Mới | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminProductRoute'),
        'subNavItem' => route('AdminProductRoute'),
    ];
    $extraCSS = [public_dir('css/AdminCss/Product/createProduct.css')];
    $extraJS = [
        public_dir('js/AdminJs/Product/createProduct.js')];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>

<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> / 
            <a href="<?= route('AdminProductRoute'); ?>">Quản lý sản phẩm</a> / 
            <a href="<?= route('AdminCreateProductRoute'); ?>">Tạo sản phẩm mới</a>
        </p>
    </div>  
    <div class="form-container">
        <form id="productForm" action="<?= route('AdminHandleCreateProductRoute'); ?>" method="post"
        enctype="multipart/form-data">
            <!-- Tên sản phẩm -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="productName" class="form-label">Tên sản phẩm:</label>
                    <input type="text" name="proName" class="form-control" id="productName" placeholder="Nhập tên sản phẩm" maxlength="51" required>
                    <div class="error-message" id="productNameError"></div>
                </div>
                <div class="col-md-6">
                    <label for="brand" class="form-label">Thương hiệu:</label>
                    <select name="brandId" class="form-select" id="brand">
                        <?php foreach($brandList as $brandItem): ?>
                            <option value="<?= $brandItem['brandId']; ?>">
                                <?= $brandItem['brandName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
    
            <!-- Danh mục chính và phụ -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="mainCategory" class="form-label">Danh mục chính:</label>
                    <select name="mainCategoryId" class="form-select" id="mainCategory" required>
                        <option>Chọn danh mục chính</option>
                        <?php foreach($proCatIdAndProCatNameList as $proCatIdAndProCatNameItem): ?>
                            <option value="<?= $proCatIdAndProCatNameItem['catId']; ?>">
                                <?= $proCatIdAndProCatNameItem['catName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <!--  -->
                    <label for="supplier" class="form-label">Nhà cung cấp:</label>
                    <select name="supId" class="form-select" id="supplier" required>
                        <option value="">Chọn nhà cung cấp</option>
                        <?php foreach($productSupplierList as $productSupplierItem): ?>
                            <option value="<?= $productSupplierItem['supId']; ?>">
                                <?= $productSupplierItem['supName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="subCategory" class="form-label">Danh mục phụ:</label>
                    <select name="subCategoryIds[]" class="form-select" id="subCategory" multiple>
                        <?php foreach($proCatIdAndProCatNameList as $proCatIdAndProCatNameItem): ?>
                            <option value="<?= $proCatIdAndProCatNameItem['catId']; ?>">
                                <?= $proCatIdAndProCatNameItem['catName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="row mb-3">
                <div class="col-12">
                <textarea name="proDesc" class="form-control" placeholder="Mô tả sản phẩm"></textarea>
                </div>
            </div>

            <!-- Thông tin biến thể -->
            <div class="mb-3">
                <label class="form-label">Thông tin biến thể:</label>
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
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="colorName" class="form-control w-100" placeholder="Tên màu" maxlength="50" required>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="quantity" class="form-control" placeholder="Số lượng" min="1" required>
                    </div>
                    <div class="col-md-6">
                        <input type="color" name="colorCode" class="form-control w-100" placeholder="Mã màu" maxlength="20" required>
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
                <button type="submit" name="SubmitCreateProduct" class="btn btn-success" value="Submit">
                    <i class="fas fa-save"></i> Lưu sản phẩm
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="fas fa-times me-2"></i>Hoàn tác
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>
