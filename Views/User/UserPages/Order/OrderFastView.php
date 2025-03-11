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
            <form id="orderForm" action="<?= route('HandleOrderFastRoute'); ?>" method="post">
                <h5 class="order__title">
                    Đơn hàng ( 
                    <span class="order__count">
                        <input type="hidden" name="confirmOrderQuantity" value="<?= htmlspecialchars($orderQuantity); ?>">
                        <?= htmlspecialchars($orderQuantity); ?>
                    </span> 
                    sản phẩm)
                </h5>
                
                <div class="order__item">
                    <div class="order__item-image">
                        <img src="/<?= $proPendingOrderInfo[0]['image'] ?>" 
                            alt="<?= $proPendingOrderInfo[0]['proName'] . $proPendingOrderInfo[0]['colorName'] ?>">
                    </div>
                    
                    <div class="order__item-details">   
                        <b><?= $proPendingOrderInfo[0]['proName']; ?></b>
                        <input type="hidden" name="confirmOrderProId" value="<?= $proPendingOrderInfo[0]['proId']; ?>">
                        <div class="d-flex gap-2 align-items-center">
                            <span><b>Màu:</b></span>
                            <div class="circle-product-color" 
                                style="background-color: <?= $proPendingOrderInfo[0]['colorCode']; ?>;">
                            </div>
                            (<?= htmlspecialchars($proPendingOrderInfo[0]['colorName']); ?>) 
                            <input type="hidden" name="confirmOrderVarId" 
                                value="<?= htmlspecialchars($proPendingOrderInfo[0]['varId']); ?>">
                        </div>
                        <p><b>Kích cỡ:</b> <?=$proPendingOrderInfo[0]['size']?></p>
                    </div>
                    
                    <div class="order__item-price">
                        <br><br>
                        <?= formatPrice($proPendingOrderInfo[0]['price'] * (100 - $proPendingOrderInfo[0]['discount']) / 100); ?> đ
                        <sup>
                            <strike>
                                <?= formatPrice($proPendingOrderInfo[0]['price']); ?> đ
                            </strike>
                        </sup>
                        <input type="hidden" name="unitPrice" 
                            value="<?= $proPendingOrderInfo[0]['price'] 
                            * (100 - $proPendingOrderInfo[0]['discount']) / 100; ?>">
                    </div>
                </div>
                
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
                            <?= formatPrice(
                                ($proPendingOrderInfo[0]['price'] * (100 - $proPendingOrderInfo[0]['discount']) / 100) 
                                * $orderQuantity + 40000); 
                            ?> ₫
                            <input type="hidden" name="totalOrder" 
                                value="<?= ($proPendingOrderInfo[0]['price'] * 
                                (100 - $proPendingOrderInfo[0]['discount']) / 100) 
                                * $orderQuantity + 40000 ?>">
                        </span>
                    </div>
                    
                    <div class="total__actions">
                        <a href="<?= route('CartRoute'); ?>" class="total__back-link">
                            <i class="fa-solid fa-caret-left"></i> Quay về giỏ hàng
                        </a>
                        <button type="submit" class="total__order-button" name="SubmitConfirmOrderFast" value="SubmitOrder">
                            ĐẶT HÀNG
                        </button>
                    </div>
                </div>
            </form>
        </aside>
    </div>
    <script src="<?= public_dir('js/UserJs/orderFast.js') ?>"></script>
</body>
</html>