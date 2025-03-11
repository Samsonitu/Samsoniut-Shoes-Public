<?php
$extraCSS = [public_dir('css/UserCss/register.css')];
$extraJS = [public_dir('js/UserJs/register.js')];
require_once __DIR__ . "/../../UserLayouts/HeaderView.php";
?>
<main style="min-height: 300px;">
  <section class="section-breadcrump" style="background-image: url(<?= public_dir('/img/section_breadcrumb.webp') ?>)">
    <div class="container-md">
      <div class="breadcrump-container text-center">
        <div class="title-section">
          <h2 style="margin-bottom: 25px;">Đăng ký tài khoản</h2>
          <ul class="breadcrump p-0">
            <li>
              <a href="/" class="hover-maincl">Trang chủ</a>
              <i class="fa-solid fa-caret-right"></i>
            </li>
            <li><a href="<?= route('RegisterRoute'); ?>">Đăng ký tài khoản</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="section-form-register">
    <div class="container-lg">
      <form class="registration-form" id="form-register" action="<?= route('HandleRegisterRoute'); ?>" method="post"
        onsubmit="return validateForm()">
        <div class="row">
          <div class="col-xl-6 col-lg-12 mb-4 mb-xl-0">
            <h2 class="form-title">Đăng ký tài khoản</h2>
            <p class="form-text">Nếu chưa có tài khoản, vui lòng đăng ký tại đây.</p>

            <div class="mb-3">
              <label for="fullName" class="form-label fw-semibold">Họ và tên:</label>
              <input id="fullName" type="text" name="fullName" class="form-control" minlength="3" placeholder="Nhập họ và tên của bạn" required
                oninvalid="this.setCustomValidity('Vui lòng nhập họ và tên của bạn')" oninput="this.setCustomValidity('')">
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Giới tính:</label>
              <div class="gender-options">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" required checked>
                  <label class="form-check-label" for="genderMale">Nam</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                  <label class="form-check-label" for="genderFemale">Nữ</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="genderOther" value="other">
                  <label class="form-check-label" for="genderOther">Khác</label>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label fw-semibold">Email:</label>
              <input id="email" type="email" name="email" class="form-control" placeholder="Nhập địa chỉ email của bạn" required
                oninvalid="this.setCustomValidity('Vui lòng nhập đúng định đạng địa chỉ email')" oninput="this.setCustomValidity('')">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label fw-semibold">Mật khẩu:</label>
              <input id="password" type="password" name="password" class="form-control" minlength="8" maxlength="50" placeholder="Nhập mật khẩu" required oninvalid="this.setCustomValidity('Mật khẩu phải có ít nhất 8 ký tự, chứa chữ hoa, chữ thường và số')"
                oninput="this.setCustomValidity('')">
            </div>

            <div class="d-flex gap-2 mt-4">
              <input type="submit" name="SubmitRegister" value="Đăng Ký" class="btn btn-custom-primary" />
              <a href="<?= route('LoginRoute'); ?>" class="btn btn-custom-secondary">Đăng Nhập</a>
            </div>
          </div>

          <div class="col-xl-6 col-lg-12">
            <div class="d-none d-xl-block">
              <h2 class="form-title invisible">Placeholder</h2>
              <p class="form-text invisible">Placeholder</p>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Ngày sinh:</label>
              <div class="row g-2">
                <!-- Dropdown ngày -->
                <div class="col-sm-4 mb-2 mb-sm-0">
                  <div class="custom-dropdown" id="dayDropdown">
                    <div class="dropdown-select form-control form-control-sm">
                      <span class="selected-text">Ngày</span>
                      <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </div>
                    <div class="dropdown-menu">
                      <ul class="dropdown-list">
                        <?php
                        for ($day = 1; $day <= 31; $day++) {
                          echo '<li class="dropdown-item" data-value="' . $day . '">' . $day . '</li>';
                        }
                        ?>
                      </ul>
                    </div>
                    <input type="hidden" name="day" class="dropdown-input" required>
                  </div>
                </div>

                <!-- Dropdown tháng -->
                <div class="col-sm-4 mb-2 mb-sm-0">
                  <div class="custom-dropdown" id="monthDropdown">
                    <div class="dropdown-select form-control form-control-sm">
                      <span class="selected-text">Tháng</span>
                      <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </div>
                    <div class="dropdown-menu">
                      <ul class="dropdown-list">
                        <?php
                        $months = array(
                          1 => 'Tháng 1',
                          2 => 'Tháng 2',
                          3 => 'Tháng 3',
                          4 => 'Tháng 4',
                          5 => 'Tháng 5',
                          6 => 'Tháng 6',
                          7 => 'Tháng 7',
                          8 => 'Tháng 8',
                          9 => 'Tháng 9',
                          10 => 'Tháng 10',
                          11 => 'Tháng 11',
                          12 => 'Tháng 12'
                        );

                        foreach ($months as $num => $name) {
                          echo '<li class="dropdown-item" data-value="' . $num . '">' . $name . '</li>';
                        }
                        ?>
                      </ul>
                    </div>
                    <input type="hidden" name="month" class="dropdown-input" required>
                  </div>
                </div>

                <!-- Dropdown năm -->
                <div class="col-sm-4">
                  <div class="custom-dropdown" id="yearDropdown">
                    <div class="dropdown-select form-control form-control-sm">
                      <span class="selected-text">Năm</span>
                      <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </div>
                    <div class="dropdown-menu">
                      <ul class="dropdown-list">
                        <?php
                        $currentYear = date('Y');
                        $startYear = $currentYear - 100;

                        for ($year = $currentYear; $year >= $startYear; $year--) {
                          echo '<li class="dropdown-item" data-value="' . $year . '">' . $year . '</li>';
                        }
                        ?>
                      </ul>
                    </div>
                    <input type="hidden" name="year" class="dropdown-input" required>
                  </div>
                </div>
              </div>

              <!-- Input ẩn để lưu trữ ngày sinh đầy đủ -->
              <input type="hidden" name="birthDate" id="fullBirthDate">
            </div>

            <div class="mb-3">
              <label for="phoneNumber" class="form-label fw-semibold">Số điện thoại:</label>
              <input id="phoneNumber" type="tel" name="phoneNumber" class="form-control" pattern="[0-9]{10,11}" placeholder="Nhập số điện thoại của bạn" required oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại của bạn')" oninput="this.setCustomValidity('')">
            </div>

            <div class="mb-3">
              <label for="address" class="form-label fw-semibold">Địa chỉ:</label>
              <textarea id="address" name="address" class="form-control" rows="4" placeholder="Nhập địa chỉ của bạn" required oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ của bạn')" oninput="this.setCustomValidity('')"></textarea>
            </div>

          </div>
        </div>

        <div class="social-login">
          <h3 class="social-login-title">Đăng nhập bằng Google</h3>
          <a href="<?php echo $googleLoginUrl; ?>" class="btn-google">
            <i class="fa-brands fa-google-plus-g"></i>
            <span>Google</span>
          </a>
        </div>
      </form>
    </div>
  </section>
</main>
<?php
require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>