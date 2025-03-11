<?php 
    $title = "Tài Khoản | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminAccountRoute'),
        'subNavItem' => '',
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
        public_dir('js/AdminJs/Account/account.js')
    ];

    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>
<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> /
            <a href="<?= route('AdminCustomerRoute'); ?>">Quản lý tài khoản</a>
        </p>
    </div>

    <table>
        <div class="d-flex justify-content-end align-items-center gap-2 mb-3">
            <button class="btn btn-primary text-light ms-auto d-block"
                data-bs-toggle="modal" data-bs-target="#modalCreateAccount"
            >
                <i class="fa-solid fa-plus"></i>
                Tạo mới
            </button>
        </div>
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($accountList)) :
                $stt = 1;
                foreach ($accountList as $account) : ?>
                    <tr data-user-id="<?= $account['userId']; ?>"
                        data-address="<?= htmlspecialchars($account['address']); ?>"
                        data-email="<?= htmlspecialchars($account['email']); ?>"
                        data-provider-id="<?= $account['providerId']; ?>"
                        data-provider="<?= $account['provider']; ?>"
                        data-description="<?= $account['description']; ?>"
                    >
                        <td><?= $stt++; ?></td>
                        <td><?= htmlspecialchars($account['fullName']); ?></td>
                        <td>
                            <?php 
                                if ($account['gender'] === 'male') echo "Nam";
                                elseif ($account['gender'] === 'female') echo "Nữ";
                                else echo "Giới tính khác";
                            ?>
                        </td>
                        <td><?= date("d/m/Y", strtotime($account['birthDate'])); ?></td>
                        <td><?= htmlspecialchars($account['email']); ?></td>
                        <td><?= htmlspecialchars($account['phoneNumber']); ?></td>
                        <td>
                            <?php 
                                if($account['role'] === 'admin') echo "Quản trị viên";
                                elseif ($account['role'] === 'customer') echo 'Khách hàng';
                            ?>
                        </td>
                        <td><?= date("d/m/Y", strtotime($account['createAt'])); ?></td>
                        <td class="table__data-actions">
                            <button class="btn-action btn-action--view" data-bs-toggle="tooltip" title="Xem chi tiết" >
                                <i class="bg-info fas fa-eye action-icons__icon action-icons__icon--view"></i>
                            </button>
                            
                            <button class="btn-action btn-action--edit" data-bs-toggle="tooltip" title="Chỉnh sửa tài khoản">
                                <i class="bg-warning fas fa-user-edit action-icons__icon"></i>
                            </button>

                            <button type="button" class="btn-action btn-action--active toggle-button"
                                data-bs-toggle="tooltip" title="Kích hoạt/Khóa tài khoản"
                                data-active="<?= $account['active']; ?>"    
                            >
                                <?php if ($account['active'] == 1): ?>
                                    <i class="fas fa-user-check action-icons__icon bg-success toggle-icon"></i>
                                <?php else: ?>
                                    <i class="fas fa-user-slash action-icons__icon bg-secondary toggle-icon"></i>
                                <?php endif; ?>
                            </button>

                            <button class="btn-action btn-action--delete" data-bs-toggle="tooltip" title="Xóa tài khoản">
                                <i class="bg-danger fas fa-trash action-icons__icon action-icons__icon--delete"></i>
                            </button>
                        </td>
                    </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>

    <div class="modal fade" id="modalCreateAccount" 
        tabindex="-1" aria-labelledby="modalCreateAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tạo tài khoản mới</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="<?= route('AdminCreateAccountRoute'); ?>" method="post" onsubmit="return validateFormCreate()">
                        <div class="row g-3">
                            <div class="col-6">
                                <label for="fullNameCreate" class="form-label">
                                    <b>Họ và tên: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="text" class="form-control" id="fullNameCreate" name="fullNameCreate" required>
                            </div>
                            <div class="col-6">
                                <label for="genderCreate" class="form-label">
                                    <b>Giới tính: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <select class="form-control" id="genderCreate" name="genderCreate" required>
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                    <option value="unisex">Giới tính khác</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="dobCreate" class="form-label">
                                    <b>Ngày sinh: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="date" class="form-control" id="dobCreate" name="dobCreate" required>
                            </div>
                            <div class="col-6">
                                <label for="emailCreate" class="form-label">
                                    <b>Email: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="email" class="form-control" id="emailCreate" name="emailCreate" required>
                            </div>
                            <div class="col-6">
                                <label for="passwordCreate" class="form-label">
                                    <b>Mật khẩu: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="password" class="form-control" id="passwordCreate" name="passwordCreate" required>
                            </div>
                            <div class="col-6">
                                <label for="confirmPasswordCreate" class="form-label">
                                    <b>Xác nhận mật khẩu: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="password" class="form-control" id="confirmPasswordCreate" name="confirmPasswordCreate" required>
                            </div>
                            <div class="col-6">
                                <label for="phoneNumberCreate" class="form-label">
                                    <b>Số điện thoại: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="tel" class="form-control" id="phoneNumberCreate" name="phoneNumberCreate" required>
                            </div>
                            <div class="col-6">
                                <label for="roleCreate" class="form-label">
                                    <b>Vai trò: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <select class="form-control" id="roleCreate" name="roleCreate" required>
                                    <option value="customer">Khách hàng</option>
                                    <option value="admin">Quản trị viên</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="addressCreate" class="form-label">
                                    <b>Địa chỉ: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <textarea class="form-control" id="addressCreate" name="addressCreate" required rows="5"></textarea>
                            </div>
                            <div class="col-6">
                                <label for="descriptionCreate" class="form-label">
                                    <b>Mô tả: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <textarea class="form-control" id="descriptionCreate" name="descriptionCreate" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" name="SubmitCreateAccount" value="Submit" class="btn btn-success">Tạo tài khoản</button>
                            <button type="reset" class="btn btn-danger">Hoàn tác</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateAccount" 
        tabindex="-1" aria-labelledby="modalUpdateAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Tạo tài khoản mới</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="accountForm" action="<?= route('AdminUpdateAccountRoute'); ?>" method="post" 
                    onsubmit="return validateFormUpdate()">
                        <input type="hidden" id="userIdUpdate" name="userIdUpdate">
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <label for="fullNameUpdate" class="form-label">
                                    <b>Họ và tên: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="text" class="form-control" id="fullNameUpdate" name="fullNameUpdate" required>
                            </div>
                            <div class="col-6">
                                <label for="genderUpdate" class="form-label">
                                    <b>Giới tính: <sup class="text-danger"></sup></b></label>
                                <select class="form-control" id="genderUpdate" name="genderUpdate" required>
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                    <option value="unisex">Giới tính khác</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="dobUpdate" class="form-label">
                                    <b>Ngày sinh: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="date" class="form-control" id="dobUpdate" name="dobUpdate" required>
                            </div>
                            <div class="col-6">
                                <label for="emailUpdate" class="form-label">
                                    <b>Email: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="email" class="form-control" id="emailUpdate" name="emailUpdate" required readonly>
                            </div>
                            <div class="col-6 password-fields">
                                <label for="passwordUpdate" class="form-label">
                                    <b>Mật khẩu mới: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="password" class="form-control" id="passwordUpdate" name="passwordUpdate">
                            </div>
                            <div class="col-6 password-fields">
                                <label for="confirmPasswordUpdate" class="form-label">
                                    <b>Xác nhận mật khẩu mới: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="password" class="form-control" id="confirmPasswordUpdate" name="confirmPasswordUpdate">
                            </div>
                            <div class="col-6">
                                <label for="phoneNumberUpdate" class="form-label">
                                    <b>Số điện thoại: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <input type="tel" class="form-control" id="phoneNumberUpdate" name="phoneNumberUpdate" required>
                            </div>
                            <div class="col-6">
                                <label for="roleUpdate" class="form-label">
                                    <b>Vai trò: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <select class="form-control" id="role" name="roleUpdate" required>
                                    <option value="customer">Khách hàng</option>
                                    <option value="admin">Quản trị viên</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="addressUpdate" class="form-label">
                                    <b>Địa chỉ: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <textarea class="form-control" id="addressUpdate" name="addressUpdate" required rows="5"></textarea>
                            </div>
                            <div class="col-6">
                                <label for="descriptionUpdate" class="form-label">
                                    <b>Mô tả: <sup class="text-danger">(*)</sup></b>
                                </label>
                                <textarea class="form-control" id="descriptionUpdate" name="descriptionUpdate" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" id="submitButton" name="SubmitUpdateAccount" value="Submit" class="btn btn-success">
                                Cập nhật tài khoản
                            </button>
                            <button type="reset" class="btn btn-danger">Hoàn tác</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalChangeActiveAccount" 
        tabindex="-1" aria-labelledby="modalChangeActiveAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <h4 class="mb-4">Trạng Thái Tài Khoản</h4>
                    <form action="<?= route('AdminChangeActiveAccountRoute') ?>" method="post">
                        <input type="hidden" name="emailChangeActive">
                        <input type="hidden" name="userIdChangeActive">
                        <input type="hidden" name="changeActive">
                        <button type="submit" name="SubmitChangeActiveAccount" value="SubmitChange" class="message-confirm btn border border-3">
                            Xác nhận 
                            <b id="accountChangingActive"></b> tài khoản:
                            <b id="accountNameChangingActive"></b> email:
                            <b id="emailChangingActive"></b>  
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAccountDetails" tabindex="-1" aria-labelledby="modalAccountDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-3 border-0 shadow">
                <!-- Header -->
                <div class="modal-header py-2 border-bottom">
                    <h5 class="modal-title fw-bold text-center w-100">
                        <i class="fas fa-user-circle me-2 text-primary"></i>Chi tiết tài khoản
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-3">
                    <div class="row g-3">
                        <!-- Cột trái - Thông tin cá nhân -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="border-bottom pb-2 mb-3 d-flex align-items-center">
                                        <i class="fas fa-user text-primary me-2"></i>Thông tin cá nhân
                                    </h6>
                                    
                                    <!-- Họ tên -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user text-primary me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Họ và tên</small>
                                                <span id="detailFullName">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Giới tính -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-venus-mars text-purple me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Giới tính</small>
                                                <span id="detailGender">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Ngày sinh -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-birthday-cake text-warning me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Ngày sinh</small>
                                                <span id="detailBirthDate">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Email -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-envelope text-danger me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Email</small>
                                                <span id="detailEmail">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Số điện thoại -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-phone text-success me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Số điện thoại</small>
                                                <span id="detailPhoneNumber">-</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cột phải - Thông tin tài khoản -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="border-bottom pb-2 mb-3 d-flex align-items-center">
                                        <i class="fas fa-shield-alt text-info me-2"></i>Thông tin tài khoản
                                    </h6>
                                    
                                    <!-- Vai trò -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-tag text-info me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Vai trò</small>
                                                <span id="detailRole">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Nhà cung cấp -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-globe text-warning me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Nhà cung cấp</small>
                                                <span id="detailProvider">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Provider ID -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-id-badge text-dark me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Provider ID</small>
                                                <span id="detailProviderId">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Ngày tạo -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-secondary me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Ngày tạo</small>
                                                <span id="detailCreateAt">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Địa chỉ -->
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Địa chỉ</small>
                                                <span id="detailAddress">-</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mô tả - Toàn bộ chiều rộng -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-sticky-note text-primary me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">Mô tả</small>
                                            <span id="detailDescription">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRemoveAccount" 
        tabindex="-1" aria-labelledby="modalRemoveAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-end p-2"><button type="button" class="btn btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center">
                    <h4 class="mb-4">Xóa Tài Khoản</h4>
                    <form action="<?= route('AdminRemoveAccountRoute') ?>" method="post">
                        <input type="hidden" name="emailRemove">
                        <input type="hidden" name="userIdRemove">
                        <button type="submit" name="SubmitRemoveAccount" value="SubmitRemove" class="message-confirm btn border border-3 border-danger">
                            Xác nhận xóa tài khoản:
                            <b id="accountNameDelete"></b> email:
                            <b id="emailRemove"></b>  
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>
