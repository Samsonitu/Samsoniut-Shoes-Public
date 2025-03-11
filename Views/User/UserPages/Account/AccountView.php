<?php
    $Title = "Tài Khoản Của Tôi | Samsonitu Shoes";
    $extraCSS = [public_dir('css/UserCss/account.css')];
    $extraJS = [public_dir('js/UserJs/account.js')];
    require_once __DIR__ . "/../../UserLayouts/HeaderView.php";
?>
<main style="min-height: 300px;">
    <section class="section-account-info">
        <div class="row">
            <div class="col-lg-2 py-3" style="background-color: #F5F5F5; border-radius: 5px;">
                <h5 style="border-bottom: 1px solid #ccc; color: var(--maincolor)" class="py-2">TRANG TÀI KHOẢN</h5>
                <ul style="list-style-type: none;" class="m-0 p-0">
                    <li class="py-2"><b>Xin chào! <?= $_SESSION['userInfo'][0]['fullName']; ?></b></li>
                    <li class="py-2">
                        <a href="<?= route('AccountRoute'); ?>" class="text-decoration-none hover-maincl" 
                        style="font-size: 14px; color: var(--maincolor);">
                            Thông tin tài khoản
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="<?= route('OrderedRoute'); ?>" class="text-dark text-decoration-none hover-maincl"  
                        style="font-size: 14px;">
                            Đơn hàng của bạn
                        </a>
                    </li>
                    <li class="py-2">
                        <a class="text-dark text-decoration-none hover-maincl" 
                            href="<?= route('ChangePasswordRoute'); ?>" style="font-size: 14px;">
                            Đổi mật khẩu
                        </a>
                    </li>
                    <li class="py-2">
                        <a class="text-dark text-decoration-none hover-maincl" href="<?= route('LogoutRoute'); ?>" style="font-size: 14px;">
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-10 col-md-12">
                <div class="form-container">
                    <h4 class="form-title text-center">THÔNG TIN TÀI KHOẢN</h4>
                    
                    <form action="<?= route('UpdateUserInfoRoute'); ?>" method="post" class="needs-validation" novalidate>
                        <div class="row">
                            <!-- Cột trái -->
                            <div class="col-md-6 col-form-left">
                                <div class="mb-4">
                                    <label for="fullName" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName" 
                                        value="<?=$_SESSION['userInfo'][0]['fullName']?>"
                                        minlength="8" maxlength="20" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập họ tên từ 8-20 ký tự
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Giới tính</label>
                                    <div class="gender-options">
                                        <div class="gender-option">
                                            <input class="form-check-input" type="radio" name="gender" id="male" 
                                                value="male" <?= $_SESSION['userInfo'][0]['gender'] == 'male' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="male">Nam</label>
                                        </div>
                                        <div class="gender-option">
                                            <input class="form-check-input" type="radio" name="gender" id="female" 
                                                value="female" <?= $_SESSION['userInfo'][0]['gender'] == 'female' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="female">Nữ</label>
                                        </div>
                                        <div class="gender-option">
                                            <input class="form-check-input" type="radio" name="gender" id="unisex" 
                                                value="unisex" <?= $_SESSION['userInfo'][0]['gender'] == 'unisex' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="unisex">Unisex</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="birthDate" class="form-label">Ngày sinh</label>
                                    <input type="date" class="form-control" id="birthDate" name="birthDate" 
                                        value="<?= $_SESSION['userInfo'][0]['birthDate']; ?>" required>
                                </div>
                            </div>
                            
                            <!-- Cột phải -->
                            <div class="col-md-6 col-form-right">
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control bg-light" id="email" 
                                        value="<?=$_SESSION['userInfo'][0]['email']?>" disabled>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="phoneNumber" class="form-label">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" 
                                        pattern="^0[1-9][0-9]{8}$" 
                                        value="<?= $_SESSION['userInfo'][0]['phoneNumber']; ?>" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập số điện thoại hợp lệ (10 số, bắt đầu bằng số 0)
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <textarea class="form-control" id="address" name="address" rows="4"><?= $_SESSION['userInfo'][0]['address']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button type="submit" class="btn btn-primary btn-update" 
                                name="SubmitUpdateUserInfo" value="SubmitUpdate">
                                Cập nhật
                            </button>
                            <button type="reset" class="btn btn-danger btn-cancel">Huỷ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
    require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>