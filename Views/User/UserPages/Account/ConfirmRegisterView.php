<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Thực Đăng Ký Tài Khoản | Samsonitu Shoes</title>
    <link rel="icon" href="<?= public_dir('/img/logo-shoes-white.png'); ?>">
    <link rel="stylesheet" href="<?= public_dir('css/UserCss/confirmRegister.css'); ?>">
    <link rel="stylesheet" href="<?= public_dir('css/ToastMessage.css'); ?>">
    <link rel="stylesheet" href="<?= public_dir('/font/fontawesome-free-6.4.2-web/css/all.min.css') ?>">
</head>
<body>
    <div id="toast__container"></div>

    <div class="verification-container">
        <div class="logo">
            <img src="<?= public_dir('/img/logo-shoes-white.png'); ?>" alt="Samsonitu Shoes">
            <h3 class="logo-name">Samsonitu Shoes</h3>
        </div>
        <h2>Xác thực tài khoản</h2>
        <p>Chúng tôi đã gửi một mã xác thực đến email của bạn. Vui lòng nhập mã để hoàn tất đăng ký.</p>

        <form action="<?= route('HandleConfirmRegisterRoute') ?>" method="POST">
            <input type="text" name="verificationCode" placeholder="Nhập mã xác nhận" required maxlength="5">
            <input type="submit" name="SubmitConfirmRegister" value="Xác nhận">
        </form>

        <div class="resend">
            <p>Không nhận được mã?</p>
            <a href="<?= route('resendVerificationCodeRoute'); ?>">Gửi lại mã</a>
        </div>
    </div>

    <script src="<?= public_dir('js/ToastMessage.js') ?>"></script>
    <?php include './Views/Partials/toast.php'; ?>
</body>
</html>
