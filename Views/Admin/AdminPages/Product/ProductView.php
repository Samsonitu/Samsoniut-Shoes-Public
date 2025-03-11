<?php 
    $title = "Quản Lý Sản Phẩm | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminProductRoute'),
        'subNavItem' => route('AdminProductRoute'),
    ];
    $extraCSS = [
        public_dir('css/AdminCss/Product/product.css'), 
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css',
        'https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css'
    ];
    $extraJS = [
        public_dir('js/AdminJs/Product/product.js'),
        'https://code.jquery.com/jquery-3.7.1.js',
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js'
    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>

<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> / 
            <a href="<?= route('AdminProductRoute'); ?>">Quản lý sản phẩm</a>
        </p>
    </div>      
    <table id="table-product-management">
        <div class="d-flex justify-content-between align-items-center gap-2">
            
            <a href="<?= route('AdminProVarInTrashRoute'); ?>">
                Thùng rác (<?php if(!empty($countProVarInTrash)) echo $countProVarInTrash[0]['total']; ?>)
            </a>
            <?php ?>
            <a href="<?= route('AdminCreateProductRoute'); ?>" 
                class="btn btn-primary text-light"
            >
                <i class="fa-solid fa-plus"></i>
                Tạo mới
            </a>
        </div>
        <thead>
            <tr>
                <th class="table__header-stt">SST</th>
                <th class="table__header-productImage">Ảnh</th>
                <th class="table__header-productName">Tên Sản Phẩm</th>
                <th class="table__header-variants">Biến thể</th>
                <th class="table__header-quantity">Số lượng</th>
                <th class="table__header-price">Giá</th>
                <th class="table__header-createAt">Ngày tạo</th>
                <th class="table__header-actions">Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($productList)): 
            $countSTT = 1;
            foreach ($productList as $proId => $product):
                if ($product['productActive'] != 1) continue;

                $selectedColor = null;
                $selectedSize = null;
                
                // Lọc ra các màu có ít nhất một size với variantActive = 1
                $activeColors = [];
                foreach ($product['colors'] as $colorCode => $color) {
                    $activeSizes = [];
                    foreach ($color['sizes'] as $size) {
                        if ($size['variantActive'] == 1) {
                            $activeSizes[] = $size;
                            if (!$selectedColor) {
                                $selectedColor = $color;
                                $selectedSize = $size;
                            }
                        }
                    }
                    
                    if (!empty($activeSizes)) {
                        $color['sizes'] = $activeSizes;
                        $activeColors[$colorCode] = $color;
                    }
                }
                
                // Nếu không có màu nào có biến thể active, bỏ qua sản phẩm này
                if (empty($activeColors)) continue;
                
        ?>
        <tr data-product-id="<?= $proId; ?>" data-pro-main-cat-id="<?= $product['mainCategoryId']; ?>"  
            data-pro-cat-ids="<?= json_encode($product['categoryIds']);?>" data-pro-sup-id="<?= $product['supId'] ?>"
        >
            <td class="table__data-stt">
                <?= $countSTT; ?>
                <input type="hidden" name="productId" value="<?= $proId; ?>">
                <input type="hidden" name="varId" class="selected-variant-id" value="<?= $selectedSize['varId']; ?>">
            </td>
            <td class="table__data-image">
                <img src="/<?= htmlspecialchars($selectedColor['image'], ENT_QUOTES, 'UTF-8'); ?>" 
                    alt="<?= htmlspecialchars($product['proName'], ENT_QUOTES, 'UTF-8'); ?>"
                    width="80px" height="80px" class="product-image">
            </td>
            <td class="table__data-proName">
                <?= htmlspecialchars($product['proName'], ENT_QUOTES, 'UTF-8'); ?>
            </td>
            <td class="table__data-variants">
                <label>Màu sắc:</label>
                <div class="color-options">
                    <?php foreach ($activeColors as $colorCode => $color): ?>
                        <div class="table__data-variant--color <?= ($selectedColor['colorCode'] == $colorCode) ? 'active' : ''; ?>" 
                            data-color-code="<?= $colorCode; ?>"
                            data-color-name="<?= $color['colorName']; ?>"
                            data-image="<?= $color['image']; ?>"
                            data-gender="<?= $color['gender']; ?>"
                            style="background-color: <?= $colorCode; ?>;">
                        </div>
                    <?php endforeach; ?>
                </div>
                <label>Size:</label>
                <select class="size-select">
                    <?php foreach ($selectedColor['sizes'] as $sizeData): ?>
                        <option value="<?= $sizeData['size']; ?>" 
                                data-variant-id="<?= $sizeData['varId']; ?>"
                                data-price="<?= $sizeData['price']; ?>"
                                data-quantity="<?= $sizeData['quantity']; ?>"
                                data-variant-status="<?= $sizeData['variantStatus']; ?>"
                                data-variant-description="<?= $sizeData['variantDescription']; ?>"
                                data-variant-discount="<?= $sizeData['discount']; ?>"
                                <?= ($sizeData['varId'] == $selectedSize['varId']) ? 'selected' : ''; ?>>
                            <?= $sizeData['size']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="table__data-quantity product-quantity">
                <?= $selectedSize['quantity']; ?>
            </td>
            <td class="table__data-price product-price">
                <?= formatPrice($selectedSize['price']); ?> ₫
            </td>
            <td class="table__data-createAt date-column">
                <?= formatDate($selectedSize['createAt']); ?>
            </td>
            <td class="table__data-actions">
                <button class="btn-action" id="btn-action--view" data-bs-toggle="tooltip" title="Xem chi tiết"> 
                    <a href="<?= route('AdminProductDetailsRoute', ['proId' => $proId]) ?>"><i class="bg-info fas fa-eye action-icons__icon action-icons__icon--view"></i></a>
                </button>
                <a href="<?= route('AdminCreateVariantProductRoute', ['proId' => $proId]); ?>" class="btn-action" id="btnCreateNewVariant"
                    data-bs-toggle="tooltip" title="Thêm biến thể mới"
                >
                    <i class="bg-secondary fa-solid fa-plus action-icons__icon"></i>
                </a>
                <button type="button" class="btn-action btn-action--status toggle-button" 
                    data-bs-toggle="tooltip" title="Bật/Tắt hiển thị sản phẩm"
                    data-variant-status="<?= $selectedSize['variantStatus']; ?>"
                    data-variant-id="<?= $selectedSize['varId']; ?>">
                    <?php if ($selectedSize['variantStatus'] == 1): ?>
                        <i class="fas fa-toggle-on action-icons__icon action-icons__icon--toggle-on bg-success toggle-icon"></i>
                    <?php else: ?>
                        <i class="fas fa-toggle-off action-icons__icon action-icons__icon--toggle-off bg-secondary toggle-icon"></i>
                    <?php endif; ?>
                </button>
                <button class="btn-action btn-action--edit" data-bs-toggle="tooltip" title="Chỉnh sửa sản phẩm">
                    <i class="bg-warning fas fa-pen action-icons__icon action-icons__icon--edit"></i>
                </button>
                <form action="<?= route('AdminRemoveProductCategoryRoute'); ?>" method="post" 
                    data-bs-toggle="tooltip" title="Xóa sản phẩm"
                >
                    <input type="hidden" name="categoryIdDelete" value="<?= $proId; ?>">
                    <button type="button" class="btn-action btn-action--delete">
                        <i class="bg-danger fas fa-trash action-icons__icon action-icons__icon--delete"></i>
                    </button>
                </form>
                <input type="hidden" name="productDescription" value="<?= $product['productDescription']; ?>">
                <input type="hidden" name="proBrandId" value="<?= $product['brandId']; ?>">
            </td>
        </tr>
        <?php 
            $countSTT++;
            endforeach;
            endif;
        ?>
        </tbody>
    </table>

    <div class="modal fade" id="modalShowProductDetails"
        tabindex="-1" aria-labelledby="modalShowProductDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết sản phẩm</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?= route('AdminCreateProductCategoryRoute') ?>" method="post">
                        <div class="mb-3 mt-3">
                            <label for="category" class="form-label">
                                <b>
                                    Tên danh mục sản phẩm: 
                                    <sup class="text-danger">(*)</sup>
                                </b>
                            </label>
                            <input type="text" class="form-control" id="category" 
                                placeholder="Nhập tên danh mục sản phẩm" name="categoryName"
                                maxlength="50"
                                required
                                oninvalid="this.setCustomValidity('Vui lòng nhập tên danh mục sản phẩm')"
                                oninput="setCustomValidity('')"
                            >
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="description" class="form-label"><b>Mô tả:</b></label>
                            <textarea 
                                placeholder="Nhập mô tả cho danh mục sản phẩm" 
                                class="form-control" 
                                id="description" 
                                name="description"
                                maxlength="200"
                                rows="5"></textarea>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="submit" class="btn btn-success w-100" name="SubmitCreateProductCategory" value="Tạo mới">
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateProduct" 
        tabindex="-1" aria-labelledby="modalUpdateProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin sản phẩm</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#productUpdating">Thông tin sản phẩm chung</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#productVariantUpdating">Thông tin biến thể sản phẩm</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active" id="productUpdating">
                            <form action="<?= route('AdminUpdateProductRoute'); ?>" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3 mt-3">
                                            <label for="proIdUpdating" class="form-label">
                                                <b>
                                                    Mã sản phẩm:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <input type="number" class="form-control readonly" id="proIdUpdating" 
                                                name="proIdUpdate"
                                                required
                                                readonly
                                            >
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="proNameUpdating" class="form-label">
                                                <b>
                                                    Tên sản phẩm:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <input type="text" class="form-control" id="proNameUpdating" 
                                                placeholder="Nhập tên sản phẩm" name="proNameUpdate"
                                                maxlength="50"
                                                required
                                                oninvalid="this.setCustomValidity('Vui lòng nhập tên sản phẩm')"
                                                oninput="setCustomValidity('')"
                                            >
                                        </div>
                                        <div class="mb-3 mt-3">
                                        <label for="proBrandIdUpdating" class="form-label">
                                            <b>
                                                Thương hiệu:
                                                <sup class="text-danger">(*)</sup>
                                            </b>
                                        </label>
                                        <select name="proBrandIdUpdate" class="form-select">
                                            <?php foreach($brandList as $brandItem): ?>
                                                <option value="<?= $brandItem['brandId']; ?>"><?= $brandItem['brandName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="proBrandIdUpdating" class="form-label">
                                            <b>
                                                Nhà cung cấp:
                                                <sup class="text-danger">(*)</sup>
                                            </b>
                                        </label>
                                        <select name="proSupIdUpdate" class="form-select">
                                            <?php foreach($supplierList as $supplierItem): ?>
                                                <option value="<?= $supplierItem['supId']; ?>">
                                                    <?= $supplierItem['supName']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3 mt-3">
                                            <label for="proMainCatIdUpdate" class="form-label">
                                                <b>
                                                    Danh mục chính của sản phẩm:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <select name="proMainCatIdUpdate" class="form-select" required>
                                                <?php foreach($categoryList as $categoryItem): 
                                                    if($categoryItem['active'] != 1) continue;
                                                ?>
                                                    <option value="<?= $categoryItem['catId']; ?>"><?= $categoryItem['catName']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="proCatIdsUpdate" class="form-label">
                                                <b>
                                                    Danh mục phụ của sản phẩm:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <select name="proCatIdsUpdate[]" class="form-select" multiple>
                                                <?php foreach($categoryList as $categoryItem): 
                                                    if($categoryItem['active'] != 1) continue;
                                                ?>
                                                    <option value="<?= $categoryItem['catId']; ?>"><?= $categoryItem['catName']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="proDescUpdating" class="form-label"><b>Mô tả sản phẩm:</b></label>
                                        <textarea 
                                            placeholder="Nhập mô tả cho danh mục sản phẩm" 
                                            class="form-control" 
                                            id="proDescUpdating" 
                                            name="proDescUpdate"
                                            maxlength="255"
                                            rows="5"></textarea>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <input type="submit" class="btn btn-success w-100" name="SubmitUpdateProduct" value="Cập nhật">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane container fade" id="productVariantUpdating">
                            <form action="<?= route('AdminUpdateProductVariantRoute'); ?>" method="post" id="updateVariantProductForm"
                                enctype="multipart/form-data"
                            >
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mt-3">
                                            <label for="proVarIdUpdating" class="form-label">
                                                <b>
                                                    Mã biến thể sản phẩm:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                                <input type="number" class="form-control readonly" id="proVarIdUpdating" 
                                                    name="proVarIdUpdate"
                                                    required
                                                    readonly
                                                >
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label class="form-label">
                                                <b>
                                                    Ảnh:
                                                </b>
                                            </label>
                                            <img src="" alt="" height="120px" width="120px" id="proVarImageUpdate">
                                            <input type="file" name="proVarImageUpdate">
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="proVarGenderUpdating" class="form-label">
                                                <b>
                                                    Giới tính:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <select name="proVarGenderUpdate" class="form-select" required>
                                                <option value="male">Nam</option>
                                                <option value="female">Nữ</option>
                                                <option value="unisex">Unisex</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="proVarDesc" class="form-label"><b>Mô tả biến thể sản phẩm:</b></label>
                                            <textarea 
                                                placeholder="Nhập mô tả cho biến thể sản phẩm" 
                                                class="form-control" 
                                                id="proVarDescUpdating" 
                                                name="proVarDescUpdate"
                                                maxlength="255"
                                                rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mt-3">
                                            <label for="colorNameUpdating" class="form-label">
                                                <b>
                                                    Tên màu:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <input type="text" class="form-control" id="colorNameUpdating" 
                                                placeholder="Nhập tên màu biến thể sản phẩm" name="colorNameUpdate"
                                                maxlength="50"
                                                required
                                                oninvalid="this.setCustomValidity('Vui lòng nhập tên màu biến thể sản phẩm')"
                                                oninput="setCustomValidity('')"
                                            >
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="colorCodeUpdating" class="form-label">
                                                <b>
                                                    Mã màu:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <input type="color" class="form-control" id="colorCodeUpdating" 
                                                name="colorCodeUpdate"
                                                required
                                            >
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="sizeUpdating" class="form-label">
                                                <b>
                                                    Kích thước:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <input type="number" class="form-control" id="sizeUpdating" 
                                                name="sizeUpdate"
                                                required
                                            >
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="quantityUpdating" class="form-label">
                                                <b>
                                                    Số lượng sản phẩm:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <input type="number" class="form-control" id="quantityUpdating" 
                                                name="quantityUpdate"
                                                required
                                                min="1"
                                            >
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="priceUpdating" class="form-label">
                                                <b>
                                                    Giá:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <input type="text" class="form-control" id="priceUpdating" 
                                                name="priceUpdate"
                                                required
                                            >
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="discountUpdating" class="form-label">
                                                <b>
                                                    Giảm giá %:
                                                    <sup class="text-danger">(*)</sup>
                                                </b>
                                            </label>
                                            <input type="number" class="form-control" id="discountUpdating" 
                                                name="discountUpdate"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3 text-center">
                                    <input type="hidden" name="proIdUpdate">
                                    <input type="submit" class="btn btn-success w-100" name="SubmitUpdateProductVariant" value="Cập nhật">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalChangeStatusProByOption" 
        tabindex="-1" aria-labelledby="modalChangeStatusProByOptionLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <h4 class="mb-4">Trạng thái hiển thị của <span id="proNameChangingStatus"></span></h4>
                    <div class="row" id="listOptionChangingStatus">
                        <div class="col">
                            <form action="<?= route('AdminChangeStatusProductVariantRoute'); ?>" method="post"> 
                                <input type="hidden" name="proId">
                                <button type="submit" name="SubmitTurnOffStatusAllProductVariant" class="btn border-3 border-secondary" value="SubmitChange">
                                    <b>Ẩn trạng thái</b> tất cả biến thể của sản phẩm.
                                </button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="<?= route('AdminChangeStatusProductVariantRoute'); ?>" method="post">
                                <input type="hidden" name="proId">
                                <button type="submit" name="SubmitTurnOnStatusAllProductVariant" class="btn border-3 border-success" value="SubmitChange">
                                    <b>Hiện trạng thái</b> tất cả biến thể của sản phẩm.
                                </button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="<?= route('AdminChangeStatusProductVariantRoute'); ?>" method="post">
                                <input type="hidden" name="proId">
                                <input type="hidden" name="varId">
                                <input type="hidden" name="varStatus">
                                <button type="submit" name="SubmitChangeStatusVariantProduct" class="btn border-3 border-warning" value="SubmitChange"><b id="currentStatusOfProVar"></b> biến thể 
                                <div id="varColorChangingStatus"></div> size <b id="varSizeChangingStatus"></b> của sản phẩm.
                            </button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTempDeleteProVar" 
        tabindex="-1" aria-labelledby="modalDeleteProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                <h4 class="mb-4">Xóa tạm sản phẩm <span id="proNameDelete"></span></h4>
                    <div class="row" id="listOptionDeleteProduct">
                        <div class="col">
                            <form action="<?= route('AdminTempDeleteProductRoute'); ?>" method="post"> 
                                <input type="hidden" name="proId">
                                <button type="submit" name="SubmitTempDeleteProduct" class="btn border-3 border-secondary" value="SubmitDelete">
                                    <b>Xóa tạm</b> toàn bộ biến thể của sản phẩm.
                                </button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="<?= route('AdminTempDeleteProductRoute'); ?>" method="post">
                                <input type="hidden" name="proId">
                                <input type="hidden" name="varId">
                                <button type="submit" name="SubmitTempDeleteProductVariant" class="btn border-3 border-warning" value="SubmitChange"><b>Xóa tạm</b> biến thể 
                                <div id="varColorDelete"></div> size <b id="varSizeDelete"></b> của sản phẩm
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>