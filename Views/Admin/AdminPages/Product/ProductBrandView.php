<?php 
    $title = "Quản Lý Thương Hiệu Sản Phẩm | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminProductRoute'),
        'subNavItem' => route('AdminProductBrandRoute'),
    ];
    $extraCSS = [
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css',
        'https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css'
    ];
    $extraJS = [
        public_dir('js/AdminJs/Product/productBrand.js'),
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
            <a href="<?= route('AdminProductBrandRoute') ?>">Quản lý thương hiệu sản phẩm</a>
        </p>
    </div>    
    <table id="table-product-brand-management">
        <div class="d-flex justify-content-between align-items-center gap-2">
            <button class="btn btn-primary text-light ms-auto d-block"
                data-bs-toggle="modal" data-bs-target="#modalCreateProductBrand"
            >
                <i class="fa-solid fa-plus"></i>
                Tạo mới
            </button>
        </div>
        <thead>
            <tr>
                <th class="table__header-stt">SST</th>
                <th class="table__header-brandName">Tên thương hiệu</th>
                <th class="table__header-brandImage">Ảnh</th>
                <th class="table__header-description">Mô tả</th>
                <th class="table__header-createAt">Ngày tạo</th>
                <th class="table__header-actions">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($brandList)): 
                $countSTT = 1;
                foreach ($brandList as $brandItem):
            ?>
                <tr>
                    <td class="table__data-stt">
                        <?= $countSTT; ?>
                        <input type="hidden" name="brandId" value="<?= $brandItem['brandId']; ?>">
                    </td>
                    <td class="table__data-brandName">
                        <?= htmlspecialchars($brandItem['brandName'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__data-brandImage">
                        <img width="100px" height="60px" src="/<?= htmlspecialchars($brandItem['image']); ?>" 
                            alt="<?= htmlspecialchars($brandItem['brandName'], ENT_QUOTES, 'UTF-8'); ?>">
                    </td>
                    <td class="table__data-description">
                        <?= htmlspecialchars($brandItem['description'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                    <td class="table__data-createAt date-column">
                        <?= formatDate($brandItem['createAt']); ?>
                    </td>
                    <td class="table__data-actions">
                        <button class="btn-action btn-action--edit" 
                            data-bs-toggle="tooltip" title="Chỉnh sửa thương hiệu"
                        >
                            <i class="bg-warning fas fa-pen action-icons__icon action-icons__icon--edit"></i>
                        </button>
                        <form action="<?= route('AdminDeleteProBrandRoute'); ?>" method="post"
                            data-bs-toggle="tooltip" title="Xóa thương hiệu"
                        >
                            <input type="hidden" name="proBrandIdDelete" value="<?= $brandItem['brandId'];?>">
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

    <div class="modal fade" id="modalCreateProductBrand"
        tabindex="-1" aria-labelledby="modalCreateProductBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tạo thương hiệu sản phẩm mới</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?= route('AdminCreateProductBrandRoute') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 mt-3">
                                    <label for="brand" class="form-label">
                                        <b>
                                            Tên thương hiệu sản phẩm: 
                                            <sup class="text-danger">(*)</sup>
                                        </b>
                                    </label>
                                    <input type="text" class="form-control" id="brand" 
                                        placeholder="Nhập tên thương hiệu sản phẩm" name="brandName"
                                        maxlength="50"
                                        required
                                        oninvalid="this.setCustomValidity('Vui lòng nhập tên thương hiệu sản phẩm')"
                                        oninput="setCustomValidity('')"
                                    >
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="brandImage" class="form-label">
                                        <b>
                                            Ảnh thương hiệu sản phẩm: 
                                            <sup class="text-danger">(*)</sup>
                                        </b>
                                    </label>
                                    <input type="file" class="form-control" name="brandImage" id="brandImage" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="description" class="form-label"><b>Mô tả:</b></label>
                                    <textarea 
                                        placeholder="Nhập mô tả cho thương hiệu sản phẩm" 
                                        class="form-control" 
                                        id="description" 
                                        name="description"
                                        maxlength="200"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 mt-3">
                                    <label class="form-label"><b>Xem trước:</b></label>
                                    <img src="" width="100%" height="100%" alt="anh-thuong-hieu-san-pham" id="brand-image--preview">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="submit" class="btn btn-success w-100" name="SubmitCreateProductBrand" value="Tạo mới">
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalUpdateProductBrand" 
        tabindex="-1" aria-labelledby="modalUpdateProductBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Sửa thương hiệu sản phẩm</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?= route('AdminUpdateProductBrandRoute'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 mt-3">
                                    <label for="brandIdUpdating" class="form-label">
                                        <b>
                                            Mã thương hiệu sản phẩm:
                                            <sup class="text-danger">(*)</sup>
                                        </b>
                                    </label>
                                    <input type="number" class="form-control readonly" id="brandIdUpdating" 
                                        name="brandIdUpdate"
                                        required
                                        readonly
                                    >
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="brandNameUpdating" class="form-label">
                                        <b>
                                            Tên thương hiệu sản phẩm:
                                            <sup class="text-danger">(*)</sup>
                                        </b>
                                    </label>
                                    <input type="text" class="form-control" id="brandNameUpdating" 
                                        placeholder="Nhập tên thương hiệu sản phẩm" name="brandNameUpdate"
                                        maxlength="50"
                                        required
                                        oninvalid="this.setCustomValidity('Vui lòng nhập tên thương hiệu sản phẩm')"
                                        oninput="setCustomValidity('')"
                                    >
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="description" class="form-label"><b>Mô tả:</b></label>
                                    <textarea 
                                        placeholder="Nhập mô tả cho thương hiệu sản phẩm" 
                                        class="form-control" 
                                        id="descriptionUpdating" 
                                        name="descriptionUpdate"
                                        maxlength="200"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="file" name="brandImageUpdate">
                                <img src="" alt="" width="100%" height="auto" id="brandImageUpdating">
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="submit" class="btn btn-success w-100" name="SubmitUpdateProductBrand" value="Cập nhật">
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteProBrand" 
        tabindex="-1" aria-labelledby="modalDeleteProBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <p class="message-confirm">Xác nhận xóa thương hiệu
                        <b id="brandNameDelete"></b>
                    </p>

                    <button type="button" class="btn btn-success" name="ConfirmSubmitDeleteProBrand">Xác nhận</button>
                    <button type="cancel" class="btn btn-danger" name="CancelSubmitDeleteProBrand">Hủy</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>