<?php 
    $title = "Thùng Rác Sản Phẩm | SSNT SHOES";
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
        'https://code.jquery.com/jquery-3.7.1.js',
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js',
        public_dir('js/AdminJs/Product/proVarInTrash.js'),
    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>
<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> /
            <a href="<?= route('AdminProductRoute'); ?>">Quản lý sản phẩm</a> /
            <a href="<?= route('AdminProVarInTrashRoute'); ?>">Thùng Rác Sản Phẩm</a>
        </p>
    </div>

    <div class="table-responsive">
        <table id="trashProductTable">
            <thead>
                <tr>
                    <th>SST</th>
                    <th>Ảnh & Màu sắc</th>
                    <th>Tên sản phẩm & Size</th>
                    <th>Số lượng & Giá</th>
                    <th>Ngày tạo</th>
                    <th>Lần cập nhật cuối</th>
                    <th>Thương hiệu</th>
                    <th>Mô tả biến thể</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($proVarInTrashList)) :
                    $stt = 1;
                    foreach ($proVarInTrashList as $product) : ?>
                        <tr data-variant-id="<?= $product['varId']; ?>" data-product-id="<?= $product['proId']; ?>"
                            data-size="<?= $product['size']; ?>" data-color-code="<?= $product['colorCode'] ?>"
                            data-product-name="<?= $product['proName']; ?>"
                        >
                            <td><?= $stt++ ?></td>
                            <td>
                                <p>
                                <span class="table__data-variant--color" style="background: <?= $product['colorCode'] ?>;"></span>
                                <span class="color-name"><?= $product['colorName']; ?></span>
                                </p>
                                <img src="/<?= $product['image'] ?>" alt="Ảnh sản phẩm" 
                                    class="product-img" style="width: 80px; height: 80px;">
                            </td>
                            <td>
                                <p><?= $product['proName'] ?></p> 
                                (Size: <?= $product['size'] ?>)
                            </td>
                            <td>
                                <?= $product['quantity'] ?> chiếc<br>
                                <strong><?= number_format($product['price'], 0, ',', '.') ?>₫</strong>
                            </td>
                            <td><?= date("d/m/Y", strtotime($product['createAt'])) ?></td>
                            <td><?= date("d/m/Y", strtotime($product['lastUpdated'])) ?></td>
                            <td><?= $product['brandName'] ?></td>
                            <td><?= $product['description'] ?></td>
                            <td>
                                <button type="button" class="btn-action btn-action--delete" 
                                    data-id="<?= $product['varId'] ?>">
                                    <i class="bg-danger fas fa-trash action-icons__icon action-icons__icon--delete"></i>
                                </button>
                                <button type="button" class="btn-action btn-action--restore" 
                                    data-id="<?= $product['varId'] ?>">
                                    <i class="bg-success fas fa-undo action-icons__icon"></i>
                                </button>
                            </td>
                        </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modalDelProVarPermanently" 
        tabindex="-1" aria-labelledby="modalDelProVarPermanentlyLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <form action="<?= route('AdminDeleteProVarPermanently'); ?>" method="post">
                        <input type="hidden" name="proId">
                        <input type="hidden" name="varId">
                        <button type="submit" name="SubmitDeleteProductVariantPermanently" class="btn border-3 border-danger" value="SubmitChange"><b>Xóa vĩnh viễn</b> biến thể 
                            <div id="varColorDelete"></div> 
                            size <b id="varSizeDelete"></b> 
                            của sản phẩm 
                            <b id="proVarNameDelete"></b>
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRestoreProVarInTrash" 
        tabindex="-1" aria-labelledby="modalRestoreProVarInTrashLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <form action="<?= route('AdminRestoreProVarInTrashRoute'); ?>" method="post">
                        <input type="hidden" name="proId">
                        <input type="hidden" name="varId">
                        <button type="submit" name="SubmitRestoreProVarInTrash" class="btn border-3 border-danger" value="SubmitChange"><b>Khôi phục</b> biến thể 
                            <div id="varColorRestore"></div> 
                            size <b id="varSizeRestore"></b> 
                            của sản phẩm 
                            <b id="proVarNameRestore"></b>
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>
