<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bổ Sung Thông Tin Tài Khoản | Samsonitu Shoes</title>
    <link rel="icon" href="<?= public_dir('/img/logo-shoes-white.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= public_dir('css/ToastMessage.css'); ?>">
    <link rel="stylesheet" href="<?= public_dir('/font/fontawesome-free-6.4.2-web/css/all.min.css') ?>">
    <!-- Link to the new CSS file -->
    <link rel="stylesheet" href="<?= public_dir('css/UserCss/additionalInfo.css'); ?>">
</head>
<body>
    <div id="toast__container"></div>

    <div class="account-form-container">
        <div class="form-header">
            <img src="<?= public_dir('/img/logo-shoes-white.png'); ?>" alt="Samsonitu Shoes">
            <h3 class="brand-name">Samsonitu Shoes</h3>
        </div>
        
        <h2 class="form-title">Bổ sung thông tin tài khoản</h2>

        <div class="form-content">
            <form action="<?= route('HandleAdditionalInfoRoute') ?>" method="POST" onsubmit="return validateForm()">
                <div class="form-row">
                    <!-- Left Column -->
                    <div class="form-col">
                        <!-- Email field (read-only) -->
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email); ?>" class="form-control" readonly>
                        </div>
                        
                        <!-- Provider field (read-only) -->
                        <div class="form-group">
                            <label for="provider" class="form-label">Nhà cung cấp</label>
                            <input type="text" id="provider" name="provider" value="<?= htmlspecialchars($provider); ?>" class="form-control" readonly>
                        </div>
                        
                        <!-- Gender selection -->
                        <div class="form-group">
                            <label for="gender" class="form-label">Giới tính</label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="">Chọn giới tính</option>
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="form-col">
                        <!-- fullName field (read-only) -->
                        <div class="form-group">
                            <label for="fullName" class="form-label">Họ và tên</label>
                            <input type="text" id="fullName" name="fullName" class="form-control" required maxlength="50">
                        </div>

                        <!-- Date of birth -->
                        <div class="form-group">
                            <label class="form-label">Ngày sinh:</label>
                            <div class="date-row">
                                <!-- Day dropdown -->
                                <div class="date-column">
                                    <div class="custom-dropdown" id="dayDropdown">
                                        <div class="dropdown-select">
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

                                <!-- Month dropdown -->
                                <div class="date-column">
                                    <div class="custom-dropdown" id="monthDropdown">
                                        <div class="dropdown-select">
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

                                <!-- Year dropdown -->
                                <div class="date-column">
                                    <div class="custom-dropdown" id="yearDropdown">
                                        <div class="dropdown-select">
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
                            <!-- Hidden full birthdate field -->
                            <input type="hidden" name="birthDate" id="fullBirthDate">
                        </div>

                        <!-- Phone number field -->
                        <div class="form-group">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" id="phone" name="phoneNumber" placeholder="Nhập số điện thoại" required pattern="^0[0-9]{9,10}$" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Full width row for address -->
                <div class="form-row">
                    <div class="form-col" style="flex: 0 0 100%; max-width: 100%;">
                        <!-- Address field as textarea -->
                        <div class="form-group">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea id="address" name="address" placeholder="Nhập địa chỉ của bạn" required class="form-textarea"></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Submit button -->
                <div class="form-row">
                    <div class="button-container">
                        <input type="submit" name="SubmitAdditionalInfo" value="Xác nhận" class="submit-button">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const form = document.querySelector('form');
            const fullName = form.fullName.value.trim();
            const phone = form.phone.value;
            const address = form.address.value.trim();

            if(fullName.startsWith(' ')) {
            alert('Họ và tên không được bắt đầu bằng khoảng trắng!');
            return false;
            }

            if (/^0[0-9]{9,10}$/.test(phone) === false) {
                alert('Số điện thoại không hợp lệ!');
                return false;
            }
            if (address.startsWith(' ')) {
                alert('Địa chỉ không được bắt đầu bằng khoảng trắng!');
                return false;
            }
            return true;
        }
    </script>
    <script src="<?= public_dir('js/UserJs/AdditionalInfo.js') ?>"></script>
    <script src="<?= public_dir('js/ToastMessage.js') ?>"></script>
    <?php include './Views/Partials/toast.php'; ?>
</body>
</html>