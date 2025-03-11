<?php
    $extraCSS = [
        public_dir('/css/UserCss/home.css') 
    ];

    $extraJS = [
        public_dir('/js/UserJs/home.js')
    ];

    require_once __DIR__ . ('/../UserLayouts/HeaderView.php');
?>

<!-- Begin Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        </div>

        <!-- The slideshow/carousel --> 
        <a href="<?= route('ProductRoute'); ?>" class="carousel-inner">
            <div class="carousel-item active"></div>
            <div class="carousel-item"></div>
        </a>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" style="width: 5%;" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" style="width: 5%;" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
<!-- End Carousel -->
    
<main>
    <section class="section-home-category">
        <div class="container">
            <div class="title-section text-center">
                <p>Toàn bộ sản phẩm đều là hàng chính hãng</p>
                <h2>DANH MỤC SẢN PHẨM</h2>
            </div>
            <div class="split-gallery pt-4">
                <div class="gallery-image-column">
                    <a class="w-100 d-block" href="<?= route('ProductCategoryRoute', ['catSlug' => 'chay-bo']); ?>">
                        <img width="100%" height="100%" src="<?= public_dir('/img/section_home_category1.webp')?>" alt="">
                    </a>
                    <div class="gallery-image-caption text-uppercase">Chạy bộ</div>
                </div>
                <div class="gallery-image-column">
                    <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'leo-nui']); ?>">
                        <img width="100%" height="100%" src="<?= public_dir('/img/section_home_category2.webp')?>" alt="">
                    </a>
                    <div class="gallery-image-caption text-uppercase">Leo núi</div>
                </div>
                <div class="gallery-image-column">
                    <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'quan-vot']); ?>">
                        <img width="100%" height="100%" src="<?= public_dir('/img/section_home_category3.webp')?>" alt="">
                    </a>
                    <div class="gallery-image-caption text-uppercase">Quần vợt</div>
                </div>
                <div class="gallery-image-column">
                    <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'bong-ro']); ?>">
                        <img width="100%" height="100%" src="<?= public_dir('/img/section_home_category4.webp')?>" alt="">
                    </a>
                    <div class="gallery-image-caption text-uppercase">Bóng rổ</div>
                </div>
            </div>
        </div>
        <section class="section-banner">
            <div class="marquee-container">
                <span><i class="fa-solid fa-bolt"></i> Đổi hàng trong 30 ngày</span>
                <span><i class="fa-solid fa-bolt"></i> Tặng quà trên mỗi đơn hàng từ 500k</span>
                <span><i class="fa-solid fa-bolt"></i> Giảm 15% cho ĐH đầu tiền từ 699k</span>
                <span><i class="fa-solid fa-bolt"></i> Miễn phí vận chuyển từ ĐH 599k</span>
                <span><i class="fa-solid fa-bolt"></i> Đổi hàng trong 30 ngày</span>
                <span><i class="fa-solid fa-bolt"></i> Tặng quà trên mỗi đơn hàng từ 500k</span>
                <span><i class="fa-solid fa-bolt"></i> Giảm 15% cho ĐH đầu tiền từ 699k</span>
                <span><i class="fa-solid fa-bolt"></i> Miễn phí vận chuyển từ ĐH 599k</span>
            </div>
        </section>  
    </section>

    <section class="section-best-seller">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 d-flex align-items-center ">
                    <div class="title-section text-center">
                        <h4>LOOK BOOK</h4>
                        <h2 class="mt-3 mb-4">GIÀY CHẠY BỘ BÁN NHIỀU NHẤT</h2>
                        <p>
                            Bước vào thế giới của sự thoải mái và phong cách vô song với những đôi giày đặc biệt này, chúng chắc chắn sẽ để lại ấn tượng lâu dài ở bất cứ nơi đâu bạn đến.
                        </p>
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'nam']); ?>" 
                                class="btn btn-dark px-4 py-2 hover-main-bg border-0"
                            >
                                <h4 class="mb-0">GIÀY NAM</h4></a>
                            <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'nu']);?>" 
                                class="btn btn-dark px-4 py-2 hover-main-bg border-0"
                            >
                                <h4 class="mb-0">GIÀY NỮ</h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 d-flex mt-4">
                    <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'nam']); ?>" class="w-50 d-block">
                        <img width="100%" src="<?= public_dir('/img/section_home_banner1.webp')?>" 
                        alt="giay-nam-chay-bo">
                    </a>
                    <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'nu']); ?>" class="w-50 d-block">
                        <img width="100%" src="<?= public_dir('/img/section_home_banner2.webp')?>" 
                        alt="giay-nu-chay-bo">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-home-shipping">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="text-center">
                        <img src="<?= public_dir('/img/section_home_shipping1.webp'); ?>" alt="giao-hang-mien-phi">
                        <h3>Giao hàng miễn phí</h3>
                        <p>Đăng ký để cập nhật và nhận giao hàng miễn phí</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="text-center">
                        <img src="<?= public_dir('/img/section_home_shipping2.webp'); ?>" alt="giao-hang-trong-30-phut">
                        <h3>Giao hàng trong 30 phút</h3>
                        <p>Mọi thứ bạn đặt hàng sẽ nhanh chóng được giao đến tận nơi.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="text-center">
                        <img src="<?= public_dir('/img/section_home_shipping3.webp'); ?>" alt="dam-bao-chat-luong-tot-nhat">
                        <h3>Đảm bảo chất lượng tốt nhất</h3>
                        <p>HaluShoes là một chuỗi cửa hàng gia đình quốc gia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(!empty($newProductList)): ?> 
    <section class="section-new-product">
        <div class="container">
            <div class="title-section d-flex justify-content-between">
                <h2>Sản phẩm mới nhất</h2>
                <a class="text-uppercase text-decoration-none text-dark hover-maincl" 
                    href="<?= route('ProductCategoryRoute', ['catSlug' => 'san-pham-moi-nhat']); ?>"
                >
                    ---Xem tất cả
                </a>
            </div>
            <div class="d-flex new-product-list">
                <?php foreach($newProductList as $key => $newProductItem):
                    $firstColor = reset($newProductItem['colors']);    
                ?>
                <div class="product-item" 
                    data-pro-id="<?= $key; ?>"
                >
                    <button class="btn p-0 wish-list"><i class="fa-regular fa-heart"></i></button>
                    <div class="product-thumbnail">
                        <span class="sale-flash"><?= $firstColor['discount']; ?>%</span>
                        <span class="tag-km">
                            <img width="20px" height="20px" src="<?= public_dir('/img/title_image_1_tag.webp')?>" 
                                alt="tag-san-pham-moi">
                            Mới
                        </span>
                        <a href="<?= route('ProductDetailsRoute', ['proSlug' => htmlspecialchars($newProductItem['proSlug'])]) ?>">
                            <img class="product-item-image" style="max-width: 100%; max-height: 100%;" 
                            src="<?= htmlspecialchars($firstColor['image']); ?>" 
                            alt="<?= htmlspecialchars($newProductItem['proName']). ' Màu ' . htmlspecialchars($firstColor['colorName']);?>">
                        </a>
                    </div>
                    <div class="product-info">
                        <p class="text-center mb-0 text-secondary">
                            <small><?= htmlspecialchars($newProductItem['brandName']) ?></small>
                        </p>
                        <div class="d-flex gap-2 my-2">
                            <?php $index = 0; foreach ($newProductItem['colors'] as $color): ?>
                                <div class="circle-product-color <?= $index === 0 ? 'active' : ''; ?>" 
                                    data-variant-color-code="<?= htmlspecialchars($color['colorCode']) ?>"
                                    data-variant-image="<?= htmlspecialchars($color['image']) ?>"
                                    data-variant-discount="<?= htmlspecialchars($color['discount']) ?>"
                                    data-variant-price="<?= htmlspecialchars($color['price']) ?>"
                                    data-variant-id="<?= $color['varId']; ?>"
                                    style="background-color: <?= htmlspecialchars($color['colorCode']) ?>;">
                                </div>
                            <?php $index++; endforeach; ?>
                        </div>
                        <h3 class="product-name">
                            <a href="<?= route('ProductDetailsRoute', ['proSlug' => htmlspecialchars($newProductItem['proSlug'])]); ?>"
                                class="hover-maincl text-decoration-none">
                                <?= $newProductItem['proName'] ?>
                            </a>
                        </h3>
                        <span class="product-price" style="font-size: 14px;">
                            <b>
                                <span class="product-price-discounted">
                                    <?= formatPrice($firstColor['price'] * (100 - $firstColor['discount']) / 100); ?>₫ 
                                </span>
                                <sup>
                                    <strike class="product-price-old" style="color: #b0b0b0;">
                                        <?= formatPrice($firstColor['price']); ?>₫
                                    </strike>
                                </sup>
                            </b>
                        </span>
                    </div>
                    <br>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
    <?php if(!empty($hotProductList)) : ?>
    <section class="section-hot-product">
        <div class="container">
            <div class="title-section d-flex justify-content-between">
                <h2>Sản phẩm nổi bật</h2>
                <a class="text-uppercase text-decoration-none text-dark hover-maincl" 
                    href="<?= route('ProductCategoryRoute', ['catSlug' => 'san-pham-noi-bat']); ?>">
                    ---Xem tất cả
                </a>
            </div>
            <div class="d-flex hot-product-list">
                <?php foreach($hotProductList as $key => $hotProductItem):
                    $firstColor = reset($hotProductItem['colors']);
                ?>
                <div class="product-item" 
                    data-pro-id="<?= $key; ?>"
                >
                    <button class="btn p-0 wish-list"><i class="fa-regular fa-heart"></i></button>
                    <div class="product-thumbnail">
                        <span class="sale-flash"><?= $firstColor['discount']; ?>%</span>
                        <span class="tag-km">
                            <img width="20px" height="20px" src="<?= public_dir('/img/title_image_1_tag.webp')?>" alt="">Mới</span>
                        <a href="<?= route('ProductDetailsRoute', ['proSlug' => htmlspecialchars($hotProductItem['proSlug'])]) ?>">
                            <img class="product-item-image" style="max-width: 100%; max-height: 100%;" 
                            src="<?= htmlspecialchars($firstColor['image']); ?>" 
                            alt="<?= htmlspecialchars($hotProductItem['proName']). ' Màu ' . htmlspecialchars($firstColor['colorName']);?>">
                        </a>
                    </div>
                    <div class="product-info">
                        <p class="text-center mb-0 text-secondary">
                            <small><?= htmlspecialchars($hotProductItem['brandName']) ?></small>
                        </p>
                        <div class="d-flex gap-2 my-2">
                            <?php $index = 0; foreach ($hotProductItem['colors'] as $color): ?>
                                <div class="circle-product-color <?= $index === 0 ? 'active' : ''; ?>" 
                                    data-variant-color-code="<?= htmlspecialchars($color['colorCode']) ?>"
                                    data-variant-image="<?= htmlspecialchars($color['image']) ?>"
                                    data-variant-discount="<?= htmlspecialchars($color['discount']) ?>"
                                    data-variant-price="<?= htmlspecialchars($color['price']) ?>"
                                    data-variant-id="<?= $color['varId'] ?>"
                                    style="background-color: <?= htmlspecialchars($color['colorCode']) ?>;">
                                </div>
                            <?php $index++; endforeach; ?>
                        </div>
                        <h3 class="product-name">
                            <a href="<?= route('ProductDetailsRoute', ['proSlug' => htmlspecialchars($hotProductItem['proSlug'])]); ?>"
                                class="hover-maincl text-decoration-none">
                                <?= $hotProductItem['proName'] ?>
                            </a>
                        </h3>
                        <span class="product-price" style="font-size: 14px;">
                            <b>
                                <span class="product-price-discounted">
                                    <?= formatPrice($firstColor['price'] * (100 - $firstColor['discount']) / 100); ?>₫ 
                                </span>
                                <sub>
                                    <strike class="product-price-old" style="color: #b0b0b0;">
                                        <?= formatPrice($firstColor['price']); ?>₫
                                    </strike>
                                </sub>
                            </b>
                        </span>
                    </div>
                    <br>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if(!empty($bestSellerProductList)) : ?>
    <section class="section-best-seller-product">
        <div class="container">
            <div class="title-section d-flex justify-content-between">
                <h2>Sản phẩm bán chạy</h2>
                <a class="text-uppercase text-decoration-none text-dark hover-maincl" 
                    href="<?= route('ProductCategoryRoute', ['catSlug' => 'san-pham-ban-chay']); ?>">
                    ---Xem tất cả
                </a>
            </div>
            <div class="d-flex best-seller-product-list">
                <?php foreach($bestSellerProductList as $key => $bestSellerProductItem):
                    $firstColor = reset($bestSellerProductItem['colors']);
                ?>
                <div class="product-item" 
                    data-pro-id="<?= $key; ?>"
                >
                    <button class="btn p-0 wish-list"><i class="fa-regular fa-heart"></i></button>
                    <div class="product-thumbnail">
                        <span class="sale-flash"><?= $firstColor['discount']; ?>%</span>
                        <span class="tag-km">
                            <img width="20px" height="20px" src="<?= public_dir('/img/title_image_1_tag.webp')?>" alt="">Mới</span>
                        <a href="<?= route('ProductDetailsRoute', ['proSlug' => htmlspecialchars($bestSellerProductItem['proSlug'])]) ?>">
                            <img class="product-item-image" style="max-width: 100%; max-height: 100%;" 
                            src="<?= htmlspecialchars($firstColor['image']); ?>" 
                            alt="<?= htmlspecialchars($bestSellerProductItem['proName']). ' Màu ' . htmlspecialchars($firstColor['colorName']);?>">
                        </a>
                    </div>
                    <div class="product-info">
                        <p class="text-center mb-0 text-secondary">
                            <small><?= htmlspecialchars($bestSellerProductItem['brandName']) ?></small>
                        </p>
                        <div class="d-flex gap-2 my-2">
                            <?php $index = 0; foreach ($bestSellerProductItem['colors'] as $color): ?>
                                <div class="circle-product-color <?= $index === 0 ? 'active' : ''; ?>" 
                                    data-variant-color-code="<?= htmlspecialchars($color['colorCode']) ?>"
                                    data-variant-image="<?= htmlspecialchars($color['image']) ?>"
                                    data-variant-discount="<?= htmlspecialchars($color['discount']) ?>"
                                    data-variant-price="<?= htmlspecialchars($color['price']) ?>"
                                    data-variant-id="<?= $color['varId'] ?>"
                                    style="background-color: <?= htmlspecialchars($color['colorCode']) ?>;">
                                </div>
                            <?php $index++; endforeach; ?>
                        </div>
                        <h3 class="product-name">
                            <a href="<?= route('ProductDetailsRoute', ['proSlug' => htmlspecialchars($bestSellerProductItem['proSlug'])]); ?>"
                                class="hover-maincl text-decoration-none">
                                <?= $bestSellerProductItem['proName'] ?>
                            </a>
                        </h3>
                        <span class="product-price" style="font-size: 14px;">
                            <b>
                                <span class="product-price-discounted">
                                    <?= formatPrice($firstColor['price'] * (100 - $firstColor['discount']) / 100); ?>₫ 
                                </span>
                                <sub>
                                    <strike class="product-price-old" style="color: #b0b0b0;">
                                        <?= formatPrice($firstColor['price']); ?>₫
                                    </strike>
                                </sub>
                            </b>
                        </span>
                    </div>
                    <br>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="section-video">
        <div class="title-section display-center text-center">
            <h3 class="text-light">Sản phẩm được mua nhiều nhất tháng này</h3>
            <h2 class="text-light">Giày chạy bộ</h2>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalVideo" class="btn-play border-0" style="background: none; outline: none;">
                <span class="bg-light"><i class="fa-solid fa-play"></i></span>
            </button>
        </div>
        <div class="modal fade" id="modalVideo" tabindex="-1" aria-labelledby="modalVideoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="height: 100%;">
                    <div class="modal-body p-0">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/b7WP23NK12Q?autoplay=1"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <img width="100%" src="<?=public_dir('/img/section_video_bg.webp')?>" alt="">
    </section>

    <?php if(!empty($newsList)) : ?>
    <section class="section-blog">
        <div class="container">
            <div class="title-section d-flex justify-content-between mb-4">
                <h2>Tin tức</h2>
                <a href="<?= route('NewsRoute') ?>" 
                    class="text-uppercase text-decoration-none text-dark hover-maincl">
                    --Xem tất cả tin tức
                </a>
            </div>
            <div class="d-flex blog-list">
                <?php foreach ($newsList as $newsItem): ?>
                <div class="blog-item">
                    <a class="blog-wrap-img"
                        href="<?= route('NewsDetailsRoute', ['newsSlug' => htmlspecialchars($newsItem['newsSlug'])]); ?>"    
                    >
                        <img width="100%" height="100%" 
                            src="<?= htmlspecialchars($newsItem['thumbnail']); ?>" 
                            alt="<?= htmlspecialchars($newsItem['title']); ?>"
                        >
                    </a>
                    <div class="blog-content">
                        <p class="d-flex gap-3 py-2 mb-1" style="font-size: 12px; color: #333333;">
                            <span><?= formatDate(htmlspecialchars($newsItem['createAt'])); ?></span>
                        </p>
                        <h2>
                            <a href="<?= route('NewsDetailsRoute', ['newsSlug' => htmlspecialchars($newsItem['newsSlug'])]); ?>" 
                                class="text-uppercase text-decoration-none text-dark hover-maincl">
                                <?= htmlspecialchars($newsItem['title']); ?>
                            </a>
                            </h2>
                        <p style="font-size: 13px;" class="my-2">
                            <?= htmlspecialchars($newsItem['excerpt']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <?php if(!empty($brandList)) : ?>
                <hr style="margin: 40px 0; border: 0; border-top: 2px solid #ccc;">
                <div class="d-flex brand-list">
                    <?php foreach($brandList as $brandItem) : ?>
                        <a href="<?= route('ProductBrandRoute', ['brandSlug' => $brandItem['brandSlug']]); ?>">
                        <img width="100%" src="<?= $brandItem['image']; ?>" 
                            alt="<?= $brandItem['brandName'] ?>">
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <section class="section-company" style="background-image: url(<?=public_dir('/img/section_company_team_bg.webp')?>);">
        <div class="container">
            <div class="title-section text-center mb-5">
                <h2>Khách hàng nói gì</h2>
            </div>
            <div class="d-flex customer-feedback">
                <div class="feedback-item text-center">
                    <p style="font-size: 14px; font-weight: 500; font-family: 'Quicksand'">
                    Tôi cũng muốn chia sẻ về trải nghiệm mua sắm tại cửa hàng Halu. Nhân viên rất nhiệt tình và tận tâm. Họ không chỉ giúp tôi chọn được đôi giày phù hợp, mà còn tư vấn về cách bảo quản và chăm sóc giày. Dịch vụ khách hàng tại đây thực sự xuất sắc!</p>
                    <p style="color: yellow; font-weight: 300; font-size: 14px;">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </p>
                    <p>
                        <b>NGUYỄN THỊ MINH</b> - Giám đốc
                    </p>
                    <p><img style="border-radius: 50%; max-width: 60px;" src="<?=public_dir('/img/section_company_team1.webp')?>" alt=""></p>
                </div>
                <div class="feedback-item text-center">
                    <p style="font-size: 14px; font-weight: 500; font-family: 'Quicksand'">
                    Mình thấy rất hài lòng về dịch vụ ở đây. Sự nhiệt tình của các bạn nhân viên và sự tư vấn tận tình của các bạn đã làm mình có thể chọn được đôi giày ưng ý.</p>
                    <p style="color: yellow; font-weight: 300; font-size: 14px;">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </p>
                    <p>
                        <b>LÊ THỊ THUÝ</b> - Trưởng phòng nhân sự
                    </p>
                    <p><img style="border-radius: 50%; max-width: 60px;" src="<?=public_dir('/img/section_company_team2.webp')?>" alt=""></p>
                </div>
                <div class="feedback-item text-center">
                    <p style="font-size: 14px; font-weight: 500; font-family: 'Quicksand'">
                    Mỗi bước chân đều thoải mái và nhẹ nhàng. Tôi có công việc phải di chuyển nhiều, và đôi giày Bata thực sự giúp tôi cảm thấy thoải mái và không mệt mỏi dù mỗi ngày tôi phải di chuyển khá nhiều.</p>
                    <p style="color: yellow; font-weight: 300; font-size: 14px;">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </p>
                    <p>
                        <b>NGUYỄN VĂN ANH</b> - Kỹ sư
                    </p>
                    <p><img style="border-radius: 50%; max-width: 60px;" src="<?=public_dir('/img/section_company_team3.webp')?>" alt=""></p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-instagram">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 px-1 col-md-4 pb-2" style="order: 0;">
                    <a class="d-block" href=""><img width="100%" height="100%" src="<?=public_dir('/img/section_instagram_img1.webp')?>" alt=""></a>
                </div>
                <div class="col-xl-6 px-1 col-md-12 d-flex align-items-center justify-content-center pb-2" style="order: 1;">
                    <div class="title-section">
                        <h2>Theo dõi Instagram của chúng tôi</h2>
                    </div>
                </div>
                <div class="col-xl-3 px-1 col-md-4 pb-2" style="order:2;">
                    <a class="d-block" href=""><img width="100%" height="100%" src="<?=public_dir('/img/section_instagram_img2.webp')?>" alt=""></a>
                </div>
                <div class="col-xl-3 px-1 col-md-4 pb-2" style="order:3;">
                    <a class="d-block" href=""><img width="100%" height="100%" src="<?=public_dir('/img/section_instagram_img3.webp')?>" alt=""></a>
                </div>
                <div class="col-xl-3 px-1 col-md-4 pb-2" style="order:4">
                    <a class="d-block" href=""><img width="100%" height="100%" src="<?=public_dir('/img/section_instagram_img4.webp')?>" alt=""></a>
                </div>
                <div class="col-xl-3 px-1 col-md-4 pb-2" style="order:5">
                    <a class="d-block" href=""><img width="100%" height="100%" src="<?=public_dir('/img/section_instagram_img5.webp')?>" alt=""></a>
                </div>
                <div class="col-xl-3 px-1 col-md-4 pb-2" style="order:6">
                    <a class="d-block" href=""><img width="100%" height="100%" src="<?=public_dir('/img/section_instagram_img6.webp')?>" alt=""></a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../UserLayouts/FooterView.php"; ?>