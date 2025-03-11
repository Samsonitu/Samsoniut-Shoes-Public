<footer class="bg-black text-light" style="padding: 80px 0 10px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-12">
                <h4>HỆ THỐNG CỦA HÀNG TOÀN QUỐC</h4>
                <p><i class="me-2 fa-solid fa-location-dot"></i>HALU Đội Cấn</p>
                <p>Địa chỉ: Tòa Ladeco, 266 Đội Cấn - Ba Đình - Hà Nội</p>
                <p>Hotline: 19006750</p>
                            
                <p><i class="me-2 fa-solid fa-location-dot"></i>HALU Lữ Gia</p>
                <p>Địa chỉ: 70 Lữ Gia - Quận11 - TP.Hồ Chí Mình</p>
                <p>Hotline: 19006750</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <h4>CHÍNH SÁCH</h4>
                <ul style="list-style-type: none;" class="m-0 p-0 list-menu">
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="<?= route('IntroduceRoute'); ?>">Giới thiệu</a></li>
                    <li><a href="<?= route('ProductRoute'); ?>">Sản phẩm</a></li>
                    <li><a href="<?= route('NewsRoute'); ?>">Tin tức</a></li>
                    <li><a href="<?= route('ContactRoute'); ?>">Liên hệ</a></li>
                    <li><a href="<?= route('StoreSystemRoute') ?>">Hệ thống cửa hàng</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h4>ĐĂNG KÝ NHẬN TIN</h4>
                <p>Đăng ký nhận bản tin của chúng tôi để nhận các sản phẩm mới, mã khuyến mại nhanh nhất</p>
                <form action="" class="d-flex justify-content-between align-items-center bg-light py-3 px-3 w-100" style="border-radius: 24px; overflow: hidden;">
                    <input class="border-0" style="outline: 0; width: 90%" type="email" placeholder="Email của bạn">
                    <i style="font-size: 22px;" class="text-dark fa-regular fa-envelope"></i>
                </form>
                <div class="social-list">
                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                    <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                    <a href=""><i class="fa-brands fa-pinterest-p"></i></a>
                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                    <a href=""><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center gap-2">
            <img src="<?= public_dir('/img/img_payment_1.webp')?>" alt="">
            <img src="<?= public_dir('/img/img_payment_2.webp')?>" alt="">
            <img src="<?= public_dir('/img/img_payment_3.webp')?>" alt="">
            <img src="<?= public_dir('/img/img_payment_4.webp')?>" alt="">
            <img src="<?= public_dir('/img/img_payment_5.webp')?>" alt="">
            <img src="<?= public_dir('/img/img_payment_6.webp')?>" alt="">
        </div>
        <p class="py-3 m-0 text-center">© Bản quyền thuộc về Samsonitu</p>
    </div>
</footer>

<div id="toast__container"></div>
<script src="<?= public_dir('/js/toolTip.js') ?>"></script>
<script src="<?= public_dir('/js/toastMessage.js') ?>"></script>
<?php
    include './Views/Partials/toast.php';
    if (!empty($extraJS)) {
        foreach ($extraJS as $js) {
            echo '<script src="' . $js . '"></script>';
        }
    }
?>
<script src="<?= public_dir('/js/UserJs/script.js') ?>"></script>
</body>
</html>