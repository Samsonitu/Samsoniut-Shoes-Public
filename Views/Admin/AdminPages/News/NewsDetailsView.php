<?php 
    $title = "Chi Tiết Tin Tức | SSNT SHOES";
    $activePage = [
        'navItem' => route('AdminNewsRoute'),
        'subNavItem' => route('AdminNewsRoute'),
    ];
    require_once __DIR__ . "/../../AdminLayouts/SidebarView.php";
    require_once __DIR__ . "/../../AdminLayouts/HeaderView.php"; 
?>
<div class="content">
    <div class="bread-crump">
        <p>
            <a href="<?= route('AdminRoute'); ?>">Trang chủ</a> / 
            <a href="<?= route('AdminNewsRoute') ?>">Quản Lý Tin Tức</a> /
            <a href="<?= route('AdminNewsDetailsRoute', ['newsId' => $newsDetailsInfo[0]['newsId']]); ?>">Chi Tiết Tin Tức</a>
        </p>
    </div>    
    <div class="news-container bg-light">
        <div class="short-news-content text-center">
            <h3 class="news-title"><?= htmlspecialchars($newsDetailsInfo[0]['title']); ?></h3>
            <p class="news-excerpt"><?= htmlspecialchars($newsDetailsInfo[0]['excerpt']); ?></p>
            <img class="news-thumbnail" src="/<?= htmlspecialchars($newsDetailsInfo[0]['thumbnail']) ?>" 
                alt="<?= htmlspecialchars($newsDetailsInfo[0]['title']) ?>">
        </div>
        <div class="news-details">
            <?= html_entity_decode($newsDetailsInfo[0]['content']); ?>
        </div>
    </div>
    
</div>

<?php require_once __DIR__ . "/../../AdminLayouts/FooterView.php"; ?>