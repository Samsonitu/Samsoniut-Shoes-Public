<?php
    $Title = "Giới Thiệu Về Chúng Tôi | Samsonitu Shoes";
    require_once __DIR__ . "/../UserLayouts/HeaderView.php";
?>
    <main>
        <!-- Breadcrump -->
        <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
            <div class="breadcrump-container text-center">
                <div class="title-section">
                    <h2 style="margin-bottom: 25px;">Giới thiệu</h2>
                    <ul class="breadcrump p-0">
                        <li>
                            <a href="" class="hover-maincl">Trang chủ</a>
                            <i class="fa-solid fa-caret-right"></i>
                        </li>
                        <li><span>Giới thiệu</span></li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section-introduce-content">
            <div class="container-md">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title-section">
                            <h2>Về chúng tôi</h2>
                        </div>
                        <p style="font-size: 14px;">HaluShoe là một cửa hàng chuyên kinh doanh thời trang thể thao chất lượng cao với mục tiêu mang đến cho khách hàng những sản phẩm đẳng cấp, chất lượng và sự thoải mái khi vận động. Với đội ngũ nhân viên giàu kinh nghiệm và đam mê về thể thao, HaluShoe cam kết cung cấp những sản phẩm chất lượng tốt nhất và chăm sóc khách hàng một cách chuyên nghiệp.</p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center">
                        <img class="pt-5" width="80%" height="75%" src="<?=public_dir('/img/about-we.jpg')?>" alt="">
                    </div>
                </div>
                <div class="row p-3">
                    <div class="title-section text-center mb-4">
                        <h2>Lịch sử cửa hàng</h2>
                    </div>
                    <div class="history-about">
                        <div class="row" style="padding: 30px 0;">
                            <div class="col-md-6 col-sm-12 history-text">
                                <div class="inner-text">
                                    <h3>Khai trương</h3>
                                    <p>Cửa hàng HaluShoe có những điểm nổi bật như thiết kế đa dạng, phong phú và độc đáo, phù hợp với nhiều loại hình thể thao. Ngoài ra, sản phẩm của HaluShoe được làm từ các chất liệu cao cấp, đảm bảo sự thoải mái và độ bền cao cho người sử dụng.</p>
                                </div>
                                <div class="year">
                                    2010
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 history-img text-center">
                                <img src="<?=public_dir('/img/about2.webp')?>" alt="">
                            </div>
                        </div>
                        <div class="row" style="padding: 30px 0;">
                            <div class="col-md-6 col-sm-12 history-img text-center">
                                <img src="<?=public_dir('/img/about3.webp')?>" alt="">
                            </div>
                            <div class="col-md-6 col-sm-12 history-text">
                                <div class="year">
                                    2015
                                </div>
                                <div class="inner-text">
                                    <h3>Đặt hàng online</h3>
                                    <p>HaluShoe đã mở thêm 5 cửa hàng, nâng tổng số cửa hàng lên 20 cửa hàng và trở thành chuỗi cửa hàng phát triển nhanh nhất tại Việt Nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 30px 0;">
                            <div class="col-md-6 col-sm-12 history-text">
                                <div class="inner-text">
                                    <h3>40 Cửa hàng</h3>
                                    <p>HaluShoe đã mở cửa hàng thứ 40 bên ngoài Việt Nam. Domino's kỷ niệm 12 năm phát triển trên khắp thế giới. Đồng thời, doanh thu toàn cầu đạt hơn 100 tỷ VNĐ.</p>
                                </div>
                                <div class="year">
                                    2020
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 history-img text-center">
                                <img src="<?=public_dir('/img/about2.webp')?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
    require_once __DIR__ . "/../UserLayouts/FooterView.php";
?>