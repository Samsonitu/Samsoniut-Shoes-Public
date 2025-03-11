<?php
    require_once __DIR__ . "/../UserLayouts/HeaderView.php";
?>

    <main>
        <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
            <div class="breadcrump-container text-center">
                <div class="title-section">
                    <h2 style="margin-bottom: 25px;">Sản phẩm yêu thích</h2>
                    <ul class="breadcrump p-0">
                        <li>
                            <a href="" class="hover-maincl">Trang chủ</a>
                            <i class="fa-solid fa-caret-right"></i>
                        </li>
                        <li><span>Sản phẩm yêu thích</span></li>
                    </ul>
                </div>
            </div>
        </section>
        
        <section class="section-wishlist">
            <div class="container-md">
                <div class="wishlist-alert">
                    Bạn chưa có sản phẩm yêu thích nào!
                </div>
            </div>
        </section>
    </main>

<?php
    require_once __DIR__ . "/../UserLayouts/FooterView.php";
?>