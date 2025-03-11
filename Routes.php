<?php


return [
/* Begin User Routes */
    
    // Home Routes
        [
            "url" => "/",
            "name" => "HomeRoute",
            'controller' => \Controllers\UserControllers\HomeController::class,
            'method' => 'showHomeView',
            'auth' => ''
        ],

    // Introduce Routes
        [
            "url" => "/gioi-thieu",
            "name" => "IntroduceRoute",
            'controller' => \Controllers\UserControllers\IntroduceController::class,
            'method' => 'showIntroduceView',
            'auth' => ''
        ],
    // Store System Routes
        [
            "url" => "/he-thong-cua-hang",
            "name" => "StoreSystemRoute",
            'controller' => \Controllers\UserControllers\StoreSystemController::class,
            'method' => 'showStoreSystemView',
            'auth' => ''
        ],
    // Contact Routes
        [
            "url" => "/lien-he",
            "name" => "ContactRoute",
            'controller' => \Controllers\UserControllers\ContactController::class,
            'method' => 'showContactView',
            'auth' => ''
        ],
        [
            "url" => "/gui-tin-nhan",
            "name" => "SendMessageRoute",
            'controller' => \Controllers\UserControllers\ContactController::class,
            'method' => 'sendMessage',
            'auth' => ''
        ],
    // News Routes
        [
            "url" => "/tin-tuc",
            "name" => "NewsRoute",
            'controller' => \Controllers\UserControllers\NewsController::class,
            'method' => 'showNewsView',
            'auth' => ''
        ],
        [
            "url" => "/tin-tuc/{newsSlug}",
            "name" => "NewsDetailsRoute",
            'controller' => \Controllers\UserControllers\NewsController::class,
            'method' => 'showNewsDetailsView',
            'auth' => ''
        ],
    // Order Routes
        [
            "url" => "/gio-hang",
            "name" => "CartRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'showCartView',
            'auth' => ''
        ],
        [
            "url" => "/cap-nhat-so-luong-don-hang",
            "name" => "UpdateOrderQuantityRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'updateOrderQuantity',
            'auth' => 'user'
        ],
        [
            "url" => "/xoa-don-hang",
            "name" => "RemoveOrderRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'removeOrder',
            'auth' => 'user'
        ],
        [
            "url" => "/xac-nhan-dat-hang",
            "name" => "OrderNormalRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'showOrderNormalForm',
            'auth' => 'user'
        ],
        [
            "url" => "/xu-ly-dat-hang",
            "name" => "HandleOrderNormalRouteRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'orderNormal',
            'auth' => 'user'
        ],
        [
            "url" => "/xac-nhan-dat-hang-nhanh",
            "name" => "OrderFastRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'showOrderFastForm',
            'auth' => 'user'
        ],
        [
            "url" => "/xu-ly-dat-hang-nhanh",
            "name" => "HandleOrderFastRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'orderFast',
            'auth' => 'user'
        ],
        [
            "url" => "/san-pham/them-san-pham-vao-gio-hang/{proId}/{varId}/{quantity}",
            "name" => "AddProVarToCartRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'addProVarToCart',
            'auth' => ''
        ],
        [
            "url" => "/don-mua-cua-toi",
            "name" => "OrderedRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'showOrderedView',
            'auth' => 'user'
        ],
        [
            "url" => "/don-mua-cua-toi/{userId}{status}",
            "name" => "GetOrderByStatusRoute",
            'controller' => \Controllers\UserControllers\OrderController::class,
            'method' => 'GetOrderByStatus',
            'auth' => 'user'
        ],
    // Product Routes
        [
            "url" => "/san-pham",
            "name" => "ProductRoute",
            'controller' => \Controllers\UserControllers\ProductController::class,
            'method' => 'showProductView',
            'auth' => ''
        ],
        [
            "url" => "/san-pham/{proSlug}",
            "name" => "ProductDetailsRoute",
            'controller' => \Controllers\UserControllers\ProductController::class,
            'method' => 'showProductDetails',
            'auth' => ''
        ],
        [
            "url" => "/danh-muc-san-pham/{catSlug}",
            "name" => "ProductCategoryRoute",
            'controller' => \Controllers\UserControllers\ProductController::class,
            'method' => 'showProductCategoryView',
            'auth' => ''
        ],
        [
            "url" => "/thuong-hieu-san-pham/{brandSlug}",
            "name" => "ProductBrandRoute",
            'controller' => \Controllers\UserControllers\ProductController::class,
            'method' => 'showProductBrandView',
            'auth' => ''
        ],
        [
            "url" => "/them-san-pham-vao-muc-yeu-thich/{proId}",
            "name" => "AddProVarToWishListRoute",
            'controller' => \Controllers\UserControllers\ProductController::class,
            'method' => 'addProVarToWishList',
            'auth' => ''
        ],
        [
            "url" => "/xoa-san-pham-trong-muc-yeu-thich",
            "name" => "RemoveProVarWishListRoute",
            'controller' => \Controllers\UserControllers\ProductController::class,
            'method' => 'removeProVarWishList',
            'auth' => ''
        ],
        [
            "url" => "/san-pham-yeu-thich",
            "name" => "WishListProductRoute",
            'controller' => \Controllers\UserControllers\ProductController::class,
            'method' => 'showWishlistProductView',
            'auth' => 'user'
        ],
    // Auth User Routes
        [
            "url" => "/dang-nhap",
            "name" => "LoginRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'showUserLoginForm',
            'auth' => ''
        ],
        [
            "url" => "/xu-ly-dang-nhap",
            "name" => "HandleLoginRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'loginUserNormal',
            'auth' => ''
        ],
        [
            "url" => "/auth/google/callback",
            "name" => "googleCallback",
            'controller' => \Controllers\AuthController::class,
            'method' => 'googleCallback',
            'auth' => ''
        ],
        [
            "url" => "/dang-ky",
            "name" => "RegisterRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'showUserRegisterForm',
            'auth' => ''
        ],
        [
            "url" => "/xu-ly-dang-ky",
            "name" => "HandleRegisterRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'registerUser',
            'auth' => ''
        ],
        [
            "url" => "/xac-thuc-dang-ky",
            "name" => "ConfirmRegisterRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'showUserConfirmRegisterForm',
            'auth' => ''
        ],
        [
            "url" => "/gui-lai-ma-xac-thuc-dang-ky",
            "name" => "resendVerificationCodeRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'resendVerificationCode',
            'auth' => ''
        ],
        [
            "url" => "/xu-ly-xac-thuc-dang-ky",
            "name" => "HandleConfirmRegisterRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'confirmRegister',
            'auth' => ''
        ],
        [
            "url" => "/bo-sung-thong-tin",
            "name" => "AdditionalInfoRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'showAdditionalInfoForm',
            'auth' => ''
        ],
        [
            "url" => "/xu-ly-bo-sung-thong-tin",
            "name" => "HandleAdditionalInfoRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'handleAdditionalInfo',
            'auth' => ''
        ],
    // Account Route
        [
            "url" => "/lay-lai-mat-khau",
            "name" => "GetPasswordByEmailRoute",
            'controller' => \Controllers\UserControllers\AccountController::class,
            'method' => 'getPasswordByEmail',
            'auth' => ''
        ],
        [
            "url" => "/doi-mat-khau",
            "name" => "ChangePasswordRoute",
            'controller' => \Controllers\UserControllers\AccountController::class,
            'method' => 'showChangePasswordView',
            'auth' => 'user'
        ],
        [
            "url" => "/xu-ly-doi-mat-khau",
            "name" => "HandleChangePasswordRoute",
            'controller' => \Controllers\UserControllers\AccountController::class,
            'method' => 'handleChangePassword',
            'auth' => 'user'
        ],
        [
            "url" => "/tai-khoan-cua-toi",
            "name" => "AccountRoute",
            'controller' => \Controllers\UserControllers\AccountController::class,
            'method' => 'showAccountView',
            'auth' => 'user'
        ],
        [
            "url" => "/cap-nhat-tai-khoan",
            "name" => "UpdateUserInfoRoute",
            'controller' => \Controllers\UserControllers\AccountController::class,
            'method' => 'updateUserInfo',
            'auth' => 'user'
        ],
    // Search Routes
        [
            "url" => "/tim-kiem/{proName}",
            "name" => "SearchProNameRoute",
            'controller' => \Controllers\UserControllers\SearchController::class,
            'method' => 'search',
            'auth' => ''
        ],
/* End User Routes */

/* Begin Common Routes */
    [
        "url" => "/dang-xuat",
        "name" => "LogoutRoute",
        'controller' => \Controllers\AuthController::class,
        'method' => 'logout',
        'auth' => ''
    ],
/* End Common Routes */

/* Begin Admin Routes */

    // Dashboard Routes
        [
            "url" => "/admin",
            "name" => "AdminRoute",
            'controller' => \Controllers\AdminControllers\DashboardController::class,
            'method' => 'index',
            'auth' => 'admin',
        ],
    // Auth Admin Routes
        [
            "url" => "/admin/login",
            "name" => "AdminLoginRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'showAdminLoginForm',
            'auth' => ''
        ],
        [
            "url" => "/admin/login/submit",
            "name" => "AdminLoginSubmitRoute",
            'controller' => \Controllers\AuthController::class,
            'method' => 'loginAdmin',
            'auth' => ''
        ],
    // Product Management Routes
        // Product Category Routes
            [
                "url" => "/admin/product-category",
                "name" => "AdminProductCategoryRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showProductCategoryView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/create-product-category",
                "name" => "AdminCreateProductCategoryRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'storeProductCategory',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/update-product-category",
                "name" => "AdminUpdateProductCategoryRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'updateProductCategory',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/product-category-in-trash",
                "name" => "AdminProCatInTrashRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showProCatInTrashView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/temp-delete-product-category",
                "name" => "AdminTempDeleteProCatRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'tempDeleteProCat',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/remove-product-category",
                "name" => "AdminRemoveProductCategoryRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'removeProductCategory',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/restore-product-category-in-trash",
                "name" => "AdminRestoreProCatInTrashRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'restoreProCatInTrash',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/change-status-product-category",
                "name" => "AdminChangeStatusProductCategoryRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'changeStatusProductCategory',
                'auth' => 'admin'
            ],
        // Product Routes
            [
                "url" => "/admin/product",
                "name" => "AdminProductRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showProductView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/check-exists-product/{proName}",
                "name" => "AdminProductRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'checkExistsProductByProName',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/get-sizes/{proId}",
                "name" => "AdminProductRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'getSizesByProductAndColor',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/create-product",
                "name" => "AdminCreateProductRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showProductCreationForm',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/handle-create-product",
                "name" => "AdminHandleCreateProductRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'storeProduct',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/create-variant-product/{proId}",
                "name" => "AdminCreateVariantProductRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showVariantProductCreationForm',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/handle-create-variant-product",
                "name" => "AdminHandleCreateVariantProductRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'storeVariantProduct',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/update-product",
                "name" => "AdminUpdateProductRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'updateProduct',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/update-product-variant",
                "name" => "AdminUpdateProductVariantRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'updateProductVariant',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/change-status-product-variant",
                "name" => "AdminChangeStatusProductVariantRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'changeStatusProductVariant',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/temp-delete-product",
                "name" => "AdminTempDeleteProductRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'tempDeleteProduct',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/product-variant-in-trash",
                "name" => "AdminProVarInTrashRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showProVarInTrashView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/delete-product-permanently",
                "name" => "AdminDeleteProVarPermanently",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'deleteProVarPermanently',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/restore-product-in-trash",
                "name" => "AdminRestoreProVarInTrashRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'restoreProVarInTrash',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/product-details/{proId}",
                "name" => "AdminProductDetailsRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showProductDetailsView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/product-flash-sale",
                "name" => "AdminProductFlashSaleRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showFlashSaleView',
                'auth' => 'admin'
            ],
        // Product Supplier Routes
            [
                "url" => "/admin/product-supplier",
                "name" => "AdminProductSupplierRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showProductSupplierView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/create-product-supplier",
                "name" => "AdminCreateProductSupplierRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'createProductSupplier',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/update-product-supplier",
                "name" => "AdminUpdateProductSupplierRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'updateProductSupplier',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/delete-product-supplier",
                "name" => "AdminDeleteProductSupplierRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'deleteProductSupplier',
                'auth' => 'admin'
            ],
        // Product Brand Routes
            [
                "url" => "/admin/product-brand",
                "name" => "AdminProductBrandRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'showProductBrandView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/create-product-brand",
                "name" => "AdminCreateProductBrandRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'storeProductBrand',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/update-product-brand",
                "name" => "AdminUpdateProductBrandRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'updateProductBrand',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/delete-product-brand",
                "name" => "AdminDeleteProBrandRoute",
                'controller' => \Controllers\AdminControllers\ProductController::class,
                'method' => 'removeProductBrand',
                'auth' => 'admin'
            ],
    // Account Management Routes
        [
            "url" => "/admin/account",
            "name" => "AdminAccountRoute",
            'controller' => \Controllers\AdminControllers\AccountController::class,
            'method' => 'showAccountView',
            'auth' => 'admin'
        ],
        [
            "url" => "/admin/create-account",
            "name" => "AdminCreateAccountRoute",
            'controller' => \Controllers\AdminControllers\AccountController::class,
            'method' => 'createAccount',
            'auth' => 'admin'
        ],
        [
            "url" => "/admin/update-account",
            "name" => "AdminUpdateAccountRoute",
            'controller' => \Controllers\AdminControllers\AccountController::class,
            'method' => 'updateAccount',
            'auth' => 'admin'
        ],
        [
            "url" => "/admin/change-active-account",
            "name" => "AdminChangeActiveAccountRoute",
            'controller' => \Controllers\AdminControllers\AccountController::class,
            'method' => 'changeActiveAccount',
            'auth' => 'admin'
        ],
        [
            "url" => "/admin/remove-account",
            "name" => "AdminRemoveAccountRoute",
            'controller' => \Controllers\AdminControllers\AccountController::class,
            'method' => 'removeAccount',
            'auth' => 'admin'
        ],
    // News Management Routes 
        // News Category Routes
            [
                "url" => "/admin/news-category",
                "name" => "AdminNewsCategoryRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'showNewsCategoryView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/create-news-category",
                "name" => "AdminCreateNewsCategoryRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'storeNewsCategory',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/update-news-category",
                "name" => "AdminUpdateNewsCategoryRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'updateNewsCategory',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/temp-delete-news-category",
                "name" => "AdminTempDeleteNewsCategoryRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'tempDeleteNewsCategory',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/news-category-in-trash",
                "name" => "AdminNewsCatInTrashRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'showNewsCatInTrash',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/remove-news-category",
                "name" => "AdminRemoveNewsCategoryRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'removeNewsCategory',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/restore-news-category-in-trash",
                "name" => "AdminRestoreNewsCatInTrashRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'restoreNewsCatInTrash',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/change-status-news-category",
                "name" => "AdminChangeStatusNewsCategoryRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'changeStatusNewsCategory',
                'auth' => 'admin'
            ],
        // News Routes
            [
                "url" => "/admin/news",
                "name" => "AdminNewsRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'showNewsView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/news-details/{newsId}",
                "name" => "AdminNewsDetailsRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'showNewsDetailsView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/create-news",
                "name" => "AdminNewsCreateViewRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'showNewsCreateView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/handle-create-news",
                "name" => "AdminHandleCreateNewsRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'handleCreateNews',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/update-news/{newsId}",
                "name" => "AdminNewsUpdateRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'showUpdateNewsView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/handle-update-news",
                "name" => "AdminHandleUpdateNewsRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'handleUpdateNews',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/temp-delete-news",
                "name" => "AdminTempDeleteNewsRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'tempDeleteNews',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/news-in-trash",
                "name" => "AdminNewsInTrashRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'showNewsInTrashView',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/remove-news",
                "name" => "AdminRemoveNewsRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'removeNews',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/restore-news-in-trash",
                "name" => "AdminRestoreNewsInTrashRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'restoreNewsInTrash',
                'auth' => 'admin'
            ],
            [
                "url" => "/admin/change-status-news",
                "name" => "AdminChangeStatusNewsRoute",
                'controller' => \Controllers\AdminControllers\NewsController::class,
                'method' => 'changeStatusNews',
                'auth' => 'admin'
            ],
    // Order Management Routes
        [
            "url" => "/admin/order",
            "name" => "AdminOrderRoute",
            'controller' => \Controllers\AdminControllers\OrderController::class,
            'method' => 'showOrderView',
            'auth' => 'admin'
        ],
        [
            "url" => "/admin/order-by-status/{status}",
            "name" => "AdminOrderByStatusRoute",
            'controller' => \Controllers\AdminControllers\OrderController::class,
            'method' => 'getOrderByStatus',
            'auth' => 'admin'
        ],
        [
            "url" => "/admin/update-note-to-order",
            "name" => "AdminUpdateOrderRoute",
            'controller' => \Controllers\AdminControllers\OrderController::class,
            'method' => 'updateOrder',
            'auth' => 'admin'
        ],
        [
            "url" => "/admin/update-status-order",
            "name" => "AdminUpdateStatusOrderRoute",
            'controller' => \Controllers\AdminControllers\OrderController::class,
            'method' => 'updateStatusOrder',
            'auth' => 'admin'
        ],

/* End Admin Routes */
];