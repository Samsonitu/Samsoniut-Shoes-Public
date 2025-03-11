<?php 
    $Title = "Giỏ Hàng Của Bạn | Samsonitu Shoes";
    $extraCSS = [public_dir('css/UserCss/cart.css')];
    $extraJS = [public_dir('js/UserJs/cart.js')];
    require_once __DIR__ . "/../../UserLayouts/HeaderView.php"; 
?>
<main>
    <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
        <div class="breadcrump-container text-center">
            <div class="title-section">
                <h2 style="margin-bottom: 25px;">Giỏ hàng</h2>
                <ul class="breadcrump p-0">
                    <li>
                        <a href="/" class="hover-maincl">Trang chủ</a>
                        <i class="fa-solid fa-caret-right"></i>
                    </li>
                    <li><a href="<?= route('CartRoute'); ?>">Giỏ hàng</a></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="cart">
        <div class="cart__container">
            <div class="cart__row">
                <div class="cart__column">
                    <?php if(!empty($orderPendingForPayList)) : ?>
                        <div class="cart__header">
                            <div class="cart__header-checkbox"><input type="checkbox" id="select-all"></div>
                            <div class="cart__header-product">Sản phẩm</div>
                            <div class="cart__header-price text-center text-center">Đơn Giá</div>
                            <div class="cart__header-quantity text-center">Số lượng</div>
                            <div class="cart__header-total text-center">Thành tiền</div>
                        </div>
                        <div class="cart__body">
                            <?php foreach($orderPendingForPayList as $orderPendingForPayItem): ?>
                                <div class="cart__item">
                                    <div class="cart__item-checkbox">
                                        <input type="checkbox" name="checkBoxOrderCode"
                                            value="<?= $orderPendingForPayItem['orderCode']?>">
                                    </div>
                                    <div class="cart__item-product">
                                        <img class="cart__item-image" 
                                            src="/<?= $orderPendingForPayItem['image']?>" 
                                            alt="<?= $orderPendingForPayItem['proName']; ?>">
                                        <div class="cart__item-details">
                                            <p class="cart__item-name">
                                                <?= $orderPendingForPayItem['proName']; ?>
                                            </p>
                                            <p class="cart__item-variant">
                                                <?= $orderPendingForPayItem['colorName']; ?> 
                                                / 
                                                <?= $orderPendingForPayItem['size']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="cart__item-price">
                                        <span class="cart__item-price-discounted"
                                            data-price-discounted="<?= $orderPendingForPayItem['price'] 
                                            * (100 - $orderPendingForPayItem['discount']) / 100; ?>"
                                        >
                                            <?= formatPrice($orderPendingForPayItem['price'] 
                                            * (100 - $orderPendingForPayItem['discount']) / 100); ?>₫
                                        </span>
                                        <span class="cart__item-price-original">
                                            <?= formatPrice($orderPendingForPayItem['price']); ?>đ
                                        </span>
                                    </div> 
                                    <div class="cart__item-quantity">
                                        <form action="<?= route('UpdateOrderQuantityRoute'); ?>" method="post" class="cart__item-quantity-form">
                                            <input type="hidden" name="orderCodeUpdate" value="<?= $orderPendingForPayItem['orderCode']; ?>">
                                            <input class="cart__item-quantity-input" name="orderQuantityUpdate" type="number" min="1"
                                                value="<?= $orderPendingForPayItem['orderQuantity']; ?>">
                                            <button type="submit" class="btn btn-sm btn-primary cart__update-btn"
                                                name="SubmitUpdateOrderQuantity"
                                                value="SubmitUpdate" 
                                                data-bs-toggle="tooltip" title="Cập nhật số lượng">
                                                <i class="fa-solid fa-rotate"></i>
                                            </button>
                                        </form>
                                        <form action="<?= route('RemoveOrderRoute'); ?>" method="post">
                                            <input type="hidden" name="orderCodeDelete" value="<?= $orderPendingForPayItem['orderCode']; ?>">
                                            <button type="submit" name="SubmitRemoveOrder" 
                                                value="SubmitRemove"
                                                class="btn btn-sm btn-danger cart__delete-btn"
                                                data-bs-toggle="tooltip" title="Xóa đơn hàng">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="cart__item-total"
                                        data-item-total="<?= $orderPendingForPayItem['price'] 
                                        * (100 - $orderPendingForPayItem['discount']) / 100
                                        * $orderPendingForPayItem['orderQuantity']; ?>"
                                    >
                                        <?= formatPrice(($orderPendingForPayItem['price'] 
                                        * (100 - $orderPendingForPayItem['discount']) / 100)
                                        * $orderPendingForPayItem['orderQuantity']); ?> ₫
                                    </div>
                                </div>
                            <?php 
                                endforeach; 
                            ?>
                        </div>
                        <form action="<?= route('OrderNormalRoute'); ?>" method="post" class="cart__footer">
                            <div id="orderCodesContainer"></div>
                            <div class="cart__footer-left">
                                <button type="button" id="delete-selected">
                                    <span>Xóa mục đã chọn</span>
                                    <b id="totalCheckBoxOrderCode">()</b>
                                </button>
                            </div>
                            <div class="cart__footer-right">
                                <p class="cart__summary-shipping">Phí giao hàng: <b>40.000₫</b></p>
                                <p class="cart__summary-total">
                                    <span>
                                        Tổng thanh toán (
                                            <b id="total-items">
                                            </b> 
                                        sản phẩm): 
                                    </span>
                                    <span id="totalPriceOrder" class="cart__summary-price">
                                    </span>
                                </p>
                                <input type="submit" class="cart__submit-btn" value="Đặt hàng" name="SubmitOrderNormal">
                            </div>
                        </form>
                    <?php else : ?>
                        <div class="text-center">
                            <h3>Không Có Sản Phẩm Nào Trong Giỏ Hàng Của Bạn</h3>
                            <img src="<?= public_dir('img/no_cart.png'); ?>" alt="khong-co-san-pham-nao"><br>
                            <a class="btn btn-lg text-white" style="background-color: var(--maincolor);"
                                href="<?= route('ProductRoute'); ?>">
                                Mua Ngay
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
    require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>