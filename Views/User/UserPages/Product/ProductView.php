<?php
    $extraJS = [public_dir('/js/UserJs/product.js')];
    require_once __DIR__ . "/../../UserLayouts/HeaderView.php";
?>
<main>
    <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
        <div class="breadcrump-container text-center">
            <div class="title-section">
                <h2 style="margin-bottom: 25px;">Tất cả sản phẩm</h2>
                <ul class="breadcrump p-0">
                    <li>
                        <a href="" class="hover-maincl">Trang chủ</a>
                        <i class="fa-solid fa-caret-right"></i>
                    </li>
                    <li><span>Tất cả sản phẩm</span></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section-product">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12 col-lg-3">
                    <div class="aside-list">
                        <div class="aside-item w-100">
                            <div class="aside-header">Bộ lọc</div>
                            <div class="aside-body">
                                <h6 class="mb-2">Giá sản phẩm</h6>
                                <ul class="mb-4" id="price-filter" style="max-height: 140px; overflow-y: auto;">
                                    <li class="d-flex gap-2 py-2">
                                        <input type="radio" name="rangePrice" checked>
                                        <span>Tất cả giá</span>
                                    </li>
                                    <li class="d-flex gap-2 py-2">
                                        <input type="radio" name="rangePrice" data-max="999999">
                                        <span>Giá dưới 1.000.000đ</span>
                                    </li>
                                    <li class="d-flex gap-2 py-2">
                                        <input type="radio" name="rangePrice" data-min="1000000" data-max="2000000">
                                        <span>1.000.000đ - 2.000.000đ</span>
                                    </li>
                                    <li class="d-flex gap-2 py-2">
                                        <input type="radio" name="rangePrice" data-min="2000001">
                                        <span>Giá trên 2.000.000đ</span>
                                    </li>
                                </ul>

                                <h6 class="mb-2">Loại</h6>
                                <ul class="mb-4" id="gender-filter" style="max-height: 140px; overflow-y: auto;">
                                    <li class="d-flex gap-2 py-2"><input type="checkbox" value="male"><span>Giày Nam</span></li>
                                    <li class="d-flex gap-2 py-2"><input type="checkbox" value="female"><span>Giày Nữ</span></li>
                                </ul>
                                <?php if(!empty($brandIdAndNameList)): ?>
                                    <h6 class="mb-2">Thương hiệu</h6>
                                    <ul class="mb-4" id="brand-filter" style="max-height: 140px; overflow-y: auto;">
                                        <?php foreach($brandIdAndNameList as $brandIdAndNameItem): ?>
                                            <li class="d-flex gap-2 py-2">
                                                <input type="checkbox" value="<?= $brandIdAndNameItem['brandId'] ?>">
                                                <span><?= $brandIdAndNameItem['brandName'] ?></span>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="aside-banner">
                            <img width="100%" src="<?=public_dir('/img/aside_banner2.webp')?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-9">
                    <div class="d-flex border border-1 p-2 mb-3 align-items-center justify-content-between">
                        <!-- Ô tìm kiếm -->
                        <div class="col-12 col-md-8 p-0">
                            <div class="input-group">
                                <input id="input-search" type="text" class="form-control" placeholder="Tìm kiếm tên sản phẩm...">
                                <button class="btn text-white" style="background-color: #03177e;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Bộ lọc sắp xếp -->
                        <div class="col-12 col-md-4 p-0 d-flex justify-content-end align-items-center" style="font-size: 14px;">
                            <label for="sort-select" class="me-2"><b>Sắp xếp:</b></label>
                            <div class="dropdown">
                                <button class="btn border dropdown-toggle" type="button" id="sort-by" data-bs-toggle="dropdown" aria-expanded="false">
                                    Mặc định
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="sort-by">
                                    <li><a class="dropdown-item sort-option" data-sort="default" href="javascript:;">Mặc định</a></li>
                                    <li><a class="dropdown-item sort-option" data-sort="az" href="javascript:;">A → Z</a></li>
                                    <li><a class="dropdown-item sort-option" data-sort="za" href="javascript:;">Z → A</a></li>
                                    <li><a class="dropdown-item sort-option" data-sort="price-asc" href="javascript:;">Giá tăng dần</a></li>
                                    <li><a class="dropdown-item sort-option" data-sort="price-desc" href="javascript:;">Giá giảm dần</a></li>
                                    <li><a class="dropdown-item sort-option" data-sort="newest" href="javascript:;">Hàng mới nhất</a></li>
                                    <li><a class="dropdown-item sort-option" data-sort="oldest" href="javascript:;">Hàng cũ nhất</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <p id="no-products" class="text-danger text-center" style="display: none;">Không tìm thấy sản phẩm nào</p>
                    <?php if(!empty($productList)): ?>
                        <div class="product-list">
                            <?php foreach($productList as $key => $productItem): 
                                $firstColor = reset($productItem['colors']);
                            ?>
                                <div class="product-item" data-pro-id=<?= $key ?>>
                                    <button class="btn p-0 wish-list"><i class="fa-regular fa-heart"></i></button>
                                    <div class="product-thumbnail">
                                        <span class="sale-flash"><?= $firstColor['discount']; ?>%</span>
                                        <?php foreach($productItem['categories'] as $category) {
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
                                        ['proSlug' => htmlspecialchars($productItem['proSlug'])]); ?>">
                                            <img class="product-item-image" style="max-width: 100%; max-height: 100%;" 
                                            src="<?= htmlspecialchars($firstColor['image']); ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <p class="text-center mb-0 text-secondary">
                                            <small class="product-brand" data-brand-id="<?= $productItem['brandId'] ?>">
                                                <?= htmlspecialchars($productItem['brandName']) ?>
                                            </small>
                                        </p>
                                        <div class="d-flex gap-2 my-2">
                                            <?php $index = 0; foreach ($productItem['colors'] as $color): ?>
                                                <div class="circle-product-color <?= $index === 0 ? 'active' : ''; ?>" 
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
                                                ['proSlug' => htmlspecialchars($productItem['proSlug'])]); ?>"
                                                class="hover-maincl text-decoration-none">
                                                <?= $productItem['proName'] ?>
                                            </a>
                                        </h3>
                                        <span class="product-price" style="font-size: 14px;">
                                            <b>
                                                <span class="product-price-discounted"
                                                    data-price-discounted="<?= 
                                                    ($firstColor['price'] * (100 - $firstColor['discount']) / 100); ?>"
                                                >
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
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
    require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>