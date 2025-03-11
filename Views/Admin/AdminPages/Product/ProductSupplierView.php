<?php 
    $title = "Nhà Cung Cấp Sản Phẩm | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminProductRoute'),
        'subNavItem' => route('AdminProductRoute'),
    ];
    $extraCSS = [
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css',
        'https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css'
    ];
    $extraJS = [
        'https://code.jquery.com/jquery-3.7.1.js',
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.js',
        'https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js',
        public_dir('js/AdminJs/Product/productSupplier.js'),
    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>
<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> /
            <a href="<?= route('AdminProductRoute'); ?>">Quản lý sản phẩm</a> /
            <a href="<?= route('AdminProductSupplierRoute'); ?>">Nhà cung cấp sản phẩm</a>
        </p>
    </div>
    <div class="d-flex justify-content-between align-items-center gap-2">
        <button class="btn btn-primary text-light ms-auto d-block"
            data-bs-toggle="modal" data-bs-target="#modalCreateProductSupplier"
        >
            <i class="fa-solid fa-plus"></i>
            Tạo mới
        </button>
    </div>
    <table class="mt-3">
        <thead>
            <th>STT</th>
            <th>Tên Nhà Cung Cấp</th>
            <th>Email</th>
            <th>Quốc Gia</th>
            <th>Số Điện Thoại</th>
            <th>Địa Chỉ</th>
            <th>Mô Tả</th>
            <th>Hành Động</th>
        </thead>        
        <tbody>
            <?php if(!empty($productSupplierList)) :
                $count = 1;
                foreach ($productSupplierList as $productSupplierItem) :
            ?>  
            <tr data-sup-id="<?= $productSupplierItem['supId']; ?>"
                data-sup-name="<?= $productSupplierItem['supName']; ?>"
                data-email="<?= $productSupplierItem['email']; ?>"
                data-country="<?= $productSupplierItem['country']; ?>"
                data-phone-number="<?= $productSupplierItem['phoneNumber']; ?>"
                data-address="<?= $productSupplierItem['address']; ?>"
                data-description="<?= $productSupplierItem['description']; ?>">
                
                <td><?= $count ?></td>
                <td><?= $productSupplierItem['supName']; ?></td>
                <td><?= $productSupplierItem['email']; ?></td>
                <td><?= $productSupplierItem['country']; ?></td>
                <td><?= $productSupplierItem['phoneNumber']; ?></td>
                <td><?= $productSupplierItem['address']; ?></td>
                <td><?= $productSupplierItem['description']; ?></td>
                <td class="table__data-actions">
                    <button class="btn-action btn-action--edit">
                        <i class="bg-warning fas fa-pen action-icons__icon action-icons__icon--edit"></i>
                    </button>
                    <button type="button" class="btn-action btn-action--delete">
                        <i class="bg-danger fas fa-trash action-icons__icon action-icons__icon--delete"></i>
                    </button>
                </td>
            </tr>
            <?php 
                $count++;
                endforeach;
            endif;
            ?>

        </tbody>
    </table>

    <div class="modal fade" id="modalCreateProductSupplier"
        tabindex="-1" aria-labelledby="modalCreateProductSupplierLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tạo thông tin nhà cung cấp sản phẩm mới</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?= route('AdminCreateProductSupplierRoute') ?>" method="post">
                        <div class="row">
                            <!-- Cột 1 -->
                            <div class="col-md-6">
                                <!-- Tên nhà cung cấp -->
                                <div class="mb-3 mt-3">
                                    <label for="supplierName" class="form-label">
                                        <b>Tên nhà cung cấp: <sup class="text-danger">(*)</sup></b>
                                    </label>
                                    <input type="text" class="form-control" id="supplierName" 
                                        placeholder="Nhập tên nhà cung cấp" name="supName"
                                        maxlength="50"
                                        required
                                        oninvalid="this.setCustomValidity('Vui lòng nhập tên nhà cung cấp')"
                                        oninput="setCustomValidity('')">
                                </div>

                                <!-- Email nhà cung cấp -->
                                <div class="mb-3 mt-3">
                                    <label for="supplierEmail" class="form-label">
                                        <b>Email nhà cung cấp: <sup class="text-danger">(*)</sup></b>
                                    </label>
                                    <input type="email" class="form-control" id="supplierEmail" 
                                        placeholder="Nhập email nhà cung cấp" name="email"
                                        maxlength="200"
                                        required
                                        oninvalid="this.setCustomValidity('Vui lòng nhập email nhà cung cấp')"
                                        oninput="setCustomValidity('')">
                                </div>

                                <!-- Số điện thoại nhà cung cấp -->
                                <div class="mb-3 mt-3">
                                    <label for="supplierPhone" class="form-label">
                                        <b>Số điện thoại nhà cung cấp: <sup class="text-danger">(*)</sup></b>
                                    </label>
                                    <input type="tel" class="form-control" id="supplierPhone" 
                                        placeholder="Nhập số điện thoại (VD: 0123 456 789)" 
                                        name="phoneNumber"
                                        pattern="[0-9\s]{8,20}" 
                                        maxlength="20"
                                        required
                                        oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại hợp lệ, ví dụ: 0123 456 789')"
                                        oninput="setCustomValidity('')">
                                </div>
                            </div>

                            <!-- Cột 2 -->
                            <div class="col-md-6">
                                <!-- Quốc gia -->
                                <div class="mb-3 mt-3">
                                    <label for="supplierCountry" class="form-label">
                                        <b>Quốc gia: <sup class="text-danger">(*)</sup></b>
                                    </label>
                                    <input type="text" class="form-control" id="supplierCountry" 
                                        placeholder="Nhập quốc gia của nhà cung cấp" name="country"
                                        maxlength="50"
                                        required
                                        oninvalid="this.setCustomValidity('Vui lòng nhập quốc gia')"
                                        oninput="setCustomValidity('')">
                                </div>

                                <!-- Địa chỉ nhà cung cấp -->
                                <div class="mb-3 mt-3">
                                    <label for="supplierAddress" class="form-label"><b>Địa chỉ:</b></label>
                                    <textarea class="form-control" id="supplierAddress" 
                                        placeholder="Nhập địa chỉ cụ thể" 
                                        name="address"
                                        maxlength="255"
                                        rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Mô tả nhà cung cấp (Nằm toàn bộ chiều rộng) -->
                        <div class="mb-3 mt-3">
                            <label for="supplierDescription" class="form-label"><b>Mô tả:</b></label>
                            <textarea class="form-control" id="supplierDescription" 
                                placeholder="Nhập mô tả chi tiết về nhà cung cấp" 
                                name="description"
                                maxlength="200"
                                rows="5"></textarea>
                        </div>

                        <!-- Nút gửi -->
                        <div class="mb-3 mt-3 text-center">
                            <input type="submit" class="btn btn-success w-50" name="SubmitCreateProductSupplier" value="Tạo mới">
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateProductSupplier"
        tabindex="-1" aria-labelledby="modalUpdateProductSupplierLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa thông tin nhà cung cấp</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?= route('AdminUpdateProductSupplierRoute') ?>" method="post">
                        <input type="hidden" id="supplierId" name="supId">
                        <input type="hidden" id="supplierNameOld" name="supNameOld">

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Tên nhà cung cấp -->
                                <div class="mb-3">
                                    <label for="supplierName" class="form-label">
                                        <b>Tên nhà cung cấp: <sup class="text-danger">(*)</sup></b>
                                    </label>
                                    <input type="text" class="form-control" id="supplierName" 
                                        name="supName" required maxlength="50">
                                </div>

                                <!-- Email nhà cung cấp -->
                                <div class="mb-3">
                                    <label for="supplierEmail" class="form-label">
                                        <b>Email nhà cung cấp: <sup class="text-danger">(*)</sup></b>
                                    </label>
                                    <input type="email" class="form-control" id="supplierEmail" 
                                        name="email" required maxlength="200">
                                </div>

                                <!-- Số điện thoại -->
                                <div class="mb-3">
                                    <label for="supplierPhone" class="form-label">
                                        <b>Số điện thoại: <sup class="text-danger">(*)</sup></b>
                                    </label>
                                    <input type="tel" class="form-control" id="supplierPhone" 
                                        name="phoneNumber" pattern="[0-9\s]{8,20}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Quốc gia -->
                                <div class="mb-3">
                                    <label for="supplierCountry" class="form-label">
                                        <b>Quốc gia: <sup class="text-danger">(*)</sup></b>
                                    </label>
                                    <input type="text" class="form-control" id="supplierCountry" 
                                        name="country" required maxlength="50">
                                </div>

                                <!-- Địa chỉ -->
                                <div class="mb-3">
                                    <label for="supplierAddress" class="form-label"><b>Địa chỉ:</b></label>
                                    <textarea class="form-control" id="supplierAddress" 
                                        name="address" maxlength="255" rows="3"></textarea>
                                </div>

                                <!-- Mô tả -->
                                <div class="mb-3">
                                    <label for="supplierDescription" class="form-label"><b>Mô tả:</b></label>
                                    <textarea class="form-control" id="supplierDescription" 
                                        name="description" maxlength="200" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Nút cập nhật -->
                        <div class="text-center">
                            <input type="submit" class="btn btn-success w-100" name="SubmitUpdateProductSupplier" value="Cập Nhật">
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalDeleteProductSupplier" 
        tabindex="-1" aria-labelledby="modalDeleteProductSupplierLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <form action="<?= route('AdminDeleteProductSupplierRoute'); ?>" method="post">
                        <input type="hidden" name="supId">
                        <button type="submit" name="SubmitDeleteProductSupplier" class="btn border-3 border-danger" value="SubmitDelete"><b>Xóa</b> thông tin nhà cung cấp 
                            <b id="supNameDelete"></b>
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>