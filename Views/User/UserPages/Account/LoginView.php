<?php
    require_once __DIR__ . "/../../UserLayouts/HeaderView.php";
?>
<main style="min-height: 300px;">
    <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
        <div class="container-md">
            <div class="breadcrump-container text-center">
                <div class="title-section">
                    <h2 style="margin-bottom: 25px;">Đăng nhập tài khoản</h2>
                    <ul class="breadcrump p-0">
                        <li>
                            <a href="/" class="hover-maincl">Trang chủ</a>
                            <i class="fa-solid fa-caret-right"></i>
                        </li>
                        <li><a href="<?= route('LoginRoute'); ?>">Đăng nhập tài khoản</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="section-form-login">
        <div class="container-lg">
            <div class="row">
                <form action="<?= route('HandleLoginRoute') ?>"  method="post" class="col-xl-6 col-lg-12" id="form-login">
                    <h1 class="text-uppercase" style="font-size: 19px; font-weight: 700; height: 30px;">Đăng nhập tài khoản</h1>
                    <p style="height: 20px;">Nếu bạn đã có tài khoản, đăng nhập tại đây.</p>
                    <div action="" class="d-flex flex-column">
                        <label for=""><b>Email:</b></label>
                        <input class="py-2 px-1" type="email" name="email" tabindex="1" placeholder="Email">
                        <label for=""><b>Mật khẩu:</b></label>
                        <input class="py-2 px-1" type="password" name="password" tabindex="2" placeholder="Password">
                        <br>
                        <p>
                            <input type="submit" value="Đăng nhập" name="SubmitLogin" class="btn bg-maincl text-light">
                            <a href="<?= route('RegisterRoute');?> " class="btn hover-main-bg" style="color: var(--maincolor); border-color: var(--maincolor);">Đăng ký</a>
                        </p>
                    </div>
                </form>
                <form class="col-xl-6 col-lg-12" action="<?= route('GetPasswordByEmailRoute'); ?>" method="post">
                    <h1 style="height: 29px;"></h1>
                    <p style="height: 20px;">Bạn quên mật khẩu? Nhập địa chỉ email để đặt lại mật khẩu.</p>
                    <div class="d-flex flex-column">
                        <label for=""><b>Email:</b></label>
                        <input class="py-2 px-1" type="email" name="email" placeholder="Email">
                        <br>
                        <p>
                            <input type="submit" name="SubmitGetPassword" class="btn bg-maincl text-light" value="Đặt lại mật khẩu">
                        </p>
                    </div>
                </form>
            </div>
            
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <h3 style="font-family: 'Oswald'; font-weight: 400; font-size: 25px;">Đăng nhập bằng Google</h3>
                    <div style="display: inline-block; background-color: #E14B33;" class="me-1">
                        <a href="<?php echo $googleLoginUrl; ?>" class="text-decoration-none text-light d-block p-2">
                            <i class="fa-brands fa-google-plus-g pe-2" style="border-right: 1px solid #000;"></i>
                            <span class="px-2">Google</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
    require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>