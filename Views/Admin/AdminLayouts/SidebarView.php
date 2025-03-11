<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?? 'Bảng Điều Khiển - SSNT SHOES'; ?></title>
    <link rel="shortcut icon" href="<?= public_dir('/img/logo-shoes-white.png'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= public_dir('/css/AdminCss/style.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= public_dir('/font/fontawesome-free-6.4.2-web/css/all.min.css') ?>">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= public_dir('css/Button.css') ?>">
    <link rel="stylesheet" href="<?= public_dir('css/ToastMessage.css') ?>">

    <?php
        if (!empty($extraCSS)) {
            foreach ($extraCSS as $css) {
                echo '<link rel="stylesheet" href="' . $css . '">';
            }
        }

        $navPages = [
            [
                'navItem' => 'Bảng Điều Khiển',
                'navUrl' => route('AdminRoute'),
                'subNavItems' => [],
                'navIcon' => '<i class="fa-solid fa-gauge sidebar__nav-icon"></i>'
            ],
            [
                'navItem' => 'Sản Phẩm',
                'navUrl' => route('AdminProductRoute'),
                'subNavItems' => [
                    [
                        'subNavItem' => 'Quản Lý Sản Phẩm',
                        'subNavUrl' => route('AdminProductRoute'),
                        'navIcon' => ''
                    ],
                    [
                        'subNavItem' => 'Danh Mục Sản Phẩm',
                        'subNavUrl' => route('AdminProductCategoryRoute'),
                        'navIcon' => ''
                    ],
                    [
                        'subNavItem' => 'Nhà Cung Cấp',
                        'subNavUrl' => route('AdminProductSupplierRoute'),
                        'navIcon' => ''
                    ],
                    [
                        'subNavItem' => 'Thương Hiệu',
                        'subNavUrl' => route('AdminProductBrandRoute'),
                        'navIcon' => ''
                    ],
                ],
                'navIcon' => '<i class="fa-brands fa-product-hunt sidebar__nav-icon"></i>'
            ],
            [
                'navItem' => 'Đơn Hàng',
                'navUrl' => route('AdminOrderRoute'),
                'subNavItems' => [],
                'navIcon' => '<i class="fa-solid fa-cart-shopping sidebar__nav-icon"></i>'
            ],
            [
                'navItem' => 'Tin Tức',
                'navUrl' => route('AdminNewsRoute'),
                'subNavItems' => [
                    [
                        'subNavItem' => 'Quản Lý Tin Tức',
                        'subNavUrl' => route('AdminNewsRoute'),
                        'navIcon' => ''
                    ],
                    [
                        'subNavItem' => 'Danh Mục Tin Tức',
                        'subNavUrl' => route('AdminNewsCategoryRoute'),
                        'navIcon' => ''
                    ],
                ],
                'navIcon' => '<i class="fa-solid fa-newspaper sidebar__nav-icon"></i>'
            ],
            [
                'navItem' => 'Tài Khoản',
                'navUrl' => route('AdminAccountRoute'),
                'subNavItems' => [],
                'navIcon' => '<i class="fa-regular fa-id-card sidebar__nav-icon"></i>'
            ]
        ]
	?>
</head>
<body>
    <div class="container-fluid px-0"> 
        <!-- Sidebar -->
        <input type="checkbox" id="sidebar-toggle">
        <aside>
            <div class="sidebar__logo">
                <img src="<?= public_dir('/img/logo-shoes-white.png') ?>" alt="Logo SSNT SHOES" width="55px" height="55px">
                <h6 class="mb-0 text-white">Samsonitu Shoes</h6>
            </div>
            <ul class="sidebar__nav p-0">
                <?php for($i = 0; $i < count($navPages); $i++) : ?>
                    <li>
                        <a href="<?= $navPages[$i]['navUrl']; ?>" 
                            class="sidebar__nav-item
                            <?php 
                                if($navPages[$i]['navUrl'] == $activePage['navItem']) 
                                    echo 'sidebar__nav-item--active'?>
                            "
                        >
                            <span>
                                <?= $navPages[$i]['navIcon'];?>
                                <?= $navPages[$i]['navItem']; ?>
                            </span>
                            <?php if(count($navPages[$i]['subNavItems']) > 0) 
                            echo '
                                <button class="btn btn-dropdown-subnav py-0"><i class="fa-solid fa-angle-right"></i></button>
                            '?>
                        </a>
                        <?php if(count($navPages[$i]['subNavItems']) > 0): ?>
                        <ul class="sidebar__subnav">
                            <?php for($j = 0; $j < count($navPages[$i]['subNavItems']); $j++) : ?>
                                <li>
                                    <a href="<?= $navPages[$i]['subNavItems'][$j]['subNavUrl']?>" 
                                        class="sidebar__subnav-item 
                                        <?php 
                                            if(isset($activePage['subNavItem']) && 
                                            $navPages[$i]['subNavItems'][$j]['subNavUrl'] == $activePage['subNavItem']) 
                                            echo 'sidebar__subnav-item--active'?>
                                        "
                                    >
                                        <span>
                                            <?= $navPages[$i]['subNavItems'][$j]['navIcon'];?>
                                            <?= $navPages[$i]['subNavItems'][$j]['subNavItem']?>
                                        </span>
                                    </a>
                                </li>
                            <?php endfor;?>
                        </ul>  
                        <?php endif;?>
                    </li>
                <?php endfor;?>
            </ul>
        </aside>
