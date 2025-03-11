<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Title ?? 'Giày Dép Thời Trang Cho Mọi Lứa Tuổi - Chính Hãng Giá Tốt | Samsonitu Shoes' ?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?= public_dir('/img/logo-shoes-white.png'); ?>">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= public_dir('/css/UserCss/style.css') ?>">
    <link rel="stylesheet" href="<?= public_dir('css/ToastMessage.css') ?>">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?= public_dir('/font/fontawesome-free-6.4.2-web/css/all.min.css') ?>">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php
        use Controllers\UserControllers\NewsController;
        if (!empty($extraCSS)) {
            foreach ($extraCSS as $css) {
                echo '<link rel="stylesheet" href="' . $css . '">';
            }
        }
	?>
    <link rel="stylesheet" href="<?= public_dir('/css/UserCss/responsive.css')?>">


    <!-- JavaScript (JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <div class="container-lg" style="position: relative;">
            <nav class="navbar navbar-expand-sm justify-content-between align-items-center p-0 flex-nowrap">
                
                <a class="navbar-brand" href="/">
                    <img src="<?= public_dir("/img/logo-shoes-white.png") ?>" alt="Logo"> <span class="fs-6"><b>Samsonitu Shoes</b></span>
                </a>
                <div class="align-items-center gap-2 nav-call">
                    <span class="text-center rounded-circle">
                        <i class="fa-solid fa-phone" style="color: var(--maincolor);"></i>
                    </span>
                    <a href="tel:+84332601835" style="font-weight: 700; font-size: 16px; text-decoration: none; color: #fff;">GỌI NGAY: <b style="color: var(--maincolor)">19006750</b></a>
                </div>
                <div class="header-nav-right header-nav-right-pc">
                    <div class="icon-container icon-container--wishlist">
                        <a href="<?= route('WishListProductRoute'); ?>" class="icon-container__link icon-container__link--wishlist">
                            <i class="icon-container__icon fa-regular fa-heart"></i>
                            <span class="icon-container__badge">
                                <b class="icon-container__badge-count">
                                    <?= $_SESSION['userInfo'][0]['totalProWishList'] ?? 0; ?>
                                </b>
                            </span>
                        </a>
                    </div>
                    <div class="icon-container icon-container--cart">
                        <a href="<?= route('CartRoute'); ?>" class="icon-container__link icon-container__link--cart">
                            <i class="icon-container__icon fa-solid fa-bag-shopping"></i>
                            <span class="icon-container__badge">
                                <b class="icon-container__badge-count">
                                    <?= $_SESSION['userInfo'][0]['totalProInCart'] ?? 0; ?>
                                </b>
                            </span>
                        </a>
                    </div>
                    <?php if(isset($_SESSION['userInfo'])) : ?>
                        <ul class="nav-profile">
                            <li style="position: relative;">
                                <i class="fa-regular fa-user text-light"></i>
                                <ul class="subnav-profile">
                                    <li class="p-0">
                                        <a href="<?= route('AccountRoute'); ?>" class="text-light">
                                            <span class="hover-maincl">Tài Khoản Của Tôi</span>
                                        </a>
                                    </li>
                                    <li class="p-0">
                                        <a href="<?= route('OrderedRoute'); ?>" class="text-light">
                                            <span class="hover-maincl">Đơn Mua</span>
                                        </a>
                                    </li>
                                    <li class="p-0">
                                        <a href="<?= route('LogoutRoute'); ?>" class="text-light">
                                            <span class="hover-maincl">Đăng Xuất</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php else: ?>
                        <div class="mx-2" style="background-color: rgba(0, 0, 0, 0.5); display: flex; align-items: center; gap: 12px; border-radius: 20px; padding: 0 18px;">
                            <a href="<?= route('RegisterRoute'); ?>" class="text-decoration-none text-light hover-maincl">Đăng Ký</a>
                            <span class="mx-2 text-light">|</span>
                            <a href="<?= route('LoginRoute'); ?>" class="text-decoration-none text-light hover-maincl">Đăng Nhập</a>
                        </div>
                    <?php endif ?>
                </div>
                <div class="header-nav-right header-nav-right-tablet text-light gap-3">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalSearch" style="background-color: transparent; outline:none;" class="border-0 text-light"><i class="hover-maincl fa-solid fa-magnifying-glass"></i></button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalNav" style="background-color: transparent; outline: none;" class="border-0 text-light"><i class="hover-maincl fa-solid fa-bars"></i></button>
                </div>
            </nav>
            <nav class="nav-search justify-content-between" style="background-color: rgba(0,0,0,0.3); border-radius: 30px;">
                <ul class="nav ps-4">
                    <li class="nav-item">
                        <a class="nav-link text-light hover-maincl" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light hover-maincl" href="<?= route('IntroduceRoute') ?>">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light hover-maincl" href="<?= route('ProductRoute'); ?>">Sản phẩm 
                            <i class="fa-solid fa-angle-down"></i>
                            <i class="fa-solid fa-angle-up"></i>
                        </a>
                        <ul class="sub-nav bg-light px-4" id="subnav-product">
                            <div class="row">
                                <div class="col">
                                    <h6 class="py-1">
                                        <a class="hover-maincl" style="font-weight: 700; font-size: 24px; font-family: 'Oswald'" 
                                        href="<?= route('ProductCategoryRoute', ['catSlug' => 'san-pham-moi-nhat']); ?>">
                                            Sản phẩm mới nhất
                                        </a>
                                    </h6>
                                    <li class="py-1">
                                        <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'chay-bo']); ?>">
                                            Giày chạy bộ
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'giay-the-thao']); ?>">
                                            Giày thể thao
                                        </a>
                                    </li>
                                </div>

                                <div class="col">
                                    <h6 class="py-1">
                                        <a class="hover-maincl" style="font-weight: 700; font-size: 24px; font-family: 'Oswald'" 
                                            href="<?= route('ProductCategoryRoute', ['catSlug' => 'san-pham-noi-bat']); ?>"
                                        >
                                            Sản phẩm nổi bật
                                        </a>
                                    </h6>
                                    <li class="py-1">
                                        <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'nam']); ?>">Giày cho nam</a>
                                    </li>
                                    <li class="py-1">
                                        <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'nu']); ?>">Giày cho nữ</a>
                                    </li>
                                </div>

                                <div class="col">
                                    <h6 class="py-1">
                                        <a class="hover-maincl" style="font-weight: 700; font-size: 24px; font-family: 'Oswald'" 
                                            href="<?= route('ProductCategoryRoute', ['catSlug' => 'san-pham-ban-chay']); ?>"
                                        >
                                            Sản phẩm bán chạy
                                        </a>
                                    </h6>
                                    <li class="py-1">
                                        <a href="<?= route('ProductBrandRoute', ['brandSlug' => 'nike']); ?>">Nike</a>
                                    </li>
                                    <li class="py-1">
                                        <a href="<?= route('ProductBrandRoute', ['brandSlug' => 'adidas']); ?>">Adidas</a>
                                    </li>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <a href="<?= route('ProductBrandRoute', ['brandSlug' => 'nike-air']); ?>">
                                        <img width="100%" src="<?= public_dir('/img/mega-menu-images1.webp')?>" 
                                            alt="mega-brand-nike-air">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="<?= route('ProductBrandRoute', ['brandSlug' => 'nike-air']); ?>">
                                        <img width="100%" src="<?= public_dir('/img/mega-menu-images2.webp')?>" 
                                            alt="mega-brand-air-max">
                                    </a>
                                </div>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light hover-maincl" href="<?= route('NewsRoute') ?>">Tin tức 
                            <i class="fa-solid fa-angle-down"></i>
                            <i class="fa-solid fa-angle-up"></i>
                        </a>
                        <ul class="sub-nav bg-light" id="subnav-news">
                            <div class="row">
                                <?php $headerNewsList = NewsController::getNewsShortInfo(); 
                                    foreach($headerNewsList as $newsItem) :
                                ?>
                                <div class="col-6">
                                    <a href="<?= route('NewsDetailsRoute', ['newsSlug' => htmlspecialchars($newsItem['newsSlug'])]); ?>">
                                        <h6 class="hover-maincl" style="font-weight: 700; font-size: 16px; font-family: 'Oswald'" >
                                            <?= htmlspecialchars($newsItem['title']); ?>
                                        </h6>
                                        <small><?= htmlspecialchars(formatDateTime($newsItem['createAt'])); ?></small>
                                        <p>
                                            <?= htmlspecialchars($newsItem['excerpt']); ?>
                                        </p>
                                        <img src="/<?= htmlspecialchars($newsItem['thumbnail']); ?>" width="70%" 
                                            alt="<?= htmlspecialchars($newsItem['title']); ?>">
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light hover-maincl" href="<?= route('ContactRoute') ?>">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light hover-maincl" href="<?= route('StoreSystemRoute') ?>">Hệ thống cửa hàng</a>
                    </li>
                </ul>
                <button data-bs-toggle="modal" data-bs-target="#modalSearch" class="btn btn-search text-light hover-maincl">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </nav>
            
        </div>
    </header>
    <div class="modal fade" id="modalNav" tabindex="-1" aria-labelledby="modalNavLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header">
                    <a href="/">
                        <img style="max-width: 80px" height="30" src="<?=public_dir('/img/logo-shoes-white.png')?>" alt="logo">
                    </a>
                    <button type="button" class="btn-close" style="filter: brightness(0) invert(1);" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="/" class="nav-link text-dark hover-maincl">Trang chủ</a></li>
                        <li class="nav-item">
                            <a href="<?= route('IntroduceRoute'); ?>" class="nav-link text-dark hover-maincl">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="<?= route('ProductRoute'); ?>" 
                                    class="nav-link text-dark hover-maincl" style="font-weight: 700; font-family: 'Oswald';">
                                    Sản phẩm
                                </a>
                                <span class="pe-2 hover-maincl show-subnav">
                                    <i style="font-size: 15px;" class="fa-solid fa-angle-up"></i>
                                    <i style="font-size: 15px;" class="fa-solid fa-angle-down hide"></i>
                                </span>
                            </div>
                            <ul class="sub-nav bg-light">
                                <h6 class="py-1">
                                    <a class="hover-maincl" style="font-weight: 700; font-size: 16px; font-family: 'Oswald'" 
                                        href="<?= route('ProductCategoryRoute', ['catSlug' => 'san-pham-moi-nhat']); ?>">
                                        Sản phẩm mới nhất
                                    </a>
                                </h6>
                                <li class="py-1">
                                    <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'chay-bo']); ?>">
                                        Giày chạy bộ
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'giay-the-thao']); ?>">Giày thể thao</a>
                                </li>

                                <h6 class="py-1">
                                    <a class="hover-maincl" style="font-weight: 700; font-size: 16px; font-family: 'Oswald'" 
                                        href="<?= route('ProductCategoryRoute', ['catSlug' => 'san-pham-noi-bat']); ?>">
                                        Sản phẩm nổi bật
                                    </a>
                                </h6>
                                <li class="py-1">
                                    <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'nam']); ?>">
                                        Giày cho nam
                                    </a>
                                </li>
                                <li class="py-1">
                                    <a href="<?= route('ProductCategoryRoute', ['catSlug' => 'nu']); ?>">
                                        Giày cho nữ
                                    </a>
                                </li>

                                <h6 class="py-1">
                                    <a class="hover-maincl" style="font-weight: 700; font-size: 16px; font-family: 'Oswald'" 
                                        href="<?= route('ProductCategoryRoute', ['catSlug' => 'san-pham-ban-chay']); ?>">
                                        Sản phẩm bán chạy
                                    </a>
                                </h6>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="<?= route('NewsRoute') ?>" class="nav-link text-dark hover-maincl" style="font-weight: 700; font-family: 'Oswald';">Tin tức</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="<?= route('ContactRoute'); ?>" class="nav-link text-dark hover-maincl">Liên hệ</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= route('StoreSystemRoute'); ?>" class="nav-link text-dark hover-maincl">Hệ thống cửa hàng</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= route('LoginRoute'); ?>" class="nav-link text-dark hover-maincl">Tài khoản</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSearch" tabindex="-1" aria-labelledby="modalSearchLabel" aria-hidden="true">
        <div class="modal-dialog m-0">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="search-container">
                        <input type="text" id="search-input" placeholder="Tìm kiếm sản phẩm...">
                        <button class="btn hover-maincl p-0"><i class="fa-solid fa-magnifying-glass"></i></button>
                        <!-- Container chứa kết quả tìm kiếm -->
                        <div id="search-results" class="search-results"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

