<?php 
    $title = "Quản Lý Danh Mục Sản Phẩm | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminProductRoute'),
        'subNavItem' => route('AdminProductCategoryRoute'),
    ];
    $extraCSS = [
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css',
        'https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css'
    ];
    $extraJS = [
        public_dir('js/AdminJs/Product/productCategory.js'),
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
            <a href="<?= route('AdminProductCategoryRoute') ?>">Quản lý danh mục sản phẩm</a>
        </p>
    </div>    
    <table id="table-product-category-management">
        <div class="d-flex justify-content-between align-items-center gap-2">
            
            <a href="<?= route('AdminProCatInTrashRoute'); ?>">
                Thùng rác (<?php if(!empty($countProCatInTrash)) echo $countProCatInTrash[0]['total']; ?>)
            </a>
            <button class="btn btn-primary text-light ms-auto d-block"
                data-bs-toggle="modal" data-bs-target="#modalCreateProductCategory"
            >
                <i class="fa-solid fa-plus"></i>
                Tạo mới
            </button>
        </div>
        <thead>
            <tr>
                <th class="table__header-stt">SST</th>
                <th class="table__header-categoryName">Tên Danh mục</th>
                <th class="table__header-description desc-column">Mô tả</th>
                <th class="table__header-createAt desc-column">Ngày tạo</th>
                <th class="table__header-actions">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($categoryList)): 
                $countSTT = 1;
                foreach ($categoryList as $categoryItem):
                    if($categoryItem['active'] == 0) continue;
            ?>
                <tr>
                    <td class="table__data-stt">
                        <?= $countSTT; ?>
                        <input type="hidden" name="categoryId" value="<?= $categoryItem['catId']; ?>">
                    </td>
                    <td class="table__data-categoryName" style="text-transform: capitalize">
                        <?= htmlspecialchars($categoryItem['catName'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__data-description desc-column">
                        <?= htmlspecialchars($categoryItem['description'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__data-createAt date-column">
                        <?= formatDate($categoryItem['createAt']); ?>
                    </td>
                    <td class="table__data-actions">
                        <form action="<?= route('AdminChangeStatusProductCategoryRoute'); ?>" method="post" 
                            data-bs-toggle="tooltip" title="Bật/Tắt hiển thị danh mục"
                        >
                            <input type="hidden" name="categoryIdChangingStatus" value="<?= $categoryItem['catId']; ?>">
                            <input type="hidden" name="categoryStatus" value="<?= $categoryItem['status']; ?>">
                            <button type="button" class="btn-action btn-action--status">
                                <?= $categoryItem['status'] === 1 
                                ? '<i class="bg-success fas fa-toggle-on 
                                    action-icons__icon 
                                    action-icons__icon--toggle-on"></i>'
                                : '<i class="bg-secondary fas fa-toggle-off 
                                    action-icons__icon 
                                    action-icons__icon--toggle-off"></i>'; ?> 
                            </button>
                        </form>
                        <button class="btn-action btn-action--edit" 
                            data-bs-toggle="tooltip" title="Chỉnh sửa danh mục"
                        >
                            <i class="bg-warning fas fa-pen action-icons__icon action-icons__icon--edit"></i>
                        </button>
                        <form action="<?= route('AdminTempDeleteProCatRoute'); ?>" method="post"
                            data-bs-toggle="tooltip" title="Xóa danh mục"
                        >
                            <input type="hidden" name="proCatIdTempDelete" value="<?= $categoryItem['catId'];?>">
                            <button type="button" class="btn-action btn-action--delete">
                                <i class="bg-danger fas fa-trash action-icons__icon action-icons__icon--delete"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php 
                $countSTT++;
                endforeach;
                endif;
            ?>
        </tbody>
    </table>

    <div class="modal fade" id="modalCreateProductCategory"
        tabindex="-1" aria-labelledby="modalCreateProductCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tạo danh mục sản phẩm mới</h4>
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

    <div class="modal fade" id="modalChangeStatusProductCategory" 
        tabindex="-1" aria-labelledby="modalChangeStatusProductCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <p class="message-confirm">Xác nhận 
                        <b id="categoryNameChangingStatus"></b> danh mục
                        <b id="categoryCurrentStatus"></b>  
                    </p>

                    <button type="button" class="btn btn-success" name="ConfirmSubmitChangingStatus">Xác nhận</button>
                    <button type="cancel" class="btn btn-danger" name="CancelSubmitChangingStatus">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateProductCategory" 
        tabindex="-1" aria-labelledby="modalUpdateProductCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Sửa danh mục sản phẩm</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?= route('AdminUpdateProductCategoryRoute'); ?>" method="post">
                        <div class="mb-3 mt-3">
                            <label for="category" class="form-label">
                                <b>
                                    Mã danh mục sản phẩm:
                                    <sup class="text-danger">(*)</sup>
                                </b>
                        </label>
                            <input type="number" class="form-control readonly" id="categoryIdUpdating" 
                                name="categoryIdUpdate"
                                required
                                readonly
                            >
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="category" class="form-label">
                                <b>
                                    Tên danh mục sản phẩm:
                                    <sup class="text-danger">(*)</sup>
                                </b>
                        </label>
                            <input type="text" class="form-control" id="categoryNameUpdating" 
                                placeholder="Nhập tên danh mục sản phẩm" name="categoryNameUpdate"
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
                                id="descriptionUpdating" 
                                name="descriptionUpdate"
                                maxlength="200"
                                rows="5"></textarea>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="submit" class="btn btn-success w-100" name="SubmitUpdateProductCategory" value="Cập nhật">
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTempDeleteProCat" 
        tabindex="-1" aria-labelledby="modalTempDeleteProCatLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <p class="message-confirm">Xác nhận xóa tạm danh mục
                        <b id="categoryNameDelete"></b>
                    </p>

                    <button type="button" class="btn btn-success" name="ConfirmSubmitTempDeleteProCat">Xác nhận</button>
                    <button type="cancel" class="btn btn-danger" name="ConfirmCancelSubmitTempDeleteProCat">Hủy</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>