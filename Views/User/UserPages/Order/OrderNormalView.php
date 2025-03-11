<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đặt Hàng | Samsonitu Shoes</title>
    <link rel="icon" href="<?= public_dir('/img/logo-shoes-white.png'); ?>">
    <link rel="stylesheet" href="<?= public_dir('css/UserCss/order.css'); ?>">    
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= public_dir('/font/fontawesome-free-6.4.2-web/css/all.min.css') ?>">
</head>
<body>
    <div class="checkout">
        <main class="checkout__main">
            <header class="checkout__header">
                <h3 class="checkout__logo">Samsonitu Shoes</h3>
            </header>
            
            <div class="checkout__row">
                <div class="checkout__column">
                    <h5 class="section__title">
                        <i class="fa-solid fa-id-card section__title-icon"></i> Thông tin nhận hàng
                    </h5>
                    
                    <div class="form__group">
                        <input type="text" class="form__input" id="email" 
                            value="<?= $_SESSION['userInfo'][0]['email']; ?>" disabled required>
                        <label class="form__label" for="email">Email</label>
                    </div>
                    
                    <div class="form__group">
                        <input type="text" class="form__input" id="custName" 
                            value="<?= $_SESSION['userInfo'][0]['fullName'] ?>" disabled>
                        <label class="form__label" for="custName">Họ và tên</label>
                    </div>
                    
                    <div class="form__group">
                        <input type="text" class="form__input" id="phoneNumber" 
                            value="<?= maskPhoneNumber($_SESSION['userInfo'][0]['phoneNumber']); ?>" disabled>
                        <label class="form__label" for="phoneNumber">Số điện thoại</label>
                    </div>
                    
                    <div class="form__group">
                        <textarea class="form__input form__input--textarea" id="address" disabled>
                            <?= trim($_SESSION['userInfo'][0]['address']); ?>
                        </textarea>
                        <label class="form__label" for="address">Địa chỉ</label>
                    </div>
                </div>
                
                <div class="checkout__column">
                    <h5 class="section__title">
                        <i class="fa-solid fa-truck section__title-icon"></i> Vận chuyển
                    </h5>
                    
                    <div class="shipping__option shipping__option--active">
                        <span class="shipping__indicator"></span>
                        <span>Giao hàng tận nơi</span> 
                        <span>40.000đ</span>
                    </div>

                    <h5 class="section__title">
                        <i class="fa-regular fa-credit-card section__title-icon"></i> Thanh toán
                    </h5>
                    
                    <div class="payment__options">
                        <div class="payment__option payment__option--active" data-payment="cod">
                            <span class="payment__indicator"></span>
                            <span class="payment__label">Thu hộ (COD)</span> 
                            <i class="fa-regular fa-money-bill-1 payment__icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <aside class="checkout__aside">
            <form id="orderForm" action="<?= route('HandleOrderNormalRouteRoute'); ?>" method="post">
                <h5 class="order__title">
                    Đơn hàng ( 
                        <?php 
                            $orderQuantity = 0;
                            foreach($proPendingOrderInfo as $item) {
                                $orderQuantity += $item['orderQuantity'];
                            }  
                        ?>
                        <span class="order__count">
                            <?= htmlspecialchars($orderQuantity); ?>
                        </span> 
                    sản phẩm)
                </h5>
                
                <?php foreach($proPendingOrderInfo as $orderInfo) : ?>
                    <div class="order__item">
                        <div class="order__item-image">
                            <img src="/<?= $orderInfo['image'] ?>" 
                                alt="<?= $orderInfo['proName'] . $orderInfo['colorName'] ?>">
                        </div>
                        
                        <div class="order__item-details">   
                            <b><?= $orderInfo['proName']; ?></b>
                            <div class="d-flex gap-2 align-items-center">
                                <span><b>Màu:</b></span>
                                <div class="circle-product-color" 
                                    style="background-color: <?= $orderInfo['colorCode']; ?>;">
                                </div>
                                (<?= htmlspecialchars($orderInfo['colorName']); ?>) 
                            </div>
                            <p><b>Kích cỡ:</b> <?=$orderInfo['size']?></p>
                            <p><b>Số lượng :</b> <?=$orderInfo['orderQuantity']; ?></p>
                            <p><b>Tạm tính :</b> <?= formatPrice(($orderInfo['price'] * (100 - $orderInfo['discount']) / 100 ) 
                                * $orderInfo['orderQuantity']); ?> đ</p>
                        </div>
                        
                        <div class="order__item-price">
                            <br><br>
                            <?= formatPrice($orderInfo['price'] * (100 - $orderInfo['discount']) / 100); ?> đ
                            <sup>
                                <strike>
                                    <?= formatPrice($orderInfo['price']); ?> đ
                                </strike>
                            </sup>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="summary">
                    <div class="summary__row">
                        <span>Phí vận chuyển: </span> 
                        <span>40.000₫</span>
                    </div>
                </div>
                
                <div class="total">
                    <div class="total__row">
                        <span>Tổng cộng: </span> 
                        <span class="total__price">
                            <?php
                                $totalPrice = 40000;
                                foreach($proPendingOrderInfo as $orderInfo) {
                                    $totalPrice += (($orderInfo['price'] * (100 - $orderInfo['discount']) / 100) * $orderInfo['orderQuantity']) ;
                                }
                            ?>
                            <?= formatPrice($totalPrice); ?> ₫
                        </span>
                    </div>
                    
                    <div class="total__actions">
                        <a href="<?= route('CartRoute'); ?>" class="total__back-link">
                            <i class="fa-solid fa-caret-left"></i> Quay về giỏ hàng
                        </a>
                        <?php foreach ($proPendingOrderInfo as $orderInfo): ?>
                            <input type="hidden" name="orderCodes[]" value="<?= htmlspecialchars($orderInfo['orderCode']) ?>">
                        <?php endforeach; ?>
                        <button type="submit" class="total__order-button" name="SubmitOrderNormal" value="SubmitOrder">
                            ĐẶT HÀNG
                        </button>
                    </div>
                </div>
            </form>
        </aside>
    </div>
    <script src="<?= public_dir('js/UserJs/orderNormal.js') ?>"></script>
</body>
</html>