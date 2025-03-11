<?php
    $Title = "Hệ Thống Cửa Hàng | Samsonitu Shoes";
    require_once __DIR__ . "/../UserLayouts/HeaderView.php";
?>
    <main>
        <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
            <div class="breadcrump-container text-center">
                <div class="title-section">
                    <h2 style="margin-bottom: 25px;">Hệ thống cửa hàng</h2>
                    <ul class="breadcrump p-0">
                        <li>
                            <a href="" class="hover-maincl">Trang chủ</a>
                            <i class="fa-solid fa-caret-right"></i>
                        </li>
                        <li><span>Hệ thống của hàng</span></li>
                    </ul>
                </div>
            </div>
        </section>
        <section>
            <div class="title-section text-center py-4"> 
                <h2>Hệ thống cửa hàng</h2>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3418374821235!2d105.82557467561529!3d21.019003988112903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab786f8799f9%3A0x216d169a444caa25!2zMjUgUC4gxJDDtG5nIEPDoWMsIENo4bujIEThu6thLCDEkOG7kW5nIMSQYSwgSMOgIE7hu5lpIDEwMDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1707791351906!5m2!1svi!2s" width="100%" height="660px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
    </main>
<?php
    require_once __DIR__ . "/../UserLayouts/FooterView.php";
?>