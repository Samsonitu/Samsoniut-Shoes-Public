<?php
    $Title = "Sản Phẩm Yêu Thích | Samsonitu Shoes";
    $extraJS = [public_dir('js/UserJs/wishListPro.js')];
    require_once __DIR__ . "/../../UserLayouts/HeaderView.php";
?>
<main>
    <div class="container-lg">
        <?php if(!empty($wishListProList)) : ?>
        <div class="product-list" style="padding: 30px 0;">
            <?php foreach($wishListProList as $key => $wishListProItem): 
                $firstColor = reset($wishListProItem['colors']);
            ?>
                <div class="product-item">
                    <form action="<?= route('RemoveProVarWishListRoute'); ?>" method="post">
                        <input type="hidden" name="proId" value="<?= $key; ?>">
                        <button type="submit" class="btn p-0 wish-list"
                            name="SubmitRemoveProVarWishList" value="SubmitRemove">
                            <i class="fa-solid fa-heart-circle-xmark"></i>
                        </button>
                    </form>
                    <div class="product-thumbnail">
                        <span class="sale-flash"><?= $firstColor['discount']; ?>%</span>
                        <?php foreach($wishListProItem['categories'] as $category) {
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
                        ['proSlug' => htmlspecialchars($wishListProItem['proSlug'])]); ?>">
                            <img class="product-item-image" style="max-width: 100%; max-height: 100%;" 
                            src="<?= htmlspecialchars($firstColor['image']); ?>" alt="">
                        </a>
                    </div>
                    <div class="product-info">
                        <p class="text-center mb-0 text-secondary">
                            <small class="product-brand" data-brand-id="<?= $wishListProItem['brandId'] ?>">
                                <?= htmlspecialchars($wishListProItem['brandName']) ?>
                            </small>
                        </p>
                        <div class="d-flex gap-2 my-2">
                            <?php $index = 0; foreach ($wishListProItem['colors'] as $color): ?>
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
                                ['proSlug' => htmlspecialchars($wishListProItem['proSlug'])]); ?>"
                                class="hover-maincl text-decoration-none">
                                <?= $wishListProItem['proName'] ?>
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
        <?php else: ?>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 300px;">
            <h3>Chưa có sản phẩm nào trong mục yêu thích</h3>
        </div>
        <?php endif; ?>
    </div>
</main>
<?php
    require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>