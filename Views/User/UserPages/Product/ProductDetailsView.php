<?php
    $Title = "Sản Phẩm " . $productDetailsInfo["proName"] . " | Samsonitu Shoes";
    $extraCSS = [public_dir('/css/UserCss/productDetails.css')];
    $extraJS = [public_dir('js/UserJs/productDetails.js')];
    require_once __DIR__ . "/../../UserLayouts/HeaderView.php";
?>
<main>
    <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
        <div class="breadcrump-container text-center">
            <div class="title-section">
                <h2 style="margin-bottom: 25px;"><?= htmlspecialchars($productDetailsInfo['proName']) ?></h2>
                <ul class="breadcrump p-0">
                    <li>
                        <a href="/" class="hover-maincl">Trang chủ</a>
                        <i class="fa-solid fa-caret-right"></i>
                    </li>
                    <li>
                        <a href="
                            <?= route('ProductDetailsRoute', ['proSlug' => htmlspecialchars($productDetailsInfo['proSlug'])]); ?>" class="hover-maincl text-dark"
                        >
                            <?= htmlspecialchars($productDetailsInfo['proName']) ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section-product-details">
        <div class="container-md">
            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <div class="product-details product-item" data-pro-id="<?= $productDetailsInfo['proId']; ?>">
                        <?php  
                            $firstColor = $productDetailsInfo['colors'][array_key_first($productDetailsInfo['colors'])];
                            $firstSize = $firstColor['sizes'][array_key_first($firstColor['sizes'])];
                        ?>
                        <div class="product-wrap-imgs">
                            <div class="main-product-img">
                                <button class="btn p-0 wish-list"><i class="fa-regular fa-heart"></i></button>
                                <img class="w-100" 
                                    src="/<?= htmlspecialchars($firstColor['image']); ?>" 
                                    alt="<?= htmlspecialchars($productDetailsInfo['proName']) . " Màu " . htmlspecialchars($firstColor['colorName']) ?> "
                                >
                            </div>
                            <div class="list-product-img">
                                <?php $index = 0; ?>
                                <?php foreach($productDetailsInfo['colors'] as $color => $value): ?>
                                    <img src="/<?= htmlspecialchars($value['image']); ?>" 
                                        class="w-25 py-1 <?= $index === 0 ? 'active' : ''; ?>" 
                                        alt="<?= htmlspecialchars($productDetailsInfo['proName']) . ' Màu ' . htmlspecialchars($value['colorName']); ?>"
                                        data-color-code="<?= htmlspecialchars($color); ?>"
                                        data-sizes="<?= htmlspecialchars(json_encode([...$value['sizes']])); ?>"
                                        data-price="">
                                    <?php $index++; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="product-wrap-info">
                            <h1 style="font-size: 26px;"></h1>
                            <p>
                                Thương hiệu: 
                                <span class="brand-name" style="color: var(--maincolor);">
                                    <?= htmlspecialchars($productDetailsInfo['brandName']); ?>
                                </span> 
                                Tình trạng: 
                                <span class="status" data-in-stock = <?= $firstSize['quantity']; ?>
                                    style="color: <?= $firstSize['quantity'] >= 1 ? 'var(--maincolor)' : 'red' ?>">
                                    <?= $hasInStock = $firstSize['quantity'] >= 1 ? 'Còn Hàng' : 'Hết Hàng' ?>
                                </span> 
                            </p>
                            <div class="sizes">
                                <span>Kích cỡ:</span>
                                <div class="list-size">
                                    <?php $index = 0; foreach($firstColor['sizes'] as $key => $value) : ?>
                                        <button 
                                            data-size="<?= htmlspecialchars(json_encode($value)) ?>"
                                            class="btn border border-1 btn-default btn-sm
                                                <?= $index === 0 ? 'active' : ''; ?>
                                            ">
                                            <?= $key; ?>
                                        </button>
                                    <?php $index++; endforeach; ?>
                                </div>
                            </div>
                            <p class="price">
                                <span class="product-price-discounted">
                                    <?= formatPrice($firstSize['price'] * (100 - $firstSize['discount']) / 100) ?>đ
                                </span>
                                <sup>
                                    <strike class="product-price-old"><?= formatPrice($firstSize['price']); ?>đ</strike>
                                </sup>
                            </p>
                            <div class="list-product-color">
                                <span>Màu sắc</span>
                            </div>
                            <div class="d-flex gap-2 py-2 color-buttons">
                                <?php $index = 0; foreach($productDetailsInfo['colors'] as $key => $value) : ?>
                                <div class="circle-product-color <?= $index === 0 ? 'active' : '' ?>" 
                                    data-color-code="<?= $key; ?>"
                                    data-image="<?= htmlspecialchars($value['image']); ?>"
                                    data-sizes="<?= htmlspecialchars(json_encode([...$value['sizes']])); ?>"
                                    style="background-color: <?= $key ?>;">
                                </div>
                                <?php $index++; endforeach; ?>
                            </div>
                           
                            <form action="<?= route('OrderFastRoute')?>" method="post" class="d-flex align-items-center" id="form-order">
                                <input type="hidden" name="orderProId" value="<?= htmlspecialchars($productDetailsInfo['proId']); ?>">
                                <input type="hidden" name="orderColorCode" value="<?= htmlspecialchars(array_key_first($productDetailsInfo['colors']) ?? ''); ?>">
                                <input type="hidden" name="orderSize" value="<?= htmlspecialchars(array_key_first($firstColor['sizes']) ?? ''); ?>">
                                <button type="button" id="btn-minus"><i class="fa-solid fa-minus"></i></button>
                                    <input id="orderQuantity" name="orderQuantity" type="text" value="1" min="1">
                                <button type="button" id="btn-plus"><i class="fa-solid fa-plus"></i></button>
                                <button type="button" class="btn ms-2" id="btn-add-to-cart"
                                    style="border-radius: 0; background-color:rgba(75, 217, 99, 0.32); 
                                        padding-top: 8px; padding-bottom: 8px;">
                                    Thêm Vào Giỏ Hàng
                                </button>
                                <input type="submit" 
                                    <?= $firstSize['quantity'] <= 1 ? 'disabled' : ''; ?>
                                    name="SubmitOrderFast" value="Mua Ngay" 
                                    class="btn ms-2 bg-maincl" style="border-radius: 0;"
                                />
                            </form>
                        </div>
                    </div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mt-4">
                        <li class="nav-item">
                            <a class="nav-link active ms-0" data-bs-toggle="tab" href="#article-prd-info">Thông tin sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#article-prd-policy">Chính sách đổi trả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#article-prd-evaluate">Đánh giá sản phẩm</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active" id="article-prd-info">
                            <p class="mt-2"><?= htmlspecialchars($productDetailsInfo['productDescription']); ?></p>
                        </div>
                        <div class="tab-pane container fade" id="article-prd-policy">
                            + Sản phẩm lỗi, hỏng do quá trình sản xuất hoặc vận chuyện
                            <br>+ Nằm trong chính sách đổi trả sản phẩm của Bean
                            <br>+ Sản phẩm còn nguyên tem mác không bị rớt vỡ, vô nước
                            <br>+ Thời gian đổi trả nhỏ hơn 15 ngày kể từ ngày nhận hàng
                            <br>+ Chi phí bảo hành về sản phẩm, vận chuyển khách hàng chịu chi phí
                            <br><b>Điều kiện đổi trả hàng</b>
                            <br>Điều kiện về thời gian đổi trả: trong vòng 07 ngày kể từ khi nhận được hàng và phải liên hệ gọi ngay cho chúng tôi theo số điện thoại trên để được xác nhận đổi trả hàng.
                            <br><b>Điều kiện đổi trả hàng:</b>
                            <br>- Sản phẩm gửi lại phải còn nguyên đai nguyên kiện
                            <br>- Phiếu bảo hành (nếu có) và tem của công ty trên sản phẩm còn nguyên vẹn.
                            <br>- Sản phẩm đổi/ trả phải còn đầy đủ hộp, giấy hướng dẫn sử dụng và không bị trầy xước, bể.
                            <br>- Quý khách chịu chi phí vận chuyển, đóng gói, thu hộ tiền, chi phí liên lạc tối đa tương đương 10% giá trị đơn hàng.
                        </div>
                        <div class="tab-pane container fade text-center py-1" id="article-prd-evaluate">
                            <div class="py-4" style="background-color: #F2F8EA;">
                                <p>Hiện tại sản phẩm chưa có đánh giá nào, bạn hãy trở thành người đầu tiên đánh giá cho sản phẩm này</p>
                                <button class="btn bg-maincl">Gửi đánh giá của bạn</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <div class="aside-banner">
                        <img width="100%" src="<?=public_dir('/img/aside_banner2.webp')?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(!empty($productSuggestionList)) : ?>
    <section class="section-product-suggestion">
        <div class="container-md">
            <h2 class="text-center">SẢN PHẨM CÓ THỂ BẠN SẼ THÍCH</h2>
            <div class="list-product-suggestion">
                <?php foreach($productSuggestionList as $key => $productSuggestionItem) : 
                    $firstColor = reset($productSuggestionItem['colors']);
                ?>
                    <div class="product-item" data-pro-id="<?= $key; ?>">
                        <button class="btn p-0 wish-list"><i class="fa-regular fa-heart"></i></button>
                        <div class="product-thumbnail">
                            <span class="sale-flash"><?= $firstColor['discount']; ?>%</span>
                            <?php foreach($productSuggestionItem['categories'] as $category) {
                                if($category === 'Sản phẩm mới nhất') {
                                    echo '<span class="tag-km">
                                        <img width="20px" height="20px" 
                                        src="'.public_dir('/img/title_image_1_tag.webp').'" alt="">
                                    </span>';
                                    break;
                                }elseif($category === 'Sản phẩm nổi bật' || $category === 'Sản phẩm bán chạy') {
                                    echo '<span class="tag-km">Hot</span>';
                                    break;
                                }
                            } ?>
                            <a href="<?= route('ProductDetailsRoute', 
                            ['proSlug' => htmlspecialchars($productSuggestionItem['proSlug'])]); ?>">
                                <img class="product-item-image" style="max-width: 100%; max-height: 100%;" 
                                src="/<?= htmlspecialchars($firstColor['image']); ?>" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <p class="text-center mb-0 text-secondary">
                                <small class="product-brand" data-brand-id="<?= $productSuggestionItem['brandId'] ?>">
                                    <?= htmlspecialchars($productSuggestionItem['brandName']) ?>
                                </small>
                            </p>
                            <div class="d-flex gap-2 my-2">
                                <?php $index = 0; foreach ($productSuggestionItem['colors'] as $color): ?>
                                    <div class="circle-product-color <?= $index === 0 ? 'active' : '' ?>" 
                                        data-variant-color-code="<?= htmlspecialchars($color['colorCode']) ?>"
                                        data-variant-image="<?= htmlspecialchars($color['image']) ?>"
                                        data-variant-discount="<?= htmlspecialchars($color['discount']) ?>"
                                        data-variant-price="<?= htmlspecialchars($color['price']) ?>"
                                        data-variant-gender="<?= htmlspecialchars($color['gender']); ?>"
                                        style="background-color: <?= htmlspecialchars($color['colorCode']) ?>;">
                                    </div>
                                <?php $index++; endforeach; ?>
                            </div>
                            <h3 class="product-name">
                                    <a href="<?= route('ProductDetailsRoute', 
                                    ['proSlug' => htmlspecialchars($productSuggestionItem['proSlug'])]); ?>"
                                    class="hover-maincl text-decoration-none">
                                    <?= $productSuggestionItem['proName'] ?>
                                </a>
                            </h3>
                            <span class="product-price" style="font-size: 14px;">
                                <b>
                                    <span class="product-price-discounted"
                                        data-price-discounted="<?= 
                                        ($firstColor['price'] * (100 - $firstColor['discount']) / 100); ?>"
                                    >
                                        <?= formatPrice($firstColor['price'] * (100 - $firstColor['discount']) / 100); ?> ₫ 
                                    </span>
                                    <sup>
                                        <strike class="product-price-old" style="color: #b0b0b0;">
                                            <?= formatPrice($firstColor['price']); ?> ₫
                                        </strike>
                                    </sup>
                                </b>
                            </span>
                        </div>
                        <br>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>
<?php
    require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>