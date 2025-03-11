<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SSNT SHOES</title>
    <link rel="icon" href="<?= public_dir('/img/logo-shoes-white.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= public_dir('/font/fontawesome-free-6.4.2-web/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= public_dir('/css/AdminCss/login.css') ?>">

    <link rel="stylesheet" href="<?= public_dir('/css/ToastMessage.css') ?>">
</head>
<body>
    <section class="auth">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card auth__card">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="<?= public_dir('/img/unnamed.jpg') ?>" alt="login form" class="img-fluid auth__image" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body auth__form text-black">
                                    <form action="<?= route('AdminLoginSubmitRoute') ?>" method="post">
                                        <div class="d-flex align-items-center mb-3 pb-1 justify-content-between">
                                            <span class="h1 auth__form-title">
                                                <img src="<?= public_dir('/img/logo.webp') ?>" alt="" class="auth__logo">
                                            </span>
                                            <h4>Tài khoản quản trị</h4>
                                        </div>
                                        <h5 class="auth__form-subtitle mb-3 pb-3">Đăng nhập vào tài khoản quản trị</h5>
                                        <div class="form-outline auth__input">
                                            <input type="text" name="email" id="form2Example17" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">Tài khoản</label>
                                        </div>
                                        <div class="form-outline auth__input">
                                            <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Mật khẩu</label>
                                        </div>
                                        <div class="pt-1 d-flex justify-content-between align-items-center">
                                            <input type="submit" class="btn btn-dark auth__submit" name="SubmitAdminLogin" value="Đăng nhập">
                                            <a href="<?= route('HomeRoute'); ?>">Trở về trang chủ</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="toast__container"></div>
    <script src="<?= public_dir('/js/toastMessage.js') ?>"></script>
    <?php include './Views/Partials/toast.php' ?>
</body>
</html>