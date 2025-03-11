<?php
    $Title = "Đổi Mật Khẩu | Samsonitu Shoes";
    $extraCSS = [public_dir('css/UserCss/changePassword.css')];
    $extraJS = [public_dir('js/UserJs/changePassword.js')];
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
                        <a class="text-dark text-decoration-none hover-maincl" href="" style="font-size: 14px;">
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
                <h4 class="form-title text-center">ĐỔI MẬT KHẨU</h4>
                    
                    <form action="<?= route('HandleChangePasswordRoute'); ?>" method="post" 
                    class="needs-validation" id="changePasswordForm" novalidate>
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Email field -->
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control bg-light" id="email" 
                                           value="<?=$_SESSION['userInfo'][0]['email']?>" disabled>
                                </div>
                                
                                <!-- Old password field -->
                                <div class="mb-4 password-input-container">
                                    <label for="oldPassword" class="form-label">Mật khẩu hiện tại</label>
                                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                                    <span class="password-toggle" onclick="togglePassword('oldPassword')">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập mật khẩu hiện tại
                                    </div>
                                </div>
                                
                                <!-- New password field -->
                                <div class="mb-4 password-input-container">
                                    <label for="newPassword" class="form-label">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" 
                                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,50}$" required>
                                    <span class="password-toggle" onclick="togglePassword('newPassword')">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                    <div class="invalid-feedback" id="newPasswordFeedback">
                                        Mật khẩu phải có ít nhất 8 ký tự, bao gồm ít nhất 1 chữ thường, 1 chữ hoa và 1 số
                                    </div>
                                    
                                    <div class="password-requirements">
                                        <p class="mb-1">Mật khẩu phải đáp ứng các yêu cầu sau:</p>
                                        <ul>
                                            <li id="length-check">Độ dài từ 8 đến 50 ký tự</li>
                                            <li id="lowercase-check">Ít nhất 1 ký tự chữ thường</li>
                                            <li id="uppercase-check">Ít nhất 1 ký tự chữ hoa</li>
                                            <li id="number-check">Ít nhất 1 ký tự số</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <!-- Confirm password field -->
                                <div class="mb-4 password-input-container">
                                    <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                    <span class="password-toggle" onclick="togglePassword('confirmPassword')">
                                        <i class="bi bi-eye"></i>
                                    </span>
                                    <div class="invalid-feedback">
                                        Mật khẩu xác nhận phải trùng khớp với mật khẩu mới
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center gap-3 mt-4">
                                    <button type="submit" class="btn btn-primary btn-update" 
                                        name="SubmitChangePassword" value="SubmitChange">
                                        Xác Nhận Thay Đổi
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-cancel">Huỷ</button>
                                </div>
                            </div>
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