<?php
    $Title = "Tin Tức | Samsonitu Shoes";
    $extraCSS = [public_dir('css/UserCss/news.css')];
    require_once __DIR__ . "/../../UserLayouts/HeaderView.php";
?>
    <main>
        <section class="section-breadcrump" style="background-image: url(<?=public_dir('/img/section_breadcrumb.webp')?>)">
            <div class="breadcrump-container text-center">
                <div class="title-section">
                    <h2 style="margin-bottom: 25px;">Tin tức</h2>
                    <ul class="breadcrump p-0">
                        <li>
                            <a href="" class="hover-maincl">Trang chủ</a>
                            <i class="fa-solid fa-caret-right"></i>
                        </li>
                        <li><span>Tin tức</span></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section-news mb-4">
            <div class="container-lg">
                <div class="news-list">
                    <?php foreach($newsList as $newsItem): ?>
                        <div class="news-item">
                            <div class="news-img">
                                <img src="<?= htmlspecialchars($newsItem['thumbnail']); ?>" 
                                alt="<?= htmlspecialchars($newsItem['title']); ?>">
                            </div>
                            <div class="news-content">
                                <h3>
                                    <a href="<?= route('NewsDetailsRoute', ['newsSlug' => $newsItem['newsSlug']]); ?>">
                                        <?= htmlspecialchars($newsItem['title']); ?>
                                    </a>
                                </h3>
                                <p><strong>Ngày đăng:</strong> <?= formatDate(htmlspecialchars($newsItem['createAt'])); ?></p>
                                <p><?= htmlspecialchars($newsItem['excerpt']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?> 
                </div>
            </div>
        </section>
    </main>
<?php
    require_once __DIR__ . "/../../UserLayouts/FooterView.php";
?>