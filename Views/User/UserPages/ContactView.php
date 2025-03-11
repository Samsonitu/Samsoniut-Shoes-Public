<?php
    $Title = "Liên Hệ Với Chúng Tôi | Samsonitu Shoes";
    require_once __DIR__ . "/../UserLayouts/HeaderView.php";
?>
    <main>
        <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
            <div class="breadcrump-container text-center">
                <div class="title-section">
                    <h2 style="margin-bottom: 25px;">Liên hệ</h2>
                    <ul class="breadcrump p-0">
                        <li>
                            <a href="/" class="hover-maincl">Trang chủ</a>
                            <i class="fa-solid fa-caret-right"></i>
                        </li>
                        <li><span>Liên hệ</span></li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="container" style="color: #555;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9121183120956!2d105.8136892142367!3d21.03620208599428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab12f62fd79f%3A0x7a34e9dcf1a11eb6!2zVOG6p25nIDE2LCAyNjYgxJDhu5lpIEPhuqVuLCBMaeG7hXUgR2lhaSwgQmEgxJDDrG5oLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1538151627956" width="100%" height="350px" style="border:0" allowfullscreen=""></iframe>
            <div class="row py-4">
                <div class="col-md-4 col-sm-12">
                    <h4 style="font-weight: 700; font-size: 1.14286em;">Liên hệ</h4>
                    <p>Địa chỉ: Ladeco Building, 266 Doi Can Street, Ba Dinh District, Ha Noi
                    <a href="tel:+84332601835" style="font-weight: 700; font-size: 16px; text-decoration: none;">GỌI NGAY: <b style="color: var(--maincolor)">19006750</b></a>
                    Email: samsonitu0305@gamil.com</p>
                </div>
                <div class="col-md-8 col-sm-12">
                    <h4 style="font-weight: 700; font-size: 1.14286em;">Gửi tin nhắn cho chúng tôi</h4>
                    <form action="<?= route('SendMessageRoute'); ?>" method="post" style="font-family: Oswald;">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 mb-3">
                                <input type="text" name="fullName" class="d-block p-2 w-100" style="font-family: Oswald;" 
                                    placeholder="Họ tên*">
                            </div>
                            <div class="col-xl-6 col-lg-12 mb-3">
                                <input type="email" name="email" class="d-block p-2 w-100" style="font-family: Oswald;"                    
                                    placeholder="Email*">
                            </div>
                        </div>
                        <input type="tel" name="phone" class="d-block p-2 w-100 mb-3" placeholder="Điện thoại*">
                        <textarea name="message" class="w-100 p-2" placeholder="Nhập nội dung*" rows="6" maxlength="500"></textarea>
                        <input type="submit" style="font-weight: 400; font-family: Oswald; font-size: 14px;" value="Gửi liên hệ"    
                            name="SubmitSendMessage" class="btn bg-maincl text-light px-5 py-2">
                    </form>
                </div>
            </div>
        </div> 
    </main>
<?php
    require_once __DIR__ . "/../UserLayouts/FooterView.php";
?>
